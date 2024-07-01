<main style="margin-block:100px;">
  <h1 class="text-center py-4" style="font-family: var(--ff-inknut-antiqua);">Connexion</h1>

  <form action="index.php?page=<?= CONNECTION ?>" method="post" class="my-4 w-50 mx-auto d-flex flex-column bg-white rounded-4" style="gap:50px; padding:100px; box-shadow: 10px -5px 5px hsla(0, 0%, 50%, 50%); background-color:var(--primary-clr);">
    <input type="email" name="email" placeholder="Email" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);">
    <input type="password" name="password" placeholder="Mot de passe" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" minlength="8">

    <input type="submit" class="btn btn-primary" name="btnConnect" value="Se connecter">
  </form>
  <a href="index.php?page=<?= PAGE_REGISTER ?>" class="d-block text-center py-4 my-4 w-25 mx-auto" style="text-decoration: none; color:var(--accent-clr);">Pas de compte ? Inscrivez-vous !</a>
</main>