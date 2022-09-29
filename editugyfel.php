<?php
include_once 'db_fuggvenyek.php';
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank - Ügyfelek szerkesztése</title>
</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a href="index.php">Kezdőlap</a>
  <a href="ugyfelek.php">Ügyfelek</a>
  <a href="folyoszamlak.php">Folyószámlák</a>
  <a href="atutalas.php">Átutalások</a>
  <a href="kolcson.php">Kölcsönök</a>
</div>
<div class='title'>
<h1>Ügyfél szerkesztése</h1>
</div>
<?php

//starts running when submit button pressed
if (isset($_POST['ugyfeledit'])) {
    $editid = $_POST['ugyfelid'];
	$ugyfel_nev = $_POST['nev'];
    $ugyfel_FKV = $_POST['fkv'];
    $ugyfel_email = $_POST['email'];
    $ugyfel_jelszo = $_POST['jelszo'];
	mysqli_query(adatbazis_csatlakozas(),"UPDATE ugyfel SET `nev`='$ugyfel_nev', `FKV`='$ugyfel_FKV', `email`='$ugyfel_email', `jelszo`='$ugyfel_jelszo' WHERE `id`= '$editid'");

    header("Location:ugyfelek.php");
}

?>
<?php

//starts running on page load
if (isset($_POST['editugyfel'])) {
	$editid = $_POST['ugyfelsorid'];
	$lekerdezes = mysqli_query(adatbazis_csatlakozas(),"SELECT * FROM ugyfel WHERE id=$editid");
    $egyugyfel = mysqli_fetch_assoc($lekerdezes);


	?>
	<div class="logorreg">
	<form method="POST" accept-charset="utf-8">
	<input type="hidden" name="ugyfelid" value="<?php echo $editid;?>">
       <br>
       <label>Név: </label>
       <br>
       <input type="text" name="nev" value="<?php echo $egyugyfel['nev'];?>"/>
       <br>
       <label>FKV: </label>
       <br>
       <select name="fkv">
              <option selected value="<?php echo $egyugyfel['FKV'];?>"><?php echo $egyugyfel['FKV'];?></option>
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
       <input type="text" name="email" value="<?php echo $egyugyfel['email'];?>"/>
       <br>
       <label>Jelszó: </label>
       <br>
       <input type="text" name="jelszo" value="<?php echo $egyugyfel['jelszo'];?>"/>
       <br>
       <input type="submit" name="ugyfeledit" value="Ügyféladatok mentése" />
    </form>
    </div>
<?php
	}
?>
