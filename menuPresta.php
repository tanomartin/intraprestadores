<? session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == null)
	header ("Location: http://www.ospim.com.ar/prestadores/caducaSes.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Prestadores</title>
<style type="text/css">
<!--
.Estilo2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #0000FF;
}
.Estilo3 {
	font-family: "Courier New", Courier, monospace;
	font-weight: bold;
	color: #000000;
}
body {
	background-color: #CCCCCC;
}
-->
</style>
</head>

<?
include ("conexion.php");
//esto se saca de la sesion....
if (($_SESSION['nrpresta'] == "000") || ($_SESSION['nrpresta'] == "999")) {
	$nrpres="$presta";
} else {
	$nrpres=$_SESSION['nrpresta'];
}


$sql = "select * from usuarios where codigo = '$nrpresta' and claves = '$clave'";
$result = mysql_db_query("uv0471_prestador",$sql,$db);
$row=mysql_fetch_array($result); 



//me da el mes que corresponde al año anterior...
function formatoPerido($per) {
	if ($per == 1) {
		return "01";
	}
	if ($per == 2) {
		return "02";
	}
	if ($per == 3) {
		return "03";
	}
	if ($per == 4) {
		return "04";
	}
	if ($per == 5) {
		return "05";
	}
	if (($per == 6) || ($per == -6)) {
		return "06";
	}
	if (($per == 7) || ($per == -5)) {
		return "07";
	}
	if (($per == 8) || ($per == -4)) {
		return "08";
	}
	if (($per == 9) || ($per == -3)) {
		return "09";
	}
	if (($per == 10) || ($per == -2)) {
		return "10";
	}
	if (($per == 11) || ($per == -1)) {
		return "11";
	}
	if (($per == 12) || ($per == 0)){
		return "12";
	}
}

$dia=date("j");
$mes=date("m");
$anio=date("Y");

if ($dia < 15) {
	$inicio=2;
	$fin=7;
}
else  {
	$inicio=1;
	$fin=6;
}

for ( $i = $inicio ; $i <= $fin ; $i++) {
	$perAux=$mes - $i;
	if ($perAux <= 0) {
		$anioArc[$i]=$anio-1;
		$mesArc[$i]=formatoPerido($perAux);
	}
	else {
		$anioArc[$i]=$anio;
		$mesArc[$i]=formatoPerido($perAux);
	}
}

?>

<body>
<div align="center"><span class="Estilo3">MENU PRESTADORES </span> </div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" />  </p>
  <p class="Estilo3">Padrones</p>
  <table width="681" border="1" align="center">
    <tr>
      <td width="126"><div align="center"><strong>Per&iacute;odo</strong></div></td>
      <td width="112"><div align="center"><strong>Archivo</strong></div></td>
      <td width="207"><div align="center"><strong>Fecha de Subida</strong></div></td>
      <td width="208"><div align="center"><strong>Primera Descarga </strong></div></td>
    </tr>
    <?
for ($i=$inicio;$i<=$fin;$i++){
	//para saber si pongo o no el link de descarga
	$link=0;
	//datos de subida
	$sql1 = "select * from subida where codigo = '$nrpresta' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]'";
	$result1 = mysql_db_query("uv0471_prestador",$sql1,$db);
	$row1=mysql_fetch_array($result1); 
	if (mysql_num_rows($result1)==0) {
		$subida="NO SUBIDO";
		$link=1;
	} else {
		$subida=$row1['fecsub']." // ".$row1['horsub'];
	}
	
	//datso de descarga
	$sql2 = "select * from descarga where codigo = '$nrpresta' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]' and estdes='S' order by codigo, anopad, mespad, nrodes LIMIT 1";
	$result2 = mysql_db_query("uv0471_prestador",$sql2,$db);
	$row2=mysql_fetch_array($result2); 
	if (mysql_num_rows($result2)==0) {
		$descarga="NUNCA";
	} else {
		$descarga=$row2['fecdes']." // ".$row2['hordes'];
	}

	print ("<td width=126><div align=center><font face=Verdana size=2>".$mesArc[$i]."/".$anioArc[$i]."</font></div></td>");
	if ($link==1) {
		print ("<td width=112><div align=center><font face=Verdana size=2>".Descargar."</font></div></td>");
	} else {
		print ("<td width=112><div align=center><font face=Verdana size=2><a href=javascript:void(window.open('updateDescarga.php?pres=$nrpres&mes=$mesArc[$i]&anio=$anioArc[$i]'))>".Descargar."</font></div></td>");
	}
	print ("<td width=207><div align=center><font face=Verdana size=2>".$subida."</font></div></td>");
	print ("<td width=208><div align=center><font face=Verdana size=2>".$descarga."</font></div></td>");
	print ("</tr>");
}

?>
  </table>
  <p>
    <?
	//x si alguna vez necestimaos que alguno entre como sistema o admin para que no aparezca SALIR
 	if (($_SESSION['nrpresta'] != "000") and ($_SESSION['nrpresta'] != "999")) {
		//update de la fecha y la hora
		$pres = $_SESSION['nrpresta'];
		$hoy = date("Ymd"); 
		$hora = date("H:i:s"); 
		$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres"; 
		$result9 = mysql_db_query("uv0471_prestador",$sql9,$db);
		print ("<font face=Verdana size=3><b><font color=#CF8B34><a href=logout.php>"."SALIR"."</font></b></font>");
	}
	?>
  </p>
</div>
</body>
</html>
