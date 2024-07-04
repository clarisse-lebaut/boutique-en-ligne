<div class="">
    <div>
        <h2 class="title text-center mt-3 mb-4">Contactez-nous</h2>
        <hr>
    </div>
    <?php
    if ($_POST) {
        // Récupération des données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Validation simple (vous pouvez ajouter plus de validation)
        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            // Traitement des données, par exemple, les enregistrer dans une base de données ou les envoyer par email
            // Pour l'instant, nous allons simplement les afficher
            echo "<div class='request-test'>";
            echo "Nom: " . $name . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Sujet: " . $subject . "<br>";
            echo "Message: " . $message . "<br>";
            echo "</div>";
        } else {
            echo "Données invalides.";
        }
    } else {
        echo "<div class='request-test'>";
        echo "Méthode de requête non autorisée.";
        echo "</div>";
    }
    ?>
    <div class="m-auto w-50 form">
        <form action="" method="POST">
            <div class="contact-form">
                <div class="left">
                    <div class="form-group">
                        <input type="text" class="form-control input-form" id="name" name="name" placeholder="Nom"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-form" id="email" name="email" placeholder="E-mail"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-form" id="subject" name="subject"
                            placeholder="Sujet" required>
                    </div>
                </div>
                <div class="right">
                    <div class="form-group">
                        <textarea class="textarea" id="message" name="message" rows="5"
                            placeholder="Tapez votre message..." required></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>