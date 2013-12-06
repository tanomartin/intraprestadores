<? session_save_path("sesiones");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Importando Registros.</title>
</head>
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

<body bgcolor="#E4C192">
<p align="center"><img border="0" src="ospimw.jpg" width="182" height="206" /></p>
<table width="700" border="1" align="center">
  <tr>
    <td width="690"><div align="center"><font face="Arial, Helvetica, sans-serif"><strong><em>Su sesi&oacute;n a caducado, debe ingresar nuevamente.</em></strong></font></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <?
		print ("<a href=loginPresta.php>"."VOLVER AL INGRESO");
	?>
    </div></td>
  </tr>
</table>
</body>
</html>
