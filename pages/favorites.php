<?php
require_once './classes/candy_class.php';

$candy = new candy();
$favorites = isset($_COOKIE['favorites']) ? unserialize($_COOKIE['favorites']) : [];
$favorites_candies = $candy->getCandiesByIds($favorites);

include_once './assets/components/header.php';
?>

<div class="container">
    <h1>Favorites</h1>
    <?php
    if (count($favorites_candies) > 0) {
        foreach ($favorites_candies as $row) {
            echo '<div class="candy">';
            echo '<h2><a href="#" class="candy-link" data-id="' . $row["id"] . '" data-toggle="modal" data-target="#candyModal">' . $row["name"] . '</a></h2>';
            echo '<p>Price: $' . $row["price"] . '</p>';

            // Add to Favorites button
            $isFavorite = in_array($row["id"], $favorites);
            echo '<form method="post" class="favorite-form">
                    <input type="hidden" name="candy_id" value="' . $row["id"] . '">
                    <input type="submit" value="Remove from Favorites" class="btn btn-secondary">
                  </form>';

            echo '</div>';
        }
    } else {
        echo '<p>No favorites found.</p>';
    }
    ?>

    <!-- Candy Details Modal -->
    <div class="modal fade" id="candyModal" tabindex="-1" aria-labelledby="candyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candyModalLabel">Candy Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="candyDetails">
                    <!-- Candy details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.candy-link').click(function() {
                var candyId = $(this).data('id');
                $.ajax({
                    url: 'getcandyDetails.php',
                    type: 'GET',
                    data: { id: candyId },
                    success: function(response) {
                        $('#candyDetails').html(response);
                    }
                });
            });
        });
    </script>
</div>

<?php
include_once './assets/components/footer.php';
?>
