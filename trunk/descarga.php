<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL) {
	header ("Location: loginPresta.php?err=2");
} else {

	include ("conexion.php");
	$mes = $_GET['mes'];
	$anio = $_GET['anio'];
	$pres = $_GET['pres'];
	$id="$pres$mes$anio".".zip";
	$enlace = $pres."C23".$pres."/".$id; 
	
	//TODO PASAR A S el N de la descarga
	$sql = "select * from descarga where codigo = '$pres' and mespad='$mes' and anopad='$anio';";
	$result = mysql_query($sql,$db);
	$cant = mysql_num_rows($result);
	
	$sql2 = "UPDATE descarga set estdes='S' where codigo=$pres and mespad=$mes and anopad=$anio and nrodes=$cant";
	$result2 = mysql_query($sql2,$db);
	
	header ("Location: $enlace");
	
}

?>