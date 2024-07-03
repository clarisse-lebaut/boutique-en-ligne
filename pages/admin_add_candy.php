<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Ajouter un bonbon</h1>
  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= ADD_CANDY ?>" method="post" enctype="multipart/form-data">
    <div class="d-flex flex-column mb-3">
      <label class="form-label" for="candyName">Nom</label>
      <input class="form-control w-100" type="text" name="candyName" id="candyName">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyDescription">Description</label>
      <textarea class="form-control w-100" name="candyDescription" id="candyDescription"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyPrice">Prix de base</label>
      <input class="form-control w-100" type="number" name="candyPrice" id="candyPrice" step="0.01" min="0" value="0">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyNbStock">Nombre en stock de base</label>
      <input class="form-control w-100" type="number" name="candyNbStock" id="candyNbStock" step="1" min="0" value="0">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyImage">Image</label>
      <input class="form-control w-100" type="file" name="candyImage" id="candyImage" accept=".png,.jpeg,.jpg,.svg,.webp">
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyCategories">Type de bonbon</label>
      <select class="form-select overflow-hidden" size="<?= count($categories) ?>" multiple name="candyCategories[]" id="candyCategories">
        <?php foreach ($categories as $category) { ?>
          <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" for="candyMark">Marque</label>
      <select class="form-select" name="candyMark" id="candyMark">
        <?php foreach ($marks as $mark) { ?>
          <option value="<?= $mark["id"] ?>"><?= $mark["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
  </form>
</main>