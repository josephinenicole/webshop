<?php
require_once '../db.php';

$id=isset($_POST['id']) ? (int)$_POST['id'] : 0; 
// ID==0 ist OK und bedeutet "Produkt hinzufügen"  

$artikel=isset($_POST['artikel']) ? $_POST['artikel'] : false;
if(empty($artikel)) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$hersteller=isset($_POST['hersteller']) ? $_POST['hersteller'] : false;
if(empty($hersteller)) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$bild=''; 
if(isset($_FILES['bild']) && file_exists($_FILES['bild']['tmp_name'])) {
	$bild = $_FILES['bild']['name']; 
  $path='../assets/img/'. $bild;
  if(move_uploaded_file($_FILES['bild']['tmp_name'],$path)) {
    chmod($path,0644);
  }
}
$kurzbeschreibung=isset($_POST['kurzbeschreibung']) ? $_POST['kurzbeschreibung'] : false;
if(empty($kurzbeschreibung)) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$detailbeschreibung=isset($_POST['detailbeschreibung']) ? $_POST['detailbeschreibung'] : false;
if(empty($detailbeschreibung)) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$preis=(float)$_POST['preis'];
if($preis<=0.0) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$gewicht=(float)$_POST['gewicht'];
if($gewicht<=0.0)  {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
$attribute=isset($_POST['attribute']) ? $_POST['attribute'] : false;
if(empty($attribute)) {
	header('Location:artikel_bearbeiten.php?id='.$id);
	exit;
}
								
if($id>0) {
	$stmt=$db->prepare("UPDATE `produkt` SET `artikel` = ?, `hersteller` = ?, `kurzbeschreibung` = ?, `detailbeschreibung` = ?, `preis` = ?,`gewicht` = ?, `attribute` = ?  WHERE `produkt`.`id` = ?");
	$stmt->bind_param('ssssddsi',$artikel,$hersteller,$kurzbeschreibung,$detailbeschreibung,$preis,$gewicht,$attribute,$id);
	$stmt->execute();
	if (!empty($bild)) {
		$stmt=$db->prepare("UPDATE `produkt` SET `bild` = ? WHERE `produkt`.`id` = ?");
		$stmt->bind_param('si',$bild,$id);
		$stmt->execute();
	}
} else {
	$stmt=$db->prepare("INSERT INTO `produkt` (`artikel`, `hersteller`, `kurzbeschreibung`, `bild`, `detailbeschreibung`, `preis`,`gewicht`, `attribute`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param('sssssdds',$artikel,$hersteller,$kurzbeschreibung,$bild,$detailbeschreibung,$preis,$gewicht,$attribute);
	$stmt->execute();
	//$id=$stmt->insert_id  
}
header('Location:index.php');
exit;
?>