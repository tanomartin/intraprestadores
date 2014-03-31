<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL)
	header ("Location: loginPresta.php?err=2");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prestadores Info.</title>
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
.Estilo5 {
	font-family: "Courier New", Courier, monospace;
	font-weight: bold;
	color: #0000FF;
	font-size: 18px;
}
-->
</style>
</head>

<?php
include ("conexion.php");
$presta = $_GET['presta'];
$sql = "select * from usuarios where codigo = $presta";
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

if ($dia < 14) {
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
<div align="center"><span class="Estilo3">INFORMACION DE PRESTADORES </span> </div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" />  </p>
  <p><span class="Estilo5">Prestador <?php print($row['nombre']);  ?> </span></p>
  <p class="Estilo3">Informacion de Subida y Descarga de Padrones - Capitas </p>
  <table width="1053" border="1" align="center">
    <tr>
      <td width="75"><div align="center"><strong>Per&iacute;odo</strong></div></td>
      <td width="187"><div align="center"><strong>Fecha de Subida</strong></div></td>
      <td width="187"><div align="center"><strong>Primera Bajada</strong></div></td>
	  <td width="114"><div align="center"><strong>Cant. Titulares</strong></div></td>
	  <td width="114"><div align="center"><strong>Cant. Familiares</strong></div></td>
	  <td width="165"><div align="center"><strong>Total de Beneficiarios</strong></div></td>
	  <td width="165"><div align="center"><strong>Benef. por Deleg. </strong></div></td>
    </tr>
    <?php
for ($i=$inicio;$i<=$fin;$i++){
	$sql2 = "select * from subida where codigo = $presta and mespad = $mesArc[$i] and anopad = $anioArc[$i]"  ;
	$result2 = mysql_query($sql2,$db);
	$row2=mysql_fetch_array($result2); 
	if (mysql_num_rows($result2)==0) {
		$subida="NO SUBIDO";
	} else {
		$subida=$row2['fecsub']." // ".$row2['horsub'];
	}
	
	$sql3 = "select * from descarga where codigo = $presta and mespad = $mesArc[$i] and anopad = $anioArc[$i] and estdes='S' order by codigo, anopad, mespad, nrodes LIMIT 1";
	$result3 = mysql_query($sql3,$db);
	$row3=mysql_fetch_array($result3); 
	if (mysql_num_rows($result3)==0) {
		$descarga="NUNCA";
	} else {
		$descarga=$row3['fecdes']." // ".$row3['hordes'];
	}
		
	print ("<td width=75><div align=center><font face=Verdana size=2>".$mesArc[$i]."/".$anioArc[$i]."</font></div></td>");
	print ("<td width=187><div align=center><font face=Verdana size=2>".$subida."</font></div></td>");
	print ("<td width=187><div align=center><font face=Verdana size=2>".$descarga."</font></div></td>");
	print ("<td width=114><div align=center><font face=Verdana size=2>".$row2['tottit']."</font></div></td>");
	print ("<td width=114><div align=center><font face=Verdana size=2>".$row2['totfam']."</font></div></td>");
	print ("<td width=165><div align=center><font face=Verdana size=2>".$row2['totben']."</font></div></td>");
	if ($subida=="NO SUBIDO") {
		print ("<td width=165><div align=center><font face=Verdana size=2>".$subida."</font></div></td>");
	} else {
		$nomArcLista=$presta."D".$mesArc[$i].$anioArc[$i].".txt";
		$ubicacion=$presta."C23".$presta."/".$nomArcLista;
		print ("<td width=165><div align=center><font face=Verdana size=2><a href=javascript:void(window.open('$ubicacion'))>".Descargar."</font></div></td>");
	}
	print ("</tr>");
}

?>
  </table>
</div>
</body>
</html>
