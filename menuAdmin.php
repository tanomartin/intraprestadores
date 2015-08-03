<?php session_save_path("sesiones");
session_start();
if(($_SESSION['nrpresta'] != "999") and ($_SESSION['nrpresta'] != "000"))
	header ("Location: loginPresta.php?err=2");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Administrador</title>
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
.Estilo5 {font-weight: bold; color: #0000FF; font-family: Arial, Helvetica, sans-serif;}
.Estilo6 {font-size: 14px; }
-->
</style>
</head>

<body>
<div align="center"><span class="Estilo3">MENU ADMINISTRADOR </span>
</div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" /></p>
  <p class="Estilo3">PRESTADORES</p>
  <table width="552" border="1" align="center">
    <tr>
      <td width="268"><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=001'))" class="Estilo5">Farm+</a></div></td>
      <td width="268"><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=002'))" class="Estilo5">Gesalcor</a></div></td>
    </tr>
    <tr>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=003'))" class="Estilo5">Garant&iacute;a M&eacute;dica </a></div></td>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=004'))" class="Estilo5">Oseana</a></div></td>
    </tr>
    <tr>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=005'))" class="Estilo5">UTE</a></div></td>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=006'))" class="Estilo5">Instituto Medico Constituyentes </a></div></td>
    </tr>
    <tr>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=007'))" class="Estilo5">Instituto Dorrego </a></div></td>
      <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=008'))" class="Estilo5">Clinica de Im&aacute;genes Neuquen</a></div></td>
    </tr>
	<tr>
	  <td><div align="center" class="Estilo6"><a href="javascript:void(window.open('prestaData.php?presta=009'))" class="Estilo5">SPM Salud </a></div></td>
      <td><div align="center" class="Estilo6"></div></td>
	</tr>
  </table>
  <p>
  <?php
 	include ("conexion.php");
 	if ($_SESSION['nrpresta'] == "999") {
		$pres = $_SESSION['nrpresta'];
		$hoy = date("Ymd"); 
		$hora = date("H:i:s"); 
		$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres"; 
		$result9 = mysql_query($sql9,$db);
		?>
		<input type="button" name="salir" value="Salir" onclick="location.href='logout.php'"/>
<?php	}?>
</p>
</div>
</body>
</html>
