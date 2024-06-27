<main>
    <h1>Nos produits</h1>
    <?php if (count($candies) == 0) { ?>
        <div>Pas de bonbon</div>
        <?php
    } else {
        foreach ($candies as $candy) {
            ?>
            <form action="index.php?page=<?= ADD_FAVORITES ?>" method="post">
                <input type="hidden" name="candy" value='<?= $candy["id"] ?>'>
                <?= $candy["name"] ?>

                <?php if (in_array($favorites, $candy)) { ?>
                    <input type="submit" name="addFavorite" class="btn btn-primary" value="Retirer des favoris">
                <?php } else { ?>
                    <input type="submit" name="removeFavorite" class="btn btn-primary" value="Ajouter aux favoris">
                <?php } ?>
            </form>
            <?php
        }
    }
    ?>
</main>