<? session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] != $pres) {
	header ("Location: http://www.ospim.com.ar/prestadores/caducaSes.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ticket de descarga</title>
</head>

<body>
<p><?
include ("conexion.php");
$sql = "select * from usuarios where codigo = '$pres'";
$result = mysql_db_query("uv0471_prestador",$sql,$db);
$row=mysql_fetch_array($result); 
$prestador=$row['nombre'];

$sql1 = "select * from descarga where codigo = '$pres' and mespad='$mes' and anopad='$anio' and estdes='S';";
$result1 = mysql_db_query("uv0471_prestador",$sql1,$db);
$cant = mysql_num_rows($result1);
$cantProx = $cant+1;
?>
</p>
<table width="523" border="1" align="center">
  <tr>
    <td width="513" height="36"><div align="center">
      <p><em>TICKET DE DESCARGA DE PADRONES </em></p>
      <p><img src="LogoSinFondo.jpg" width="107" height="89" /></p>
      <p><strong>O.S.P.I.M - Obra Social del Personal de la Industria Maderera </strong></p>
    </div></td>
  </tr>
  <tr>
    <td height="70">
	<form id="form1" name="form1" method="post" action="descarga.php?pres=<? echo $pres."&mes=".$mes."&anio=".$anio ?>">
      <p>PRESTADOR: <? print($prestador); ?></p>
      <p>PERIODO DEL PADRON DESCARGADO: <? print($mes.'/'.$anio); ?></p>
      <p>FECHA Y HORA DE DESCARGA: <? print($fecd.' a las '.$hord. ' hrs.');  ?></p>
      <p>NUMERO DE DESCARGA: <? print($cantProx); ?></p>
      <p align="center">
        <input name="submit2" type="submit" value="Descargar Padron" />
      </p>
      <p align="center">
        <input type="button" name="imprimir" value="Imprimir" onclick="window.print();" />
      </p>
	</form>   
  </tr>
</table>
<p>
</p>
</body>
</html>
