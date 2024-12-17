<?php
require_once '../db.php';
$stmt=$db->prepare("delete from produkt where id=?"); ////////?????

$id=0;
if(isset($_GET['id'])) {	
	$id=(int)$_GET['id'];
	if($id<0) {
		header('Location:index.php');
		exit;
	}
}
$produkt=null;
if($id>0) {
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
}

if(!$produkt) {
	//NULL-Objekt Design-Pattern
	$produkt=(object)array(
		'id'=>0,
		'artikel'=>'',
		'bild'=> '', 
		'hersteller'=>'',
    'kurzbeschreibung'=>'',
		'detailbeschreibung'=>'',
    'preis'=>'',
		'gewicht'=>'',
		'attribute'=>''
	);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Secudrive Webshop - Adminbereich - Artikel bearbeiten</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<h1>Secudrive Webshop - Adminbereich</h1> 
<h2>Artikel bearbeiten</h2>

<form action="artikel_speichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<table border="1" cellspacing="0" style="border-collapse:collapse;">
	<input type="hidden" name="id" value="<?= $produkt->id ?>" />
  <tr>
    <th>Artikel</th>
	<td><input type="text" value="<?= htmlentities($produkt->artikel,ENT_COMPAT) ?>" name="artikel" /></td>
  </tr>
  <tr>

  <th>Hersteller</th>
	<td><input type="text" value="<?= htmlentities($produkt->hersteller,ENT_COMPAT) ?>" name="hersteller" /></td>
  </tr>
	</tr>
	<th>Bild</th>
	<td><input type="file" name="bild" /></td>
  </tr>
	<th>Kurzbeschreibung</th>
    <td><textarea name="kurzbeschreibung"><?= htmlentities($produkt->kurzbeschreibung,ENT_COMPAT) ?></textarea></td>
  </tr>
   <tr>
	<th>Detailbeschreibung</th>
    <td><textarea name="detailbeschreibung"><?= htmlentities($produkt->detailbeschreibung,ENT_COMPAT) ?></textarea></td>
  </tr>
  <tr>
  <th>Preis</th>
	<td><input type="number" name="preis" value="<?= htmlentities($produkt->preis,ENT_COMPAT) ?>" min="0" step="0.01" /></td>
  </tr>
  <th>Gewicht</th>
	<td><input type="number" name="gewicht" value="<?= htmlentities($produkt->gewicht,ENT_COMPAT) ?>" min="0" step="0.01" /></td>
  </tr>
  <th>Attribute</th>
	<td><input type="text" value="<?= htmlentities($produkt->attribute,ENT_COMPAT) ?>" name="attribute" /></td>
  <tr>
    <th></th>
	<td><input type="submit" value="Speichern" /> <a href="index.php">Zurück zur Artikelübersicht</a></td>
  </tr>
</table>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>