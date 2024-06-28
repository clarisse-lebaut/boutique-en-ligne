<?php
require_once __DIR__ . '/../enzo-function/candy_class.php';

$candy = new Candy();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$candys_per_page = 5;
$category = isset($_GET['category']) ? $_GET['category'] : null;
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : null;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

$candys = $candy->getPaginatedCandy($page, $candys_per_page, $category, $min_price, $max_price, $sort_by, $order);
$total_candys = $candy->getTotalCandyCount($category, $min_price, $max_price);
$total_pages = ceil($total_candys / $candys_per_page);

include_once './assets/components/header.php';
?>

<div class="container">
    <h1>Candies</h1>
    <?php
    if (isset($message)) {
        echo '<div class="alert alert-' . $message_type . '" role="alert">' . $message . '</div>';
    }
    ?>

    <!-- Filter and Sort Form -->
    <form method="get" class="mb-4">
        <input type="hidden" name="page" value="<?php echo PAGE_CANDY; ?>">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="min_price">Min Price</label>
                <input type="number" class="form-control" id="min_price" name="min_price" value="<?php echo htmlspecialchars($min_price); ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="max_price">Max Price</label>
                <input type="number" class="form-control" id="max_price" name="max_price" value="<?php echo htmlspecialchars($max_price); ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="sort_by">Sort By</label>
                <select class="form-control" id="sort_by" name="sort_by">
                    <option value="name" <?php echo $sort_by == 'name' ? 'selected' : ''; ?>>Name</option>
                    <option value="price" <?php echo $sort_by == 'price' ? 'selected' : ''; ?>>Price</option>
                    <option value="created_at" <?php echo $sort_by == 'created_at' ? 'selected' : ''; ?>>Date Added</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="order">Order</label>
                <select class="form-control" id="order" name="order">
                    <option value="asc" <?php echo $order == 'asc' ? 'selected' : ''; ?>>Ascending</option>
                    <option value="desc" <?php echo $order == 'desc' ? 'selected' : ''; ?>>Descending</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter & Sort</button>
    </form>

    <?php
    if (count($candys) > 0) {
        foreach ($candys as $row) {
            echo '<div class="candy">';
            echo '<h2><a href="#" class="candy-link" data-id="' . $row["id"] . '" data-toggle="modal" data-target="#candyModal">' . $row["name"] . '</a></h2>';
            echo '<p>Price: $' . $row["price"] . '</p>';

            // Add to Favorites button
            $favorites = isset($_COOKIE['favorites']) ? unserialize($_COOKIE['favorites']) : [];
            $isFavorite = in_array($row["id"], $favorites);
            echo '<form method="post" class="favorite-form">
                    <input type="hidden" name="candy_id" value="' . $row["id"] . '">
                    <input type="submit" value="' . ($isFavorite ? "Remove from Favorites" : "Add to Favorites") . '" class="btn btn-secondary">
                  </form>';

            echo '</div>';
        }

        // Display pagination links
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="?page=' . PAGE_CANDY . '&page_num=' . ($page - 1) . '&category=' . urlencode($category) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '&sort_by=' . urlencode($sort_by) . '&order=' . urlencode($order) . '">&laquo; Previous</a> ';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<strong>' . $i . '</strong> ';
            } else {
                echo '<a href="?page=' . PAGE_CANDY . '&page_num=' . $i . '&category=' . urlencode($category) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '&sort_by=' . urlencode($sort_by) . '&order=' . urlencode($order) . '">' . $i . '</a> ';
            }
        }
        if ($page < $total_pages) {
            echo '<a href="?page=' . PAGE_CANDY . '&page_num=' . ($page + 1) . '&category=' . urlencode($category) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '&sort_by=' . urlencode($sort_by) . '&order=' . urlencode($order) . '">Next &raquo;</a>';
        }
        echo '</div>';
    } else {
        echo '<p>No candies available.</p>';
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
