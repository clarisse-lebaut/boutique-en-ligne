<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Ajouter une catégorie</h1>
  <form class="mx-auto" style="width: 90%; max-width: 720px" action="./index.php?page=<?= ADD_CATEGORY ?>" method="post" enctype="multipart/form-data">
    <div class="d-flex flex-column mb-3">
      <label class="form-label" for="categoryName">Nom</label>
      <input class="form-control w-100" type="text" name="categoryName" id="categoryName">
    </div>

    <button type="submit" class="btn btn-primary">Ajouter</button>
  </form>
</main>