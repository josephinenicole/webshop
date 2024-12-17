<?php
@session_start();
require_once 'db.php';
$seitentitel = 'Secudrive Onlineshop';

$suche = '';
if(isset($_POST['suche'])) {
  $suche = $_POST['suche'];
  $_SESSION['suche'] = $suche;
} else if(isset($_SESSION['suche'])) {
  $suche = $_SESSION['suche'];
}

$produkte = [];
if(!empty($suche)) {
  $suchkriterium = '%'.$suche.'%';
  $stmt = $db->prepare("SELECT id, artikel, preis FROM `produkt` WHERE artikel LIKE ? OR kurzbeschreibung LIKE ?");
  $stmt->bind_param('ss', $suchkriterium, $suchkriterium);
  $stmt->execute();
  $result = $stmt->get_result();
  while($produkt = $result->fetch_object()) {
    $produkte[] = $produkt;
  }
  $result->free();
}

require_once 'seitenanfang.php';
?>
<!DOCTYPE html>
<html lang="de">
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
  <body>

  <!-- Produktsuche + Treffer anzeigen + in den Warenkorb hinzufügen -->
  <div class="container">
    <form action="index.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
      <div class="mb-3">
        <label for="suche" class="form-label">Produktsuche:</label>
        <input type="text" class="form-control" id="suche" name="suche" value="<?= htmlentities($suche, ENT_COMPAT) ?>">
      </div>
      <button type="submit" class="btn btn-primary">🔍 Suchen</button>
    </form>
    <br>
    <?php if(empty($produkte)) : ?>
      <?php if(empty($suche)) : ?>
        <p>Tolle Produkte im Angebot! Benutzen Sie die Suchfunktion!</p>
      <?php else : ?>
        <p>Keine Produkte gefunden :-(</p>
      <?php endif; ?>
    <?php else : ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Produkt-ID</th>
            <th scope="col">Bezeichnung</th>
            <th scope="col">Preis</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($produkte as $produkt) : ?>
            <tr>
              <td><?= htmlentities($produkt->id, ENT_COMPAT) ?></td>
              <td><?= htmlentities($produkt->artikel, ENT_COMPAT) ?></td>
              <td><?= number_format($produkt->preis, 2) ?> €</td>
              <td>
                <a href="artikel_anzeigen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>"class="btn btn-primary">Anzeigen</a>
                <a href="artikel_hinzufuegen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>"class="btn btn-success">In den Warenkorb</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <!-- Bootstrap JavaScript einbinden (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php require_once 'seitenende.php'; ?>
