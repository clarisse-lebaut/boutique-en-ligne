<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Liste des utilisateurs</h1>
  <div class="table-responsive mx-auto" style="width: 90%; max-width: 1200px;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center align-middle" scope="col">#</th>
          <th class="text-center align-middle" scope="col">Prénom</th>
          <th class="text-center align-middle" scope="col">Nom de famille</th>
          <th class="text-center align-middle" scope="col">Email</th>
          <th class="text-center align-middle" scope="col">Role</th>
          <th class="text-center align-middle" scope="col">Date de la dernière mise à jour du compte</th>
          <th class="text-center align-middle" scope="col">Date de création du compte</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($accounts as $account) { ?>
          <tr>
            <th class="text-center align-middle" scope="row"><?= htmlspecialchars($account["id"]) ?></th>
            <td class="align-middle"><?= htmlspecialchars($account["firstname"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($account["lastname"]) ?></td>
            <td class="align-middle"><a href="mailto:<?= htmlspecialchars($account["email"]) ?>"><?= htmlspecialchars($account["email"]) ?></a></td>
            <td class="align-middle"><?= htmlspecialchars($account["role"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($account["updated_at"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($account["created_at"]) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>