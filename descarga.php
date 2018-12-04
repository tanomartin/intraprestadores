<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL) {
	header ("Location: index.php");
} else {
	include ("conexion.php");
	$mes = $_GET['mes'];
	$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
	$anio = $_GET['anio'];
	$pres = $_GET['pres'];
	$quin = $_GET['quin'];
	$id="$pres$mes$anio".".zip";
	if ($quin != 0) { $id="$pres$mes$anio$quin".".zip";}
	$enlace = $pres."C23".$pres."/".$id; 
	//TODO PASAR A S el N de la descarga
	$sql = "select * from descarga where codigo = '$pres' and mespad='$mes' and anopad='$anio' and quincena = $quin";
	$result = mysql_query($sql,$db);
	$cant = mysql_num_rows($result);
	$sql2 = "UPDATE descarga set estdes='S' where codigo=$pres and mespad=$mes and anopad=$anio and nrodes=$cant and quincena = $quin";
	$result2 = mysql_query($sql2,$db);
	header ("Location: $enlace");
}

?>