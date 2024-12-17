<?php
require_once 'db.php';

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

$seitentitel = 'Secudrive Onlineshop - ' . $produkt->artikel;
require_once 'seitenanfang.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlentities($seitentitel, ENT_COMPAT) ?></title>
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
	<div class="container" id="products">
		<div class="row row-cols-1 row-cols-md-2 g-4">
			<div class="col">
				<div class="card">
					<img src="assets/img/<?= htmlentities($produkt->bild, ENT_COMPAT) ?>" class="card-img-top" alt="laptop">
					<div class="card-body">
						<?php if(isset($produkt->artikel)): ?>
							<b style="font-size: 25px;"><?= htmlentities($produkt->artikel, ENT_COMPAT) ?></b>
						<?php endif; ?>
					<div class="card-footer">
						<div class="preis"><?php printf("%.2f", $produkt->preis) ?> €</div>
						<div class="kurzbeschreibung"><?= nl2br(htmlentities($produkt->kurzbeschreibung, ENT_COMPAT)) ?>		
					
						<div class="button-container" style="display: flex; justify-content: space-between; margin-top: 15px;">
								<div class="artikel-hinzufuegen">
										<p>
												<a class="btn btn-primary" style="background-color: red; border-color: red;" href="artikel_hinzufuegen.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">Artikel hinzufügen</a>
										</p>
								</div>
								<div>
										<p>
												<a href="artikel_reduzieren.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>" class="btn btn-primary">Artikel entfernen</a>
										</p>
								</div>
								<div class="artikel-warenkorb">
										<p>
												<a class="btn btn-primary" href="warenkorb.php?id=<?= htmlentities($produkt->id, ENT_COMPAT) ?>">In den Warenkorb</a>
										</p>
								</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php require_once 'seitenende.php'; ?>
