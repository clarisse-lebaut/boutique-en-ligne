<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Attention !!!</h1>

  <form class="mx-auto bg-warning rounded p-4" style="width: 90%; max-width: 720px" action="./index.php?page=<?= DELETE_CATEGORY ?>" method="post">
    <input type="hidden" name="categoryId" value="<?= $categoryId ?>">
    <p>Vous vous apprêtez à supprimer le catégorie suivant : <?= $categoryName ?></p>
    <p>Cette action aura pour effet de supprimer la catégorie de la base de données !</p>
    <input type="submit" class="btn btn-primary" value="Valider" />
  </form>
</main>