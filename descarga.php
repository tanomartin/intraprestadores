<? session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] != $pres) {
	header ("Location: http://www.ospim.com.ar/prestadores/caducaSes.php");
} else {

	include ("conexion.php");
	$id="$pres$mes$anio".".zip";
	$enlace = $pres."C23".$pres."/".$id; 
	header ("Location: http://www.ospim.com.ar/prestadores/$enlace");
	
	//TODO PASAR A S el N de la descarga
	$sql = "select * from descarga where codigo = '$pres' and mespad='$mes' and anopad='$anio';";
	$result = mysql_db_query("uv0471_prestador",$sql,$db);
	$cant = mysql_num_rows($result);
	
	$sql2 = "UPDATE descarga set estdes='S' where codigo=$pres and mespad=$mes and anopad=$anio and nrodes=$cant";
	$result2 = mysql_db_query("uv0471_prestador",$sql2,$db);
	
	
}

?>