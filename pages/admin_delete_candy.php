<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Supprimer un bonbon</h1>

  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= PAGE_ADMIN_DELETE_CANDIES_COMFIRM ?>" method="post">
    <div class="mb-3">
      <label class="form-label" for="sltCandies">Choisisser un bonbon à supprimer</label>
      <select class="form-select" name="sltCandies" id="sltCandies">
        <?php foreach ($candies as $candy) { ?>
          <option value="<?= $candy["id"] ?>"><?= $candy["name"] ?></option>
        <?php } ?>
      </select>
    </div>

    <input type="submit" class="btn btn-primary" value="Supprimer" />
  </form>
</main>