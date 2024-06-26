<?php
if (!isset($_SESSION["accountId"])) {
  header("Location: index.php?page=" . PAGE_HOME);
}
?>

<main>
  <h1>Modifier mon profil</h1>
  <form action="index.php?page=<?= MODIFICATION_OF_PROFILE ?>" method="post">
    <div>
      <label for="firstname">Prénom</label>
      <input type="text" name="firstname" id="firstname" placeholder="<?= empty($account["firstname"]) ? "Non renseigner" : $account["firstname"] ?>">
    </div>

    <div>
      <label for="lastname">Nom de famille</label>
      <input type="text" name="lastname" id="lastname" placeholder="<?= empty($account["lastname"]) ? "Non renseigner" : $account["lastname"] ?>">
    </div>

    <div>
      <label for="address">Adresse</label>
      <input type="text" name="address" id="address" placeholder="<?= empty($account["address"]) ? "Non renseigner" : $account["address"] ?>">
    </div>

    <div>
      <label for="zipcode">Code postal</label>
      <input type="text" name="zipcode" id="zipcode" placeholder="<?= empty($account["zipcode"]) ? "Non renseigner" : $account["zipcode"] ?>">
    </div>

    <div>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" placeholder="<?= $account["email"] ?>">
    </div>

    <div>
      <label for="oldPassword">Ancien mot de passe</label>
      <input type="password" name="oldPassword" id="oldPassword">
    </div>

    <div>
      <label for="newPassword">Nouveau mot de passe</label>
      <input type="password" name="newPassword" id="newPassword">
    </div>

    <div>
      <label for="newPasswordConfirmation">Nouveau mot de passe de confirmation</label>
      <input type="password" name="newPasswordConfirmation" id="newPasswordConfirmation">
    </div>

    <input type="submit" name="btnUpdateProfile" value="Mettre à jour" class="btn btn-primary">
    <a href="index.php?page=<?= PAGE_PROFILE ?>" class="btn btn-primary">Annuler</a>
  </form>
</main>