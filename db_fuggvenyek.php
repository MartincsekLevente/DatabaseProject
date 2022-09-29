<?php
function adatbazis_csatlakozas() {

	$conn = mysqli_connect("localhost", "root", "") or die("Csatlakozási hiba");
	if (!mysqli_select_db($conn, "BANK" )  ) {

		return null;
	}
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, 'SET character_set_results=utf8');
	mysqli_set_charset($conn, 'utf8');

	return $conn;
}


function ugyfelet_beszur($ugyfel_id, $ugyfel_nev, $ugyfel_FKV, $ugyfel_email, $ugyfel_jelszo) {


	if ( !($conn = adatbazis_csatlakozas()) ) {
		return false;
	}

	$insert ="INSERT INTO ugyfel (id, nev, FKV, email, jelszo) VALUES ('$ugyfel_id', '$ugyfel_nev', '$ugyfel_FKV', '$ugyfel_email', '$ugyfel_jelszo');";
    mysqli_query($conn, $insert);

}

function ugyfellistatLeker() {

	if ( !($conn = adatbazis_csatlakozas()) ) {
		return false;
	}


	$insert = mysqli_query( $conn,"SELECT * FROM ugyfel");
    return $insert;
}




?>