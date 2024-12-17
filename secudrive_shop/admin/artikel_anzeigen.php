<?php
require_once '../db.php';

if(!isset($_GET['id'])) {
	header('Location:index.php');
	exit;
}
$id=(int)$_GET['id'];
if($id<=0) {
	header('Location:index.php');
	exit;
}

$stmt=$db->prepare("SELECT * FROM `produkt` where id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
$result=$stmt->get_result();
$produkt=$result->fetch_object();
$result->free();
if(!$produkt) {
	//nicht gefunden
	header('Location:index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Secudrive Webshop - Artikel anzeigen</title>
</head>
<body>
<h1>Secudrive Webshop - Adminbereich</h1> 
<h2>Artikel anzeigen</h2>
<h2><?= htmlentities($produkt->artikel,ENT_COMPAT) ?></h2>
<div class="preis"><?php printf("%0.2f",$produkt->preis) ?> €</div>
<div class="kurzbeschreibung"><?= nl2br($produkt->kurzbeschreibung,ENT_COMPAT) ?></div>
<a href="index.php">Zurück zur Liste</a> <a href="artikel_bearbeiten.php?id=<?= htmlentities($produkt->id,ENT_COMPAT) ?>">Artikel bearbeiten</a>
</body>
</html>

