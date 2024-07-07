<div class="">
    <div>
        <h2 class="title text-center mt-3 mb-4">Contactez-nous</h2>
        <hr>
    </div>
    <?php
    if ($_POST) {
        // Get data's form
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
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
    <div class="">
        <form class="form m-auto gap-4" action="" method="POST">
            <div class="d-flex flex-column gap-1">
                <label for="name">Nom</label>
                <input type="text" class="input-form" id="name" name="name" placeholder="Nom" required>
            </div>
            <div class="d-flex flex-column gap-1">
                <label for="email">Email</label>
                <input type="email" class="input-form" id="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="d-flex flex-column gap-1">
                <label for="subject">Sujet</label>
                <input type="text" class="input-form" id="subject" name="subject" placeholder="Sujet" required>
            </div>
            <div class="d-flex flex-column gap-1">
                <label for="message">Message</label>
                <textarea class="textarea" id="message" name="message" rows="5" placeholder="Tapez votre message..."
                    required></textarea>
            </div>
            <div class="m-auto">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</div>