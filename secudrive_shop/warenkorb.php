<?php
@session_start();
require_once 'db.php';

$produkte=[];
$result=$db->query("SELECT id,artikel,preis FROM `produkt` where id in(".implode(',',array_keys($_SESSION['warenkorb'])).")");
while($produkt=$result->fetch_object()) {
  $produkte[]=$produkt;
}
$result->free();

$seitentitel='Secudrive Webshop - Warenkorb';
require_once 'seitenanfang.php';
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
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap; /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
    }

    .col-25 {
      -ms-flex: 25%; /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%; /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%; /* IE10 */
      flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    .container {
      background-color: #f2f2f2;
      padding: 5px 20px 15px 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
      margin-top: 10px; 
    }

    input[type=text] {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btn {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    a {
      color: #2196F3;
    }

    hr {
      border: 1px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
    }
  </style>
</head>
<body>
<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Artikel</th>
        <th>Preis</th>
        <th>Anzahl</th>
        <th>Gesamtpreis</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $gesamtsumme=0.0;
      foreach($produkte as $produkt) {
        $anzahl=$_SESSION['warenkorb'][$produkt->id];
        $gesamtpreis = $produkt->preis * $anzahl;
        $gesamtsumme += $gesamtpreis;
      ?>
        <tr>
          <td><?= htmlentities($produkt->id, ENT_COMPAT) ?></td>
          <td><?= htmlentities($produkt->artikel, ENT_COMPAT) ?></td>
          <td><?php printf("%0.2f €", $produkt->preis) ?></td>
          <td><?= htmlentities($anzahl, ENT_COMPAT) ?></td>
          <td><?php printf("%0.2f €", $gesamtpreis) ?></td>
          <td>
            <a href="artikel_anzeigen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>" class="btn btn-primary">Artikel anzeigen</a>
          </td>
          <td>
            <a href="artikel_hinzufuegen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>" class="btn btn-primary">Artikel hinzufügen</a>
          </td>
          <td>
            <a href="artikel_entfernen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>" class="btn btn-primary">Artikel entfernen</a>
          </td>
        </tr>       
      <?php
      }
      ?>
      <tr>
        <th align="right" colspan="4">Gesamtpreis:</th>
        <th><?php printf("%0.2f €", $gesamtsumme) ?></th>
        <th></th>
      </tr>
    </tbody>
  </table>
</div>

<a href="zur_kasse.php" class="btn btn-primary" style="margin-top: 10px; margin-left: 5px;">Zur Kasse gehen</a>
<a href="index.php" class="btn btn-primary" style="margin-top: 10px; margin-left: 20px;">Weiter einkaufen</a>



<?php
require_once 'seitenende.php';
?>
</body>
</html>
