<?php
require_once '../db.php'; 
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id>0) {
  $db->query("delete FROM produkt WHERE id=".$id);
}
header('Location:index.php');
exit;
?>