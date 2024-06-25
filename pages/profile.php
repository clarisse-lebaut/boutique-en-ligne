<?php
if (!isset($_SESSION["accountId"])) {
  header("Location: index.php?page=" . PAGE_HOME);
}

$dateFormat = "d/m/Y à H:i:s";
$simpleDateFormat = "l d F Y à H:i:s";

$updatedAt = new DateTime($account["updated_at"]);
$createdAt = new DateTime($account["created_at"]);
?>

<main>
  <h1>Profil</h1>
  <ul>
    <li>Prénom: <?= $account["firstname"] ?></li>
    <li>Nom: <?= $account["lastname"] ?></li>
    <li>Email: <?= $account["email"] ?></li>
    <li>Adresse: <?= $account["address"] ?></li>
    <li>Code postal: <?= $account["zipcode"] ?></li>
    <li>Compte mise à jour le <abbr title="<?= date_format($updatedAt, $simpleDateFormat) ?>"><?= date_format($updatedAt, $dateFormat) ?></abbr></li>
    <li>Compte créer le <abbr title="<?= date_format($createdAt, $simpleDateFormat) ?>"><?= date_format($createdAt, $dateFormat) ?></abbr></li>
  </ul>
  <a href="index.php?page=<?= PAGE_MODIFY_PROFILE ?>" class="btn btn-primary">Modifier mon profil</a>
</main>