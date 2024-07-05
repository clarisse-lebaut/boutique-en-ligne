<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Attention !!!</h1>

  <form class="mx-auto bg-warning rounded p-4" style="width: 90%; max-width: 720px" action="./index.php?page=<?= DELETE_CANDY ?>" method="post">
    <input type="hidden" name="candyId" value="<?= $candyId ?>">
    <p>Vous vous apprêtez à supprimer le bonbon suivant : <?= $candyName ?></p>
    <p>Cette action aura pour effet de supprimer tous les commentaires et les classifications liées à ce bonbon !</p>
    <input type="submit" class="btn btn-primary" value="Valider" />
  </form>
</main>