<?php
@session_start();
require_once 'db.php';

$seitentitel = 'Secudrive Webshop - Warenkorb';
require_once 'seitenanfang.php';

// Prüfen, ob der Warenkorb nicht leer ist
if (!empty($_SESSION['warenkorb'])) {
    // Weiterleitung zur Seite zum Abschluss der Bestellung
    header('Location: bestellung_abschließen.php');
    exit;
} else {
    echo "<p>Dein Warenkorb ist leer.</p>";
}

require_once 'seitenende.php';
?>
