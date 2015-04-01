<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL)
	header ("Location: loginPresta.php?err=2");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Prestadores</title>
<style type="text/css">
<!--
.Estilo3 {
	font-family: "Courier New", Courier, monospace;
	font-weight: bold;
	color: #000000;
}
body {
	background-color: #CCCCCC;
}
.Estilo5 {color: #990000}
.Estilo6 {font-family: "Courier New", Courier, monospace; font-weight: bold; color: #000000; font-size: 24px; }
-->
</style>
</head>

<?php
include ("conexion.php");
//esto se saca de la sesion....
if (($_SESSION['nrpresta'] == "000") || ($_SESSION['nrpresta'] == "999")) {
	$nrpres=$_GET['presta'];
} else {
	$nrpres=$_SESSION['nrpresta'];
}


$sql = "select * from usuarios where codigo = '$nrpres' and claves = '$clave'";
$result = mysql_query($sql,$db);
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
  <p class="Estilo6">Padrones</p>
  <table width="900" border="1">
    <tr>
      <td width="890"><div align="justify"><span class="Estilo3"><span class="Estilo5">NOTA 1:</span> Comunicamos que a partir de los padrones correspondientes a <span class="Estilo5">Noviembre de 2014 (11/2014)</span> en el archivo excel que contiene la informaci&oacute;n de beneficiarios titulares la columna &quot;L&quot; (c&oacute;digo de empresa) ya no contendr&aacute; esa informaci&oacute;n. Para identificar la empresa donde trabajan los beneficiarios titulares deber&aacute; utilizar s&oacute;lo el C.U.I.T.</span></div></td>
    </tr>
    <tr>
      <td><p align="justify"><span class="Estilo3"><span class="Estilo5">NOTA 2: </span>Comunicamos que a partir de los padrones correspondintes a <span class="Estilo5">Febrero de 2015 (02/2015)</span> en el archivo de excel que contiene la informaci&oacute;n de beneficiarios titulares en la columna &quot;I&quot; (provincia) se ha modificado el dato conteniendo un c&oacute;digo en lugar del nombre. De igual manera en el archivo de excel que contiene la informaci&oacute;n de beneficiarios familiares en la columna &quot;B&quot; (tipo de familiar) se ha modificado el dato conteniendo un c&oacute;digo en lugar de la descripci&oacute;n.</span></p>
      <p align="justify" class="Estilo3">En el siguiente Link usted podr&aacute; descargar un archivo comprimido que contiene ambas tablas codificadoras: <a href="codificadoras.zip">Tablas Codificadoras </a></p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="681" border="1" align="center">
    <tr>
      <td width="126"><div align="center"><strong>Per&iacute;odo</strong></div></td>
      <td width="112"><div align="center"><strong>Archivo</strong></div></td>
      <td width="207"><div align="center"><strong>Fecha de Subida</strong></div></td>
      <td width="208"><div align="center"><strong>Primera Descarga </strong></div></td>
    </tr>
    <?php
	for ($i=$inicio;$i<=$fin;$i++){
		//para saber si pongo o no el link de descarga
		$link=0;
		//datos de subida
		$sql1 = "select * from subida where codigo = '$nrpres' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]'";
		$result1 = mysql_query($sql1,$db);
		$row1=mysql_fetch_array($result1); 
		if (mysql_num_rows($result1)==0) {
			$subida="NO SUBIDO";
			$link=1;
		} else {
			$subida=$row1['fecsub']." // ".$row1['horsub'];
		}
		
		//datso de descarga
		$sql2 = "select * from descarga where codigo = '$nrpres' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]' and estdes='S' order by codigo, anopad, mespad, nrodes LIMIT 1";
		$result2 = mysql_query($sql2,$db);
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
    <?php
	//x si alguna vez necestimaos que alguno entre como sistema o admin para que no aparezca SALIR
 	if (($_SESSION['nrpresta'] != "000") and ($_SESSION['nrpresta'] != "999")) {
		//update de la fecha y la hora
		$pres = $_SESSION['nrpresta'];
		$hoy = date("Ymd"); 
		$hora = date("H:i:s"); 
		$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres"; 
		$result9 = mysql_query($sql9,$db);?>
		<input type="button" name="salir" value="Salir" onclick="location.href='logout.php'"/>
<?php	}?>
  </p>
</div>
</body>
</html>
