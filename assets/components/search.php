<?php

class SearchForm
{
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
                .logo_search {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 100px;
                    position: relative;
                }

                .candy_shop_pic {
                    width: 250px;
                }

                .search {
                    display: flex;
                    gap: 5px;
                    position: absolute;
                    bottom: 24.3%;
                    left: 41%;
                }
            </style>
        </head>

        <body>
            <div class="container mt-4 logo_search">
                <img class="candy_shop_pic" src="../assets/images/search/candy-shop.png" alt="">
                <div class="search">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username"
                            aria-describedby="button-addon2" method="POST">
                        <button type="button" id="button-addon2" class="btn btn-primary"><img src="../../assets/images/icon/search.svg"></button>
                    </div>
                </div>
            </div>
        </body>

        </html>
        <?php
    }
}
?>