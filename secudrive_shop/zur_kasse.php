<?php
@session_start();
require_once 'db.php';
$seitentitel = 'Secudrive Onlineshop';
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
 
    .container {
        display: block; 
        padding: 32px; 
        width: 450px; 
        height: 275px; 
        margin-top: 50px;
        background-color: lightgray; 
    }

    .p-title {
      font-size: 20px;
      color: #353b42; 
      font-weight: bold;
    }
    .p-subtitle {
      font-size: 16px;
      margin-top: 20px;
    }
  </style>
  <body>
  
  <div class="container">
    <p class="p-title">Willkommen im Secudrive Onlineshop</p>
    <p class="p-subtitle">Um fortzufahren brauchst du ein Kundenkonto. 
      <br>
      Registriere dich, um ein Kundenkonto zu erstellen.
    </p>
 
    <p>
      <a class="btn btn-primary" href="checkout.php" role="button" style="width: 95%; margin-top: 25px;">JETZT KOSTENLOS REGISTRIEREN</a>
    </p>
  </div>
  
  <!-- Bootstrap JavaScript einbinden (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php require_once 'seitenende.php'; ?>
