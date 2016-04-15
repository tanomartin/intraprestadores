<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL) {
	header ("Location: index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ticket de descarga</title>
</head>

<body>
<p>
<?php
include ("conexion.php");
$mes = $_GET['mes'];
$anio = $_GET['anio'];
$fecd = $_GET['fecd'];
$hord = $_GET['hord'];
$sql = "select * from usuarios where codigo = '$pres'";
$result = mysql_query($sql,$db);
$row=mysql_fetch_array($result); 
$prestador=$row['nombre'];

$sql1 = "select * from descarga where codigo = '$pres' and mespad='$mes' and anopad='$anio' and estdes='S';";
$result1 = mysql_query($sql1,$db);
$cant = mysql_num_rows($result1);
$cantProx = $cant+1;
?>
</p>
<table width="523" border="1" align="center">
  <tr>
    <td width="513" height="36"><div align="center">
      <p><em>TICKET DE DESCARGA DE PADRONES </em></p>
      <p><img src="images/LogoSinFondo.jpg" width="107" height="89" /></p>
      <p><strong>O.S.P.I.M - Obra Social del Personal de la Industria Maderera </strong></p>
    </div></td>
  </tr>
  <tr>
    <td height="70">
	<form id="form1" name="form1" method="post" action="descarga.php?pres=<?php echo $pres."&mes=".$mes."&anio=".$anio ?>">
      <p>PRESTADOR: <?php print($prestador); ?></p>
      <p>PERIODO DEL PADRON DESCARGADO: <?php print($mes.'/'.$anio); ?></p>
      <p>FECHA Y HORA DE DESCARGA: <?php print($fecd.' a las '.$hord. ' hrs.');  ?></p>
      <p>NUMERO DE DESCARGA: <?php print($cantProx); ?></p>
      <p align="center">
        <input name="submit2" type="submit" value="Descargar Padron" />
      </p>
      <p align="center">
        <input type="button" name="imprimir" value="Imprimir" onclick="window.print();" />
      </p>
	</form>
	</td>   
  </tr>
</table>
</body>
</html>
