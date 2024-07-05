<main>
  <h2 class="title text-center mt-3 mb-4">Modifier votre profil</h2>
  <hr>

  <!-- laptop version -->
  <div class="modify-laptop m-auto mt-4">
    <form action="index.php?page=<?= MODIFICATION_OF_PROFILE ?>" method="post">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td><label class="w-100" for="firstname">Prénom</label></td>
            <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="firstname"
                id="firstname"
                placeholder="<?= empty($account["firstname"]) ? "Non renseigner" : $account["firstname"] ?>"></td>
          </tr>
          <tr>
            <td><label class="w-100" for="lastname">Nom de famille</label></td>
            <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="lastname"
                id="lastname"
                placeholder="<?= empty($account["lastname"]) ? "Non renseigner" : $account["lastname"] ?>"></td>
          </tr>
          <tr>
            <td><label class="w-100" for="address">Adresse</label></td>
            <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="address" id="address"
                placeholder="<?= empty($account["address"]) ? "Non renseigner" : $account["address"] ?>"></td>
          </tr>
          <tr>
            <td><label class="w-100" for="zipcode">Code postal</label></td>
            <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="zipcode" id="zipcode"
                placeholder="<?= empty($account["zipcode"]) ? "Non renseigner" : $account["zipcode"] ?>"></td>
          </tr>
          <tr>
            <td><label class="w-100" for="email">Email</label></td>
            <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="email" id="email"
                placeholder="<?= $account["email"] ?>"></td>
          </tr>
        </tbody>
        <tr>
          <td><label class="w-100" for="oldPassword">Ancien mot de passe</label></td>
          <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="password" name="oldPassword"
              id="oldPassword">
          </td>
        </tr>
        <tr>
          <td><label class="w-100" for="newPassword">Nouveau mot de passe</label></td>
          <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="password" name="newPassword"
              id="newPassword">
          </td>
        </tr>
        <tr>
          <td><label class="w-100" for="newPasswordConfirmation">Nouveau mot de passe de confirmation</label></td>
          <td><input class="modify-input w-100 rounded-4 border border-0 p-4" type="password"
              name="newPasswordConfirmation" id="newPasswordConfirmation">
          </td>
        </tr>
      </table>

      <div class="d-flex justify-content-end gap-2">
        <input type="submit" name="btnUpdateProfile" value="Mettre à jour" class="btn btn-primary">
        <a href="index.php?page=<?= PAGE_PROFILE ?>" class="btn btn-primary">Annuler</a>
      </div>
    </form>
  </div>

  <!-- mobile version -->
  <div class="modify-mobile m-auto mt-4">
    <form class="d-flex flex-column gap-3" action="index.php?page=<?= MODIFICATION_OF_PROFILE ?>" method="post">
      <div class="box-modify-mobile">
        <label class="w-100" for="firstname">Prénom</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="firstname" id="firstname"
          placeholder="<?= empty($account["firstname"]) ? "Non renseigner" : $account["firstname"] ?>">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="lastname">Nom de famille</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="lastname" id="lastname"
          placeholder="<?= empty($account["lastname"]) ? "Non renseigner" : $account["lastname"] ?>">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="address">Adresse</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="address" id="address"
          placeholder="<?= empty($account["address"]) ? "Non renseigner" : $account["address"] ?>">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="zipcode">Code postal</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="zipcode" id="zipcode"
          placeholder="<?= empty($account["zipcode"]) ? "Non renseigner" : $account["zipcode"] ?>">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="email">Email</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="text" name="email" id="email"
          placeholder="<?= $account["email"] ?>">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="oldPassword">Ancien mot de passe</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="password" name="oldPassword"
          id="oldPassword">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="newPassword">Nouveau mot de passe</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="password" name="newPassword"
          id="newPassword">
      </div>
      <div class="box-modify-mobile">
        <label class="w-100" for="newPasswordConfirmation">Nouveau mot de passe de confirmation</label>
        <p>____________________________________________</p>
        <input class="modify-input w-100 rounded-4 border border-0 p-4" type="password" name="newPasswordConfirmation"
          id="newPasswordConfirmation">
      </div>

      <div class="d-flex flex-column justify-content-center m-auto gap-3">
        <input type="submit" name="btnUpdateProfile" value="Mettre à jour" class="btn btn-primary">
        <a href="index.php?page=<?= PAGE_PROFILE ?>" class="btn btn-primary">Annuler</a>
      </div>
    </form>
  </div>
</main>