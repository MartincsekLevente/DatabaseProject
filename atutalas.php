<?php
include_once('db_fuggvenyek.php');
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank - Átutalások</title>
</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a href="index.php">Kezdőlap</a>
  <a href="ugyfelek.php">Ügyfelek</a>
  <a href="folyoszamlak.php">Folyószámlák</a>
  <a class="active">Átutalások</a>
  <a href="kolcson.php">Kölcsönök</a>
</div>

<div class='title'>
<h1>Átutalás felvétele</h1>
</div>
<div class='logorreg'>
<?php


$errormsg ='';
$kivonva= 0;


if (isset($_POST["ujatutalas"])) {
$maxidres = mysqli_query(adatbazis_csatlakozas(),"SELECT max(id) AS maxId FROM atutalas");
$row = mysqli_fetch_array($maxidres);
$atutalas_id=$row["maxId"]+1;
$atutalas_honnan = $_POST['honnan'];
$atutalas_hova = $_POST['hova'];
$atutalas_mennyiseg = $_POST['mennyiseg'];

if ( $atutalas_honnan!='' &&
     $atutalas_hova !='' && $atutalas_mennyiseg!=''  ) {
     $sor = [];
     $folyok = mysqli_query(adatbazis_csatlakozas(),"SELECT folyoszamlaszam FROM folyoszamla");

     while($sor = mysqli_fetch_assoc($folyok)) {
     $folyo[] = $sor['folyoszamlaszam'];
      }
    if (is_numeric($atutalas_honnan) && is_numeric($atutalas_hova)) {
     if (in_array($atutalas_honnan, $folyo) && in_array($atutalas_hova, $folyo)) {
            if ($atutalas_honnan!=$atutalas_hova) {

            $tmp = mysqli_query(adatbazis_csatlakozas(),"SELECT egyenleg FROM folyoszamla WHERE folyoszamlaszam=$atutalas_honnan");
            $adottsor = mysqli_fetch_assoc($tmp);
            $atutaloosszeg= $adottsor['egyenleg'];
                if(($atutaloosszeg-$atutalas_mennyiseg)>=0) {

                    mysqli_query(adatbazis_csatlakozas(),"INSERT INTO atutalas (id, honnan, hova, mennyiseg) VALUES ('$atutalas_id', '$atutalas_honnan','$atutalas_hova','$atutalas_mennyiseg');");
                    mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg-$atutalas_mennyiseg WHERE $atutalas_honnan = folyoszamlaszam");
                    mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$atutalas_mennyiseg WHERE $atutalas_hova = folyoszamlaszam");
                }
                else {
                $errormsg="Nincs elég összeg a kívánt folyószámlán, adjon meg kisebb összeget!";
                }
            }
            else {
            $errormsg="Ugyan azt a folyószámlaszámot adtad meg!";
            }
         }}
     else {
     $errormsg="Helytelen, vagy nem létező folyószámlaszám!";
     }

} else {
	$errormsg="Valamelyik adatot nem adtad meg!";


}
}
?>
<form method="POST" accept-charset="utf-8">
   <br>
   <label>Melyik folyószámláról? </label>
   <br>
   <input type="text" name="honnan" />
   <br>
   <label>Melyik folyószámlára? </label>
   <br>
    <input type="text" name="hova" />
   <br>
   <label>Az utalás összege: </label>
   <br>
   <input type="text" name="mennyiseg" />
   <br>
   <input type="submit" name="ujatutalas" value="Átutalás felvétele" />
</form>
    <?php

       echo $errormsg;

    ?>
</div>
<hr color="black">
<div class="title">
<h1>Korábbi átutalások listázása</h1>
</div>

<table border="4">
<tr>
<th>Átutalás ID</th>
<th>Honnan?</th>
<th>Hova?</th>
<th>Összeg</th>
<th>Átutalás törlése</th>
</tr>

<?php

	$atutalasok = mysqli_query(adatbazis_csatlakozas(),"SELECT id, honnan, hova, mennyiseg FROM atutalas ORDER BY id");

	if (isset($_POST['atutalotorles'])) {
	$torlesid = $_POST['atutalsorid'];
	mysqli_query(adatbazis_csatlakozas(),"DELETE FROM atutalas WHERE id = $torlesid;");
	header("location: atutalas.php");
	}

    while( $egySor = mysqli_fetch_assoc($atutalasok) ) {
		echo '<tr>';
		echo '<td>'. $egySor["id"] .'</td>';
		echo '<td>'. $egySor["honnan"] .'</td>';
		echo '<td>'. $egySor["hova"] .'</td>';
		echo '<td>'. $egySor["mennyiseg"] .' Ft'.'</td>';
		echo '<form method="post" >';
		echo '<td>'. '<input type="submit" name="atutalotorles" value="Átutalás törlése"> ' .'</td>';
		?>
		<input type="hidden" name="atutalsorid" value="<?php echo $egySor['id']; ?>">

<?php

		echo '</form>';
		echo '</tr>';
	}

	mysqli_free_result($atutalasok);

?>
</table>

</body>
</html>
