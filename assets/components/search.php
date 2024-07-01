<?php

class SearchForm extends BDD
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSuggestions()
    {
        $query = "SELECT name FROM candy";  // Assurez-vous que 'name' correspond à votre colonne dans la table
        $stmt = $this->connection->query($query);
        $suggestions = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $suggestions[] = $row['name'];  // Utilisez 'name' pour récupérer la suggestion
        }

        return $suggestions;
    }

    public function render()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style>
                /* .logo_search {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 50px;
                    position: relative;
                } */

                .candy_shop_pic {
                    width: 250px;
                }

                /* .search {
                    display: flex;
                    gap: 5px;
                    position: absolute;
                    bottom: 17%;
                    left: 40%;
                } */
            </style>
        </head>

        <body>
            <div class="container mt-4 logo_search d-flex flex-column">
                <img class="candy_shop_pic m-auto" src="../assets/images/search/candy-shop.png" alt="">
                <div class="search m-auto">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" list="suggestions">
                        <datalist id="suggestions">
                            <?php
                            $suggestions = $this->getSuggestions();
                            foreach ($suggestions as $suggestion) {
                                echo "<option value='" . htmlspecialchars($suggestion) . "'>";
                            }
                            ?>
                        </datalist>
                        <button type="button" id="button-addon2" class="btn btn-primary"><img
                                src="../../assets/images/icon/search.svg"></button>
                    </div>
                </div>
            </div>
        </body>

        </html>
        <?php
    }
}
?>