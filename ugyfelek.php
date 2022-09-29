<?php
include_once 'db_fuggvenyek.php';
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank - Ügyfelek</title>
</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a href="index.php">Kezdőlap</a>
  <a class="active">Ügyfelek</a>
  <a href="folyoszamlak.php">Folyószámlák</a>
  <a href="atutalas.php">Átutalások</a>
  <a href="kolcson.php">Kölcsönök</a>
</div>
<div class='title'>
<h1>Új ügyfél felvétele</h1>
</div>
<div class='logorreg'>
<?php


//starts running when submit button pressed
if (isset($_POST["ugyfelekpost"])) {
$result = mysqli_query(adatbazis_csatlakozas(),"SELECT max(id) AS maxId FROM ugyfel");
$row = mysqli_fetch_array($result);
//customer id
$ugyfel_id=$row["maxId"]+1;
//customer name
$ugyfel_nev = $_POST['nev'];
//customer solvency examination ---> determines which loan they can get
$ugyfel_FKV = $_POST['fkv'];
//customer email address
$ugyfel_email = $_POST['email'];
//customer password
$ugyfel_jelszo = $_POST['jelszo'];



if ( $ugyfel_nev!='' &&
     $ugyfel_FKV!='' && $ugyfel_email!='' && $ugyfel_jelszo!='' ) {


	ugyfelet_beszur($ugyfel_id , $ugyfel_nev, $ugyfel_FKV , $ugyfel_email, $ugyfel_jelszo);

	header("Location: ugyfelek.php");

} else {
	error_log("Nincs beállítva valamely érték");

}

}


?>



<form method="POST" accept-charset="utf-8">
   <br>
   <label>Név: </label>
   <br>
   <input type="text" name="nev" />
   <br>
   <label>FKV: </label>
   <br>
    <select name="fkv">
       <option selected value=""></option>
       <option value="0">0</option>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
       <option value="5">5</option>
     </select>
   <br>
   <label>Email cím: </label>
   <br>
   <input type="text" name="email" />
   <br>
   <label>Jelszó: </label>
   <br>
   <input type="text" name="jelszo" />
   <br>
   <input type="submit" name="ugyfelekpost" value="Új ügyfél felvétele" />
</form>
</div>

<hr color="black">

<div class='title'>
<h1>Ügyfelek listázása</h1>
</div>

<table border="4">
<tr>
<th>ID</th>
<th>Név</th>
<th>FKV</th>
<th>Email cím</th>
<th>Jelszó</th>
<th>Folyószámlák száma</th>
<th>Ügyfelek törlése</th>
<th>Új folyószámla felvétele</th>
<th>Ügyfél adatok szerkesztése</th>
</tr>

<?php

	$ugyfelek = ugyfellistatLeker();
    $count = mysqli_query(adatbazis_csatlakozas(),"SELECT COUNT(`folyoszamlaszam`) AS `darab`, `id` FROM `folyoszamla`, `ugyfel` WHERE id=folyoszamla.ugyfelID GROUP BY id;");

	if (isset($_POST['sortorles'])) {
	$torlesid = $_POST['ugyfelsorid'];
	mysqli_query(adatbazis_csatlakozas(),"DELETE FROM ugyfel WHERE id = $torlesid;");
	mysqli_query(adatbazis_csatlakozas(),"DELETE FROM folyoszamla WHERE ugyfelID = $torlesid;");
	header("location: ugyfelek.php");
	}


	if (isset($_POST['ujfolyo'])) {
    	$ujfolyoszamla = $_POST['ujfolyoid'];
    	$result = mysqli_query(adatbazis_csatlakozas(),"SELECT max(folyoszamlaszam) AS maxfolyoszamla FROM folyoszamla");
        $row = mysqli_fetch_array($result);
        $ujfolyoszamla_szam=$row["maxfolyoszamla"]+1;

        mysqli_query(adatbazis_csatlakozas(),"INSERT INTO folyoszamla (ugyfelID, folyoszamlaszam, egyenleg) VALUES ('$ujfolyoszamla', '$ujfolyoszamla_szam','0');");
    	header("location: folyoszamlak.php");
    }


    while( $egySor = mysqli_fetch_assoc($ugyfelek)) {
         $counting = mysqli_fetch_assoc($count);
        if ($counting["darab"] == '') {
        $counting["darab"]='0';
        }

		echo '<tr>';
		echo '<td>'. $egySor["id"] .'</td>';
		echo '<td>'. $egySor["nev"] .'</td>';
		echo '<td>'. $egySor["FKV"] .'</td>';
		echo '<td>'. $egySor["email"] .'</td>';
		echo '<td>'. $egySor["jelszo"] .'</td>';
		echo '<td>'. $counting["darab"] .'</td>';
		echo '<form method="post" >';
		echo '<td>'. '<input type="submit" name="sortorles" value="Ügyfél törlése"> ' .'</td>';
		?>
		<input type="hidden" name="ugyfelsorid" value="<?php echo $egySor['id']; ?>">

        <form method="post" action="">
        <td><input type="submit" name="ujfolyo" value="Új folyószámla"> </td>
		<input type="hidden" name="ujfolyoid" value="<?php echo $egySor['id']; ?>">
		</form>

		<form method="post" action="editugyfel.php">
		<td> <input type="submit" name="editugyfel" value="Szerkesztés"> </td>
        <input type="hidden" name="ugyfelsorid" value="<?php echo $egySor['id']; ?>">
        </form>

	</tr>
<?php	}

	mysqli_free_result($ugyfelek);

?>
</table>

</body>
</html>
