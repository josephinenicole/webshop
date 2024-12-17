<?php
require_once '../db.php';
$produkte=array();
$result=$db->query("SELECT id,artikel,hersteller,bild,kurzbeschreibung,detailbeschreibung,preis,gewicht,attribute FROM `produkt` order by artikel"); 
while($produkt=$result->fetch_object()){
  $produkte[]=$produkt;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Secudrive Webshop - Adminbereich</title>
	<script>
   function loeschen(id,artikel) {
			if(confirm(artikel+'Wollen Sie den Artikel wirklich löschen?')) {
				location.href='artikel_loeschen.php?id='+id;
			}
		}
  </script>
</head>
<body>
<h1>Secudrive Webshop - Adminbereich</h1>
<a href="artikel_bearbeiten.php">Neuer Artikel</a>
<table border="1" style="border-collapse:collapse;">
	<tr>
		<th>Id</th>
    <th>Artikel</th>
    <th>Hersteller</th>
		<th>Bild</th>
		<th>kurzbeschreibung</th>
    <th>Detailbeschreibung</th>
    <th>Preis</th>
    <th>Gewicht</th>
    <th>Attribute</th>
		<th></th>
	</tr>
<?php
foreach($produkte as $produkt) {
?>
	<tr>
		<td><?= htmlentities($produkt->id,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->artikel,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->hersteller,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->bild,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->kurzbeschreibung,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->detailbeschreibung,ENT_COMPAT) ?></td>
		<td><?php printf("%.2f",$produkt->preis) ?> €</td>
		<td><?= htmlentities($produkt->gewicht,ENT_COMPAT) ?></td>
		<td><?= htmlentities($produkt->attribute,ENT_COMPAT) ?></td>
		<td>
			<a href="artikel_anzeigen.php?id=<?= htmlentities($produkt->id,ENT_COMPAT) ?>">Artikel anzeigen</a>
			<button type="button" onclick="loeschen(<?= htmlentities($produkt->id,ENT_COMPAT) ?>,<?= htmlentities(json_encode($produkt->artikel),ENT_COMPAT) ?>)">Artikel löschen</button>
			<a href="artikel_bearbeiten.php?id=<?= htmlentities($produkt->id,ENT_COMPAT) ?>">Artikel bearbeiten</a>
		</td>
	</tr>
<?php
}
?>
</table>
</body>
</html>