<?php
@session_start();
require_once 'db.php'; // Stellen Sie sicher, dass die Datenbankverbindung vorhanden ist

// ID des zu kaufenden Produkts aus der URL holen und prüfen
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    if (!isset($_SESSION['warenkorb'])) {
        // Wenn es noch keinen Warenkorb gibt, erstellen Sie ihn mit der Produkt-ID als Key und Anzahl == 1 als Value
        // und in die Session merken
        $_SESSION['warenkorb'] = array($id => 1);
    } else if (!isset($_SESSION['warenkorb'][$id])) {
        // Wenn es schon einen Warenkorb gibt, der aber diese Produkt-ID noch nicht enthält
        // fügen wir die Produkt-ID als Key hinzu, mit Anzahl == 1 als Value
        $_SESSION['warenkorb'][$id] = 1;
    } else {
        // Wenn es den Warenkorb schon gibt, und er diese Produkt-ID als Key schon enthält,
        // zählen wir den entsprechenden Value (d.h. die Anzahl) hoch.
        $_SESSION['warenkorb'][$id]--;
        // alternative Schreibweise: $_SESSION['warenkorb'][$id] = $_SESSION['warenkorb'][$id]+1;
    }
} else {
    // Reduziere die Anzahl des Artikels im Warenkorb, wenn die ID nicht vorhanden ist und die Anzahl größer als 0 ist
    if (isset($_SESSION['warenkorb']) && isset($_SESSION['warenkorb'][$id]) && $_SESSION['warenkorb'][$id] > 0) {
        $_SESSION['warenkorb'][$id]--;
    }
}

header('Location: warenkorb.php');
exit;
?>
