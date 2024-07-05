<main>
  <h2 class="title text-center mt-3 mb-4">Connexion</h2>
  <hr>
 
  <!-- start form -->
  <form class="connection m-auto mt-4" action="index.php?page=<?= CONNECTION ?>" method="post">
    <div class="box-input">
      <label for="email">E-mail</label>
      <input class="connection-input" type="email" name="email" placeholder="Email">
    </div>
    <div class="box-input">
      <label for="password">Mot de passe</label>
      <input class="connection-input" type="password" name="password" placeholder="Mot de passe" minlength="8">
    </div>
    <input class="btn btn-primary m-auto" type="submit" name="btnConnect" value="Se connecter">
  </form>
  <!-- end form -->
  
  <a href="index.php?page=<?= PAGE_REGISTER ?>" class="d-block text-center py-4 my-4 w-25 mx-auto"
    style="text-decoration: none; color:var(--accent-clr);">Pas de compte ? Inscrivez-vous !</a>
</main>