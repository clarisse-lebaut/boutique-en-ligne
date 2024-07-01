<main style="margin-block:100px;">
  <form class="my-4 w-50 mx-auto d-flex flex-column bg-white rounded-4" style="gap:50px; padding:100px; box-shadow: 10px -5px 5px hsla(0, 0%, 50%, 50%); background-color:var(--primary-clr);" action="index.php?page=<?= MODIFICATION_OF_PROFILE ?>" method="post">
    <h1 class="text-center py-4" style="font-family: var(--ff-inknut-antiqua);">Modifier mon profil</h1>
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td><label class="w-100" for="firstname">Prénom</label></td>
          <td><input class="w-100" type="text" name="firstname" id="firstname" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" placeholder="<?= empty($account["firstname"]) ? "Non renseigner" : $account["firstname"] ?>"></td>
        </tr>
        <tr>
          <td><label class="w-100" for="lastname">Nom de famille</label></td>
          <td><input class="w-100" type="text" name="lastname" id="lastname" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" placeholder="<?= empty($account["lastname"]) ? "Non renseigner" : $account["lastname"] ?>"></td>
        </tr>
        <tr>
          <td><label class="w-100" for="address">Adresse</label></td>
          <td><input class="w-100" type="text" name="address" id="address" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" placeholder="<?= empty($account["address"]) ? "Non renseigner" : $account["address"] ?>"></td>
        </tr>
        <tr>
          <td><label class="w-100" for="zipcode">Code postal</label></td>
          <td><input class="w-100" type="text" name="zipcode" id="zipcode" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" placeholder="<?= empty($account["zipcode"]) ? "Non renseigner" : $account["zipcode"] ?>"></td>
        </tr>
        <tr>
          <td><label class="w-100" for="email">Email</label></td>
          <td><input class="w-100" type="text" name="email" id="email" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);" placeholder="<?= $account["email"] ?>"></td>
        </tr>
      </tbody>
      <tr>
        <td><label class="w-100" for="oldPassword">Ancien mot de passe</label></td>
        <td><input class="w-100" type="password" name="oldPassword" id="oldPassword" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);"></td>
      </tr>
      <tr>
        <td><label class="w-100" for="newPassword">Nouveau mot de passe</label></td>
        <td><input class="w-100" type="password" name="newPassword" id="newPassword" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);"></td>
      </tr>
      <tr>
        <td><label class="w-100" for="newPasswordConfirmation">Nouveau mot de passe de confirmation</label></td>
        <td><input class="w-100" type="password" name="newPasswordConfirmation" id="newPasswordConfirmation" class="rounded-4 border border-0 p-4" style="height:50px; box-shadow: 0px 5px 7px hsla(0, 0%, 50%, 50%);"></td>
      </tr>
    </table>

    <div class="d-flex justify-content-end gap-2">
      <input type="submit" name="btnUpdateProfile" value="Mettre à jour" class="btn btn-primary">
      <a href="index.php?page=<?= PAGE_PROFILE ?>" class="btn btn-primary">Annuler</a>
    </div>
  </form>
</main>