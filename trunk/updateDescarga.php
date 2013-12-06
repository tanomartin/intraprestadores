<? session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] != $pres) {
	header ("Location: http://www.ospim.com.ar/prestadores/caducaSes.php");
}
else {
	include ("conexion.php");
	$fecdes=date("Y-m-d");
	$hordes=date("H:i:s");
	//cargo el registro de descarga...
	$sql1 = "INSERT INTO descarga(codigo,mespad,anopad,fecdes,hordes,estdes) VALUES ('".trim($pres)."','".$mes."','".trim($anio)."','".trim($fecdes)."','".trim($hordes)."','N')";
	$result1 = mysql_db_query("uv0471_prestador",$sql1,$db);
	
	//cambio el estado en la tabla subida...
	$sql2 = "UPDATE subida set status='S' where codigo=$pres and mespad=$mes and anopad=$anio;";
	$result2 = mysql_db_query("uv0471_prestador",$sql2,$db);
	
	header ("Location: http://www.ospim.com.ar/prestadores/ticket.php?pres=$pres&mes=$mes&anio=$anio&fecd=$fecdes&hord=$hordes");
	
}