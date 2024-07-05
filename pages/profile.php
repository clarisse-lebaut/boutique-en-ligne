<?php
$dateFormat = "d/m/Y à H:i:s";
$simpleDateFormat = "l d F Y à H:i:s";

$updatedAt = new DateTime($account["updated_at"]);
$createdAt = new DateTime($account["created_at"]);
?>

<main>
  <h2 class="title text-center mt-3 mb-4">Profil</h2>
  <hr>
  <section class="style-laptop m-auto mt-4">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Prénom</td>
          <td><?= $account["firstname"] ?></td>
        </tr>
        <tr>
          <td>Nom de famille</td>
          <td><?= $account["lastname"] ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?= $account["email"] ?></td>
        </tr>
        <tr>
          <td>Adresse</td>
          <td><?= $account["address"] ?></td>
        </tr>
        <tr>
          <td>Code postal</td>
          <td><?= $account["zipcode"] ?></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">Compte mise à jour le <abbr
              title="<?= date_format($updatedAt, $simpleDateFormat) ?>"><?= date_format($updatedAt, $dateFormat) ?></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">Compte créer le <abbr
              title="<?= date_format($createdAt, $simpleDateFormat) ?>"><?= date_format($createdAt, $dateFormat) ?></td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <a href="index.php?page=<?= PAGE_MODIFY_PROFILE ?>" class="btn btn-primary">Modifier mon profil</a>
    </div>
  </section>


  <section class="style-mobile text-center">

    <div class="box-profil">
      <label class="label" for="name">Prénom</label>
      <p>____________________________</p>
      <p><?= $account["firstname"] ?></p>
    </div>

    <div class="box-profil">
      <label class="label" for="name">Nom</label>
      <p>____________________________</p>
      <p><?= $account["lastname"] ?></p>
    </div>
    <div class="box-profil">
      <label class="label" for="name">E-mail</label>
      <p>____________________________</p>
      <p><?= $account["email"] ?></p>
    </div>
    <div class="box-profil">
      <label class="label" for="name">Adresse</label>
      <p>____________________________</p>
      <p><?= $account["address"] ?></p>
    </div>
    <div class="box-profil">
      <label class="label" for="name">Code postal</label>
      <p>____________________________</p>
      <p><?= $account["zipcode"] ?></p>
    </div>

    <table class="table table-bordered">
      <tbody>
        <tr>
          <td colspan="2" class="text-center">Compte mise à jour le <abbr
              title="<?= date_format($updatedAt, $simpleDateFormat) ?>"><?= date_format($updatedAt, $dateFormat) ?></td>
        </tr>
        <tr>
          <td colspan="2" class="text-center">Compte créer le <abbr
              title="<?= date_format($createdAt, $simpleDateFormat) ?>"><?= date_format($createdAt, $dateFormat) ?></td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex m-auto">
      <a href="index.php?page=<?= PAGE_MODIFY_PROFILE ?>" class="btn btn-primary">Modifier mon profil</a>
    </div>
  </section>
</main>