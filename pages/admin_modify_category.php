<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Modifier un bonbon</h1>

  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= PAGE_ADMIN_MODIFY_CATEGORIES ?>" method="post" enctype="multipart/form-data">
    <!-- Select Category -->
    <h2 style="padding-bottom: 1rem; font-family: var(--ff-inknut-antiqua)">1. Selection d'une catégorie</h2>

    <div class="mb-3">
      <label class="form-label" for="sltCategories">Choisisser un bonbon à modifier</label>
      <select class="form-select" name="sltCategories" id="sltCategories">
        <?php foreach ($categories as $category) { ?>
          <option value="<?= $category["id"] ?>" <?= $sltCategoryId == $category["id"] ? "selected" : "" ?>><?= $category["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" name="btnSelectCategory" class="btn btn-primary" value="Selectionner" />

    <!-- Selected Category Information -->
    <h2 style="padding-block: 1rem; font-family: var(--ff-inknut-antiqua)">2. Modification de la catégorie selectionner</h2>

    <div class="d-flex flex-column mb-3">
      <label class="form-label" for="categoryName">Nom</label>
      <input class="form-control w-100" type="text" name="categoryName" id="categoryName" value="<?= $sltCategoryName ?>">
    </div>

    <input type="submit" class="btn btn-primary" name="btnModifyCategory" value="Modifier" />
  </form>
</main>