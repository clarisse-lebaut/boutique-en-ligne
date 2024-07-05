<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Modifier un bonbon</h1>

  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= PAGE_ADMIN_MODIFY_CANDIES ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="oldCategories" value='<?= $oldCategories ?>'>

    <!-- Select Candy -->
    <h2 style="padding-bottom: 1rem; font-family: var(--ff-inknut-antiqua)">1. Selection d'un bonbon</h2>
    <div class="mb-3">
      <label class="form-label" for="sltCandies">Choisisser un bonbon à modifier</label>
      <select class="form-select" name="sltCandies" id="sltCandies">
        <?php foreach ($candies as $candy) { ?>
          <option value="<?= $candy["id"] ?>" <?= $sltCandyId == $candy["id"] ? "selected" : "" ?>><?= $candy["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" name="btnSelectCandy" class="btn btn-primary" value="Selectionner" />

    <!-- Selected Candy Information -->
    <h2 style="padding-block: 1rem; font-family: var(--ff-inknut-antiqua)">2. Modification du bonbon selectionner</h2>
    <div class="d-flex flex-column mb-3">
      <label class="form-label" for="candyName">Nom</label>
      <input class="form-control w-100" type="text" name="candyName" id="candyName" value="<?= $sltCandyName ?>">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyDescription">Description</label>
      <textarea class="form-control w-100" name="candyDescription" id="candyDescription"><?= $sltCandyDescription ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyPrice">Prix de base</label>
      <div class="input-group">
        <input class="form-control" type="number" name="candyPrice" id="candyPrice" step="0.01" min="0" value="<?= $sltCandyPrice ?>">
        <span class="input-group-text">€</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyNbStock">Nombre en stock de base</label>
      <input class="form-control w-100" type="number" name="candyNbStock" id="candyNbStock" step="1" min="0" value="<?= $sltCandyNbStock ?>">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyImage">Image</label>
      <input class="form-control w-100" type="file" name="candyImage" id="candyImage" accept=".png,.jpeg,.jpg,.svg,.webp">
    </div>

    <?php if ($sltCandyId) { ?>
      <div class="card shadow-none mt-3">
        <img src="./assets/images/candies/<?= $sltCandyImage ?>" class="card-img w-100" alt="Image de <?= $sltCandyName ?>">
        <div class="card-img-overlay">
          <p class="card-text" style="backdrop-filter: blur(10px); width: fit-content; padding-inline: 1rem;"><small>Image actuelle : <?= $sltCandyImage ?></small></p>
        </div>
      </div>
      </div>
    <?php } ?>

    <div class="mb-3">
      <label class="form-label" for="candyCategories">Type de bonbon</label>
      <select class="form-select overflow-hidden" size="<?= count($categories) ?>" multiple name="candyCategories[]" id="candyCategories">
        <?php foreach ($categories as $category) { ?>
          <option value="<?= $category["id"] ?>" <?= in_array($category["name"], $sltCandyCategories) ? "selected" : "" ?>><?= $category["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyMarks">Marque</label>
      <select class="form-select" name="candyMarks" id="candyMarks">
        <?php foreach ($marks as $mark) { ?>
          <option value="<?= $mark["id"] ?>" <?= $sltCandyMark["name"] == $mark["name"] ? "selected" : "" ?>><?= $mark["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" class="btn btn-primary" name="btnModifyCandy" value="Modifier" />
  </form>
</main>