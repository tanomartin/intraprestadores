<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] != "000" || $_SESSION['nrpresta'] == NULL) 
	header ("Location: loginPresta.php?err=2");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Control</title>
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
.Estilo6 {font-size: 16px; }
-->
</style>
</head>

<body>
<div align="center"><span class="Estilo3">MENU SISTEMAS </span> </div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" /></p>
  <table width="808" border="1">
    <tr>
      <td width="262" class="Estilo2"><div align="center" class="Estilo6"><a href="javascript:void(window.open('menuAdmin.php'))">Menu Control </a></div></td>
      <td width="262" class="Estilo2"><div align="center" class="Estilo6"><a href="javascript:void(window.open('subidaPadron.php'))">Subida de Padrones</a> </div></td>
      <td width="262" class="Estilo2"><div align="center" class="Estilo6"><a href="javascript:void(window.open('subidaListados.php'))">Subida de Listados </a> </div></td>
    </tr>
  </table>
  <p>
   <?php
   		include ("conexion.php");
		$hoy = date("Ymd"); 
		$hora = date("H:i:s"); 
		$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres"; 
		$result9 = mysql_query($sql9,$db);?>
		<input type="button" name="salir" value="Salir" onclick="location.href='logout.php'"/>
  </p>
   
</div>
</body>
</html>
