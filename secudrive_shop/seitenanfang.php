<?php

$seitentitel = "🛡️Secudrive Onlineshop";
require_once 'seitenanfang.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!-- As a heading -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"></span>
    <img src="" alt="">
  </div>
</nav>
  <title><?= htmlentities($seitentitel,ENT_COMPAT) ?><?= htmlentities($seitentitel,ENT_COMPAT) ?></title>
  <style>
    @media screen and (min-width:800px) {
      #menue {
        border:1px solid black;
        padding-top:1vh;
        padding-bottom:1vh;
        padding-left:1vw;
        padding-right:1vw;
      }
      #menue a {
        display:inline-block;
      }
      #menue .trenner {
        display:inline-block;
        padding-left:15px;
        padding-right:15px;
      }
      #menue #oeffner {
        display:none;
      }
    }
    @media screen and (max-width:800px) {
      #menue #oeffner {
        display:block;
      }
      #menue a {
        display:none;
      }
      #menue .trenner {
        display:none;
      }
      #menue:hover {
        display:inline-block;
        border:1px solid black;
        padding:5px;
        margin-right:1em;
        margin-bottom:1em;
      }
      #menue:hover #oeffner {
        display:none;
      }
      #menue:hover a {
        display:block;
      }
    }
    a {
      color:black;
      text-decoration:none;
    }
    a:hover {
      background-color:rgb(200,200,200);
    }
    a.knopf {
      display:inline-block;
      border:1px solid black;
      background-color:rgb(220,220,220);
      color:black;
      padding:2px;
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <a href="index.php" class="btn btn-succes">
    <h1><?= htmlentities($seitentitel,ENT_COMPAT) ?></h1>
  </a>
<div id="menue">
  <div id="oeffner">☰</div>
  <a href="index.php">Produktsuche</a>
  <div class="trenner">|</div>
  <a href="warenkorb.php">Warenkorb</a>
</div>
  <!-- Bootstrap JavaScript einbinden (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<br />