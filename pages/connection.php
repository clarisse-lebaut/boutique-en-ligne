<main>
  <h1>Connexion</h1>

  <form action="index.php?page=<?= CONNECTION ?>" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" minlength="8">

    <input type="submit" class="btn btn-primary" name="btnConnect" value="Se connecter">
    <a href="index.php?page=<?= PAGE_REGISTER ?>">S'inscrire</a>
  </form>
</main>