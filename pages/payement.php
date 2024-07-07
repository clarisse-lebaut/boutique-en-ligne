<?php
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
$payment_success = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get date from the form
    $amount = $_POST['amount'];
    $card_number = $_POST['card_number'];

    // False success or failure
    $payment_success = true; // or false for failure, just for the test

    // show th result
    if ($payment_success) {
        $message = 'PAIEMENT OK !';
    } else {
        $message = 'PAIEMENT PAS OK !';
    }
}
?>

<h2 class="title text-center mt-3 mb-4">Page de paiement</h2>
<hr>
<section class="m-auto mt-4 text-center">
    <div class="payment-form">
        <p>Montant de votre panier</p>
        <p class="amount"><?= htmlspecialchars($total) ?> €</p>

        <!-- Payement form -->
        <form class="d-flex flex-column" action="" method="post">
            <input type="hidden" name="amount" value="<?= htmlspecialchars($total) ?>">
            <label class="mb-2" for="card_number">Numéro de carte:</label>
            <input class="payment-input" type="number" id="card_number" name="card_number" required><br><br>
            <input class="btn btn-primary" type="submit" value="Payer">
        </form>
    </div>
    <div>
        <!-- Show result msg for payement -->
        <?php if ($payment_success !== null): ?>
            <p class="payment-message"><?= $message ?></p>
        <?php endif; ?>
    </div>
    <a href="index.php?page=<?= PAGE_HOME ?>">Accueil</a>
</section>