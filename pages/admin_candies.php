<main>
  <h1 class="text-center" style="padding-block: 4rem; font-family: var(--ff-inknut-antiqua)">Liste des bonbons</h1>
  <div class="table-responsive mx-auto" style="width: 90%; max-width: 1200px;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center align-middle" scope="col">#</th>
          <th class="text-center align-middle" scope="col">Nom du bonbon</th>
          <th class="text-center align-middle" scope="col">Prix de base</th>
          <th class="text-center align-middle" scope="col">Quantité en stock</th>
          <th class="text-center align-middle" scope="col">Nom de la marque</th>
          <th class="text-center align-middle" scope="col">Catégories du bonbon</th>
          <th class="text-center align-middle" scope="col">Image</th>
          <th class="text-center align-middle" scope="col">Date de modification</th>
          <th class="text-center align-middle" scope="col">Date de publication</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($candies as $candy) { ?>
          <tr>
            <th class="text-center align-middle" scope="row"><?= htmlspecialchars($candy["id"]) ?></th>
            <td class="align-middle"><?= htmlspecialchars($candy["name"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($candy["price"]) ?> €</td>
            <td class="align-middle"><?= htmlspecialchars($candy["nb_stock"]) ?></td>
            <td class="align-middle"><?= $request->getCandyMark($candy["id"])["name"] ?></td>
            <td class="align-middle"><?= $request->getCandyCategoriesInString($candy["id"]) ?></td>
            <td class="align-middle"><img class="d-block w-100 mx-auto" style="max-width: 100px;" src="./assets/images/candies/<?= htmlspecialchars($candy["image"]) ?>" alt=""></td>
            <td class="align-middle"><?= htmlspecialchars($candy["updated_at"]) ?></td>
            <td class="align-middle"><?= htmlspecialchars($candy["created_at"]) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>