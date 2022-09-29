<?php
include_once('db_fuggvenyek.php');
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank - Folyószámlák</title>
</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a href="index.php">Kezdőlap</a>
  <a href="ugyfelek.php">Ügyfelek</a>
  <a class="active">Folyószámlák</a>
  <a href="atutalas.php">Átutalások</a>
  <a href="kolcson.php">Kölcsönök</a>
</div>
<div class='title'>
<h1>Folyószámlák listázása</h1>
</div>

<table border="4">
<tr>
<th>Ügyfél ID</th>
<th>Ügyfél név</th>
<th>Folyószámlaszám</th>
<th>Egyenleg</th>
<th>Folyószámla törlése</th>
<th>Add meg az egyenleget</th>
<th>Egyenleg hozzáadása</th>
</tr>

<?php

    $folyok= mysqli_query(adatbazis_csatlakozas(),"SELECT ugyfelID, folyoszamlaszam, egyenleg FROM folyoszamla ORDER BY ugyfelID");

    if (isset($_POST['folyotorles'])) {

    	$torlesid = $_POST['ugyfelsorid'];
    	mysqli_query(adatbazis_csatlakozas(),"DELETE FROM folyoszamla WHERE folyoszamlaszam = $torlesid;");
    	header("location: folyoszamlak.php");
    	}

      if (isset($_POST['egyenlegadd'])) {
        $adandoegyenleg = $_POST['egyenleg'];
      	$egyenlegaddid = $_POST['egyenlegaddhidden'];
       	mysqli_query(adatbazis_csatlakozas(),"UPDATE folyoszamla SET egyenleg=egyenleg+$adandoegyenleg WHERE $egyenlegaddid = folyoszamlaszam");
      	header("location: folyoszamlak.php");
      	}



    while( $egySor = mysqli_fetch_assoc($folyok) ) {
    $ugyfid =$egySor['ugyfelID'];
    $ugyfelek=mysqli_query(adatbazis_csatlakozas(),"SELECT id, nev FROM ugyfel WHERE id=$ugyfid");
    $ugyfel=mysqli_fetch_assoc($ugyfelek);
		echo '<tr>';
		echo '<td>'. $ugyfel["id"] .'</td>';
		echo '<td>'. $ugyfel["nev"] .'</td>';
		echo '<td>'. $egySor["folyoszamlaszam"] .'</td>';
		echo '<td>'. $egySor["egyenleg"] .' Ft'.'</td>';
		echo '<form method="post" >';
		echo '<td>'. '<input type="submit" name="folyotorles" value="Folyószámla törlése"> ' .'</td>';
		?>
        		<input type="hidden" name="ugyfelsorid" value="<?php echo $egySor['folyoszamlaszam']; ?>">

        <?php

        echo '<td>'.

         '
         <select name="egyenleg">
                             <option selected value="0"></option>
                             <option value="1000">1000 Ft</option>
                             <option value="5000">5000 Ft</option>
                             <option value="10000">10000 Ft</option>
                             <option value="20000">20000 Ft</option>
                             <option value="50000">50000 Ft</option>
                             <option value="80000">80000 Ft</option>
                             <option value="100000">100000 Ft</option>
                             <option value="150000">150000 Ft</option>
                           </select>

                           ' .'</td>';
        		?>
                		<input type="hidden" name="ugyfelsorid" value="<?php echo $egySor['folyoszamlaszam']; ?>">

                <?php

        echo '<td>'. '<input type="submit" name="egyenlegadd" value="Egyenleg hozzáadása"> ' .'</td>';
        		?>
                		<input type="hidden" name="egyenlegaddhidden" value="<?php echo $egySor['folyoszamlaszam']; ?>">

                <?php
		echo '</form>';
		echo '</tr>';
	}

	mysqli_free_result($ugyfelek);

?>
</table>

</body>
</html>
