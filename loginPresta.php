<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Intranet - Login</title>
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
.Estilo4 {
	color: #FF0000;
	font-weight: bold;
}
body {
	background-color: #CCCCCC;
}
-->
</style>
</head>

<body>
<h3 align="center" class="Estilo3">SISTEMA DE CONSULTA PARA PRESTADORES </h3>
<p align="center"><img src="ospimw.jpg" width="308" height="350" /></p>
<p align="center">
<?php 
	if (isset($_GET['err'])) {
		$err = $_GET['err'];
		if ($err == 1) {
			print("<p align='center' class='Estilo4'>DATOS INCORRECTOS</p>");
		}
		if ($err == 2) {
			print("<p align='center' class='Estilo4'>SESION CADUCADA VUELVA A INGRESAR</p>");
		}
	}
?></p>
<form method="POST" action="verificaID.php">
  <table width="100%" border="0">
  <tr>
    <td width="30%" align="right"><font face="Verdana" size="2"><b>Usuario:&nbsp;</b></font></td>
    <td width="30%"><p align="left">
      <input name="user" type="text" id="user" style="background-color: #ffffff" size="20" />
    </p></td>
    </tr>
  <tr>
    <td width="30%" align="right"><font face="Verdana" size="2"><b>Contrase&ntilde;a:&nbsp;</b></font></td>
    <td width="30%"><p align="left">
      <input name="pass" type="password" id="pass" style="background-color: #FFFFFF" size="20" />
    </p></td>
    </tr>
  <tr>
    <td colspan="2" align="right">
      <div align="center"><input name="ingresar" type="submit" id="ingresar"  value="Ingresar" />
        </div>      </td>
    </tr>
  <tr>
    <td align="right" colspan="2"><p align="center"><a href="olvido.php" class="Estilo2">&iquest;OLVIDO
      SU CONTRASE&Ntilde;A?</a></p></td>
    </tr>
</table>
</form>

</body>
</html>
