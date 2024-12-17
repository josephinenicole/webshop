<?php
@session_start();
require_once 'db.php';
$seitentitel = 'Secudrive Onlineshop';

$produkte=[];
$result=$db->query("SELECT id,artikel,preis FROM `produkt` where id in(".implode(',',array_keys($_SESSION['warenkorb'])).")");
while($produkt=$result->fetch_object()) {
  $produkte[]=$produkt;
}
$result->free();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $seitentitel ?></title>
  <!-- Bootstrap CSS einbinden -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 0 20px;
    }

    .order {
      border: 1px solid #ddd;
      padding: 20px;
      margin-top: 20px;
    }

    .product {
      margin-bottom: 10px;
    }

    footer {
      margin-top: 50px;
    }

  </style>
</head>
  <body>
  <div class="container">
    <h1 class="text-center">Bestellübersicht <i class="bi bi-cart"></i></h1>
    <hr>
    <div class="order">
      <h2>Bestellung #12345</h2>
      <p>Bestelldatum: <?php echo date("d. F Y"); ?></p>
      <hr>

      <h3>Lieferadresse</h3>
      <p>E-Mail-Adresse: <?php echo $_POST["email"]; ?></p>
      <p>Adresse: <?php echo $_POST["adress"]; ?></p>
      <p>Stadt: <?php echo $_POST["city"]; ?></p>
      <p>Bundesland: <?php echo $_POST["state"]; ?></p>
      <p>Postleitzahl: <?php echo $_POST["zip"]; ?></p>
      <hr>

      <h3>Zahlungsinformationen</h3>
      <p>Karteninhaber/in: <?php echo $_POST["cardname"]; ?></p>
      <p>Kreditkartennummer: <?php echo $_POST["cardnumber"]; ?></p>
      <p>Karte gültig bis: <?php echo $_POST["expdate"]; ?></p>
      <p>CVV: <?php echo $_POST["cvv"]; ?></p>
      <hr>

      <h3>Artikel</h3>
      <?php
      $gesamtsumme = 0.0;
      foreach($produkte as $produkt) {
        $anzahl = $_SESSION['warenkorb'][$produkt->id];
        $gesamtpreis = $produkt->preis * $anzahl;
        $gesamtsumme += $gesamtpreis;
      ?>
      <div class="product">
        <div class="row">
          <div class="col"><?php echo $produkt->artikel; ?></div>
          <div class="col text-end"><?php printf("%0.2f €", $gesamtpreis); ?></div>
        </div>
      </div>
      <?php } ?>
      <div class="row">
        <div class="col"><strong>Gesamtpreis:</strong></div>
        <div class="col text-end"><?php printf("%0.2f €", $gesamtsumme); ?></div>
      </div>
    </div>
  </div>

  <footer class="text-center mt-4">
    <p>Diese Bestellbestätigung bestätigt lediglich den Eingang Ihrer Bestellung, sie stellt noch keine Annahme Ihrer Bestellung dar.</p>
    <p>Die Rechnung zu Ihrer Bestellung erhalten Sie per E-Mail nach Versand Ihrer Lieferung.</p>
    <p>Wir freuen uns auf Ihren nächsten Besuch auf <a href="index.php">secudrive.de</a></p>
  </footer>
    <!-- Bootstrap JavaScript einbinden (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
  </body>
</html>
