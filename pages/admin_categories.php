<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Liste des catégories</h1>
  <div class="table-responsive mx-auto" style="width: 90%; max-width: 1200px;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center align-middle" scope="col">#</th>
          <th class="text-center align-middle" scope="col">Nom de la catégorie</th>
          <th class="text-center align-middle" scope="col">Date de modification</th>
          <th class="text-center align-middle" scope="col">Date de publication</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) { ?>
          <tr>
            <th class="text-center align-middle" scope="row"><?= htmlspecialchars($category["id"]) ?></th>
            <td class="align-middle"><?= htmlspecialchars($category["name"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($category["updated_at"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($category["created_at"]) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>