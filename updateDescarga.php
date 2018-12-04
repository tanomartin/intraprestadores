<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL) {
	header ("Location: index.php");
} else {
	include ("conexion.php");
	$pres = $_SESSION['nrpresta'];
	$fecdes=date("Y-m-d");
	$hordes=date("H:i:s");
	$mes = $_GET['mes'];
	$anio = $_GET['anio'];
	$quin = $_GET['quincena'];
	//cargo el registro de descarga...
	$sql1 = "INSERT INTO descarga(codigo,mespad,anopad,quincena,fecdes,hordes,estdes) VALUES ('".trim($pres)."','".$mes."','".trim($anio)."',$quin,'".trim($fecdes)."','".trim($hordes)."','N')";
	$result1 = mysql_query($sql1,$db);
	//cambio el estado en la tabla subida...
	$sql2 = "UPDATE subida set status='S' where codigo=$pres and mespad=$mes and anopad=$anio and quincena=$quin";
	$result2 = mysql_query($sql2,$db);	
	header ("Location: ticket.php?pres=$pres&mes=$mes&anio=$anio&fecd=$fecdes&hord=$hordes&quin=$quin");
}