<?php
@session_start();
require_once 'db.php';

// Überprüfen, ob $_SESSION['checkout'] existiert und ein Array ist
if (isset($_SESSION['test_checkout']) && is_array($_SESSION['test_checkout'])) {
    // Wenn $_SESSION['checkout'] ein Array ist, dann kann die array_keys()-Funktion verwendet werden
    $ids = implode(',', array_keys($_SESSION['test_checkout']));

    // IDs der Select-Abfragen verwenden
    $query = "SELECT name,email,adresse,stadt,bundesland,postleitzahl,karteninhaber,kreditkartennummer,gueltig_monat,gueltig_jahr,karte_cvv
    FROM `registerform` WHERE id IN ($ids)";

    // Führt die Abfrage aus
    $result = $db->query($query);

    // Überprüft, ob die Abfrage erfolgreich war
    if (!$result) {
        die('Abfragefehler: ' . $db->error);
    }

    // // Verarbeitet das Ergebnis
    // $registerforme = array();
    // while ($registerform = $result->fetch_object()) {
    //     $registerforme[] = $registerform;
    // }
} else {
    // Wenn $_SESSION['checkout'] nicht existiert oder kein Array ist, handle den Fehler hier
    echo "Fehler: Die Sitzungsvariable 'checkout' ist nicht korrekt initialisiert oder kein Array.";
}

// define variables and set to empty values
$name = $email = $adress = $city = $state = $zip = $cardname = $cardnumber = $expdate = $cvv ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $adress = test_input($_POST["adress"]);
  $city = test_input($_POST["city"]);
  $state = test_input($_POST["state"]);
  $zip = test_input($_POST["zip"]);
  $cardname = test_input($_POST["cardname"]);
  $cardnumber = test_input($_POST["cardnumber"]);
  $expdate = test_input($_POST["expdate"]);
  $cvv = test_input($_POST["cvv"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$produkte=[];
$result=$db->query("SELECT id,artikel,preis FROM `produkt` where id in(".implode(',',array_keys($_SESSION['warenkorb'])).")");
while($produkt=$result->fetch_object()) {
  $produkte[]=$produkt;
}
$result->free();

$seitentitel = 'Secudrive Onlineshop';
require_once 'seitenanfang.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
 
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        
          <div class="row">
            <div class="col-50">
              <h3>Rechnungsanschrift</h3>
              <label for="name"><i class="fa fa-user"></i> Name</label>
              <input type="text" id="name" name="name" placeholder="Mimi M. Mustermann">
              <label for="email"><i class="fa fa-envelope"></i> E-Mail-Adresse</label>
              <input type="text" id="email" name="email" placeholder="muster@beispiel.com">
              <label for="adress"><i class="fa fa-address-card-o"></i> Adresse</label>
              <input type="text" id="adress" name="adress" placeholder="Musterstraße 123">
              <label for="city"><i class="fa fa-institution"></i> Stadt</label>
              <input type="text" id="city" name="city" placeholder="Berlin">

              <div class="row">
                <div class="col-50">
                  <label for="state">Bundesland</label>
                  <input type="text" id="state" name="state" placeholder="Berlin">
                </div>
                <div class="col-50">
                  <label for="zip">Postleitzahl</label>
                  <input type="text" id="zip" name="zip" placeholder="12345">
                </div>
              </div>
            </div>

            <div class="col-50">
              <h3>Zahlungsmethoden</h3>
              <label for="fname">Anerkannte Kredikarten</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
              </div>
              <label for="cardname">Name des Karteninhabers</label>
              <input type="text" id="cardname" name="cardname" placeholder="John More Doe">
              <label for="cardnumber">Kreditkarten</label>
              <input type="text" id="cardnumber" name="cardnumber" placeholder="1111-2222-3333-4444">
              <label for="expdate">Karte gültig bis</label>
              <input type="text" id="expdate" name="expdate" placeholder="September">
              <div class="row">
              <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" name="cvv" placeholder="352">
                </div>
              </div>
            </div>
            
          </div>
          <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" value="Submit" class="btn">
        </form>
      </div>
    </div>

    <?php
      echo "<h2>Deine Angaben</h2>";
      echo $name;
      echo "<br>";
      echo $email;
      echo "<br>";
      echo $adress;
      echo "<br>";
      echo $city;
      echo "<br>";
      echo $state;
      echo "<br>";
      echo $zip;
      echo "<br>";
      echo $cardname;
      echo "<br>";
      echo $expdate;
      echo "<br>";
      echo $cvv;
      echo "<br>";
    ?>
    <div class="col-25">
      <div class="container">
        <h4>Artikelübersicht <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i></span></h4>
        <?php
        $gesamtsumme=0.0;
      foreach($produkte as $produkt) {
        $anzahl=$_SESSION['warenkorb'][$produkt->id];
        $gesamtpreis = $produkt->preis * $anzahl;
        $gesamtsumme += $gesamtpreis;
      ?>
        
        <!-- <th style="text-align: right;" colspan="4"><?= nl2br(htmlentities($produkt->artikel, ENT_COMPAT)) ?></th> -->
        <?php printf($produkt->artikel) ?>
        <!-- <?php printf("%0.2f €", $produkt->preis) ?></td>  -->
        <!-- <td><?= htmlentities($anzahl, ENT_COMPAT) ?></td> -->
        <th style="text-align: right;" colspan="4"><?php printf("%0.2f €", $gesamtpreis) ?></th> <br>     
      <?php
      }
      ?>
      <tr>
        <th style="text-align: right;" colspan="4">Gesamtpreis:</th>
        <th><?php printf("%0.2f €", $gesamtsumme) ?></th>
        <th></th>
      </tr>
      <!-- Eingabefeld für Produkte -->

      <!-- Weitere Produkte hier hinzufügen -->
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript einbinden (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php require_once 'seitenende.php'; ?>
