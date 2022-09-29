<?php
include_once('db_fuggvenyek.php');
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank - Kölcsönök</title>
</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a href="index.php">Kezdőlap</a>
  <a href="ugyfelek.php">Ügyfelek</a>
  <a href="folyoszamlak.php">Folyószámlák</a>
  <a href="atutalas.php">Átutalások</a>
  <a class="active">Kölcsönök</a>
</div>
<div class="title">
<h1>Új kölcsön felvétele</h1>
</div>
<div class="logorreg">
<?php

$fkvreq = 0;
$errormsg = '';

if (isset($_POST["folyoszamlapost"])) {
$errormsg = '';
$result = mysqli_query(adatbazis_csatlakozas(),"SELECT max(id) AS maxId FROM kolcson");
$row = mysqli_fetch_array($result);

$kolcson_id=$row["maxId"]+1;
$kolcson_mennyiseg = $_POST['kolcsonamount'];
$kolcson_folyoszamlaszam = $_POST['folyoszamlaszam'];

if ( $kolcson_mennyiseg!='' && $kolcson_folyoszamlaszam!='' && is_numeric($kolcson_folyoszamlaszam)) {


$result2 = mysqli_query(adatbazis_csatlakozas(),"SELECT nev FROM ugyfel WHERE id IN(SELECT ugyfelID FROM folyoszamla WHERE folyoszamlaszam=$kolcson_folyoszamlaszam)");
$row2 = mysqli_fetch_array($result2);
$kolcson_nev = $row2['nev'];

$result3 = mysqli_query(adatbazis_csatlakozas(),"SELECT FKV FROM ugyfel WHERE id IN(SELECT ugyfelID FROM folyoszamla WHERE folyoszamlaszam=$kolcson_folyoszamlaszam)");
$row3 = mysqli_fetch_array($result3);
$kolcson_fkv = $row3['FKV'];
 }else {
 $errormsg = "Helytelen, vagy nem létező folyószámlaszám!";
 }



$kolcsonfolyok = mysqli_query(adatbazis_csatlakozas(),"SELECT folyoszamlaszam FROM folyoszamla");

     while($sorok = mysqli_fetch_assoc($kolcsonfolyok )) {
     $kolcsonfolyo[] = $sorok['folyoszamlaszam'];
      }
        if (in_array($kolcson_folyoszamlaszam, $kolcsonfolyo)) {



            switch ($kolcson_mennyiseg) {
                case 50000:
                            if($kolcson_fkv >=1) {
                              mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                              mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                              $errormsg = '';
                              header("Location: kolcson.php");
                            }else {
                                $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                 }
                    break;
                case 100000:
                            if($kolcson_fkv >=1) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                    break;
                case 250000:
                            if($kolcson_fkv >=2) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                    break;
                case 500000:
                            if($kolcson_fkv >=2) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                    break;
                case 1000000:
                            if($kolcson_fkv >=3) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                    break;
                case 2400000:
                            if($kolcson_fkv >=3) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                    break;
                case 3000000:
                            if($kolcson_fkv >=4) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                     break;
                case 4500000:
                            if($kolcson_fkv >=4) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                     break;
                case 5000000:
                            if($kolcson_fkv >=5) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                     break;
                case 8000000:
                            if($kolcson_fkv >=5) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                     break;
                case 10000000:
                            if($kolcson_fkv >=5) {
                               mysqli_query(adatbazis_csatlakozas(),"INSERT INTO kolcson (id, mennyiseg, ki, folyoszamlaszam) VALUES ('$kolcson_id', '$kolcson_mennyiseg','$kolcson_nev','$kolcson_folyoszamlaszam');");
                               mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$kolcson_mennyiseg WHERE $kolcson_folyoszamlaszam = folyoszamlaszam");
                               $errormsg = '';
                               header("Location: kolcson.php");
                             }else {
                                 $errormsg ="A kiválasztott folyószámlán nem megfelelő az FKV!";
                                  }
                     break;
            }
          }


}




?>

<form method="POST" accept-charset="utf-8">
   <br>
   <label>Válassz egy kölcsönt! </label>
   <br>
   <select name="kolcsonamount">
          <option selected value=""></option>
          <option value="50000">50.000 Ft        - minimum FKV: 1</option>
          <option value="100000">100.000 Ft      - minimum FKV: 1</option>
          <option value="250000">250.000 Ft      - minimum FKV: 2</option>
          <option value="500000">500.000 Ft      - minimum FKV: 2</option>
          <option value="1000000">1.000.000 Ft   - minimum FKV: 3</option>
          <option value="2400000">2.400.000 Ft   - minimum FKV: 3</option>
          <option value="3000000">3.000.000 Ft   - minimum FKV: 4</option>
          <option value="4500000">4.500.000 Ft   - minimum FKV: 4</option>
          <option value="5000000 ">5.000.000 Ft  - minimum FKV: 5</option>
          <option value="8000000">8.000.000 Ft   - minimum FKV: 5</option>
          <option value="10000000">10.000.000 Ft - minimum FKV: 5</option>
        </select>
   <br>
   <label>Folyószámlaszám: </label>
   <br>
    <input type="text" name="folyoszamlaszam" />
   <br>
   <input type="submit" name="folyoszamlapost" value="Adatfelvitel" />
</form>
<?php
echo $errormsg;

?>
</div>

<hr color="black">
<div class="title">
<h1>Korábbi kölcsönök listázása</h1>
</div>

<table border="4">
<tr>
<th>Kölcsön ID</th>
<th>Kölcsön összege</th>
<th>Kezdeményező ügyfél neve</th>
<th>Folyószámlaszám</th>
<th>Kölcsön törlése</th>
</tr>

<?php

	$kolcsonok = mysqli_query(adatbazis_csatlakozas(),"SELECT id, mennyiseg, ki, folyoszamlaszam FROM kolcson ORDER BY id ASC");

	if (isset($_POST['kolcsontorles'])) {
	$torlesid = $_POST['kolcsonsorid'];
	mysqli_query(adatbazis_csatlakozas(),"DELETE FROM kolcson WHERE id = $torlesid;");
	header("location: kolcson.php");
	}

    while( $egySor = mysqli_fetch_assoc($kolcsonok) ) {
		echo '<tr>';
		echo '<td>'. $egySor["id"] .'</td>';
		echo '<td>'. $egySor["mennyiseg"] .' Ft'.'</td>';
		echo '<td>'. $egySor["ki"] .'</td>';
		echo '<td>'. $egySor["folyoszamlaszam"] .'</td>';
		echo '<form method="post" >';
		echo '<td>'. '<input type="submit" name="kolcsontorles" value="Kölcsön törlése"> ' .'</td>';
		?>
		<input type="hidden" name="kolcsonsorid" value="<?php echo $egySor['id']; ?>">

<?php

		echo '</form>';
		echo '</tr>';
	}

	mysqli_free_result($kolcsonok);

?>
</table>

</body>
</html>
