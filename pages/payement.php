<?php
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
$payment_success = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $amount = $_POST['amount'];
    $card_number = $_POST['card_number'];

    // Logique de traitement de paiement fictif
    // Ici, vous pouvez ajouter votre propre logique pour traiter les données de paiement

    // Simuler un succès ou un échec de paiement
    $payment_success = true; // ou false pour simuler un échec

    // Affichage du résultat du paiement
    if ($payment_success) {
        $message = 'PAIEMENT OK !';
    } else {
        $message = 'PAIEMENT PAS OK !';
    }
}
?>

<h1>Page de paiement</h1>
<p>Le montant total de votre panier est : <?= htmlspecialchars($total) ?> €</p>

<!-- Affichage du message de résultat du paiement -->
<?php if ($payment_success !== null): ?>
    <p><?= $message ?></p>
<?php endif; ?>

<!-- Formulaire de paiement -->
<form action="" method="post">
    <input type="hidden" name="amount" value="<?= htmlspecialchars($total) ?>">
    <label for="card_number">Numéro de carte:</label>
    <input type="text" id="card_number" name="card_number" required><br><br>
    <input type="submit" value="Payer">
</form>