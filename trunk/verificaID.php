<?php session_save_path("sesiones");
session_start();

$datos = array_values($_POST);
$nrpresta = $datos[0];
$clave = $datos[1];
include ("conexion.php");

$sql = "select * from usuarios where codigo = '$nrpresta' and claves = '$clave'";
$result = mysql_query($sql,$db);
$cant = mysql_num_rows($result);
if ($cant > 0) {
	$_SESSION['nrpresta'] = $nrpresta;
	$_SESSION['aut'] = 'pepepascual';
	if ($nrpresta == "999") {
		header ('location:menuAdmin.php');	
	} 
	if ($nrpresta == "000") {
		header ('location:menuSistemas.php');
	}
	if (($nrpresta != "000") and ($nrpresta != "999")) {
		header ('location:menuPresta.php');
	}
} else {
	header ('location:loginPresta.php?err=1');
}
?>
