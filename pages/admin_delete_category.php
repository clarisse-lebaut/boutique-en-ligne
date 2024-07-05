<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Supprimer une catégorie</h1>

  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= PAGE_ADMIN_DELETE_CATEGORIES_COMFIRM ?>" method="post">
    <div class="mb-3">
      <label class="form-label" for="sltCategories">Choisisser une catégorie à supprimer</label>
      <select class="form-select" name="sltCategories" id="sltCategories">
        <?php foreach ($categories as $category) { ?>
          <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" class="btn btn-primary" value="Supprimer" />
  </form>
</main>