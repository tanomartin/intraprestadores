<?php session_save_path("sesiones");
session_start();
if($_SESSION['nrpresta'] == NULL)
	header ("Location: loginPresta.php?err=2");
include ("conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>controlSubida</title>
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
-->
</style>
</head>
<?php
	$error=0;
	$datos = array_values($_POST);
	$pres=$datos[0];
	$mes=$datos[1];
	$anio=$datos[2];
	$arc=$_FILES['archivo']['name'];
	$archivo=$_FILES['archivo']['tmp_name'];
	$preArc=(int)substr($arc,0,3);
	$tipArc=substr($arc,3,1);
	$mesArc=(int)substr($arc,4,2);
	$anioArc=(int)substr($arc,6,4);
	
	
?>
<body>
<div align="center"><span class="Estilo3">CONTROL DATOS SUBIDA  </span> </div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" /></p>
  <table width="383" border="1">
    <tr>
      <td width="133"><em><strong>Mes</strong></em></td>
      <td width="234"><div align="center">
        <?php
	  	if ($mes == 0) {
			print("ERROR");
			$error=1;
		}
		else {
			print("$mes");
		}
	  ?>
      </div></td>
    </tr>
    <tr>
      <td><em><strong>A&ntilde;o</strong></em></td>
      <td> 
	    <div align="center">
	      <?php
	  	if ($anio == 0) {
			print("ERROR");
			$error=1;
		}
		else {
			print("$anio");
		}
	  ?>	  
      </div></td>
    </tr>
    <tr>
      <td><em><strong>Archivo</strong></em></td>
      <td>
	  	<div align="center">
	  	  <?php
		  	//para mostrar el prestador...
		  	$arcOK=0;
			if ($preArc!=$pres) {
				print("ERROR: Incomptibilidad Prestador<br />");
				$error=1;
				$arcOK=1;
			}
			if ($mesArc!=$mes) {
				print("ERROR: Incomptibilidad Mes<br />");
				$error=1;
				$arcOK=1;
			} 
			if ($anioArc!=$anio) {
				print("ERROR: Incomptibilidad A�o<br />");
				$error=1;
				$arcOK=1;
			}
			if ($tipArc!="D") {
				print("ERROR: Incomptibilidad de Tipo de Archivo<br />");
				$error=1;
				$arcOK=1;
			}
			if ($arcOK == 0) {
				$sql = "select * from usuarios where codigo=$pres";
				$result = mysql_query($sql,$db);
				$row = mysql_fetch_array($result);
				print($row['nombre']);
			}
			
		?>	  
  	    </div></td>
    </tr>
  </table>
  <p>
  <?php
  	if ($error==1) {
		print ("SE PRODUJO UN ERROR - NO SE HA SUBIDO EL ARCHIVO<br />");
	} else {
		$destino=$pres."C23".$pres."/".$arc;
		if (!copy($archivo,$destino)) {
			print ("SE PRODUJO UN ERROR AL COPIAR EL ARCHIVO - NO SE HA SUBIDO EL ARCHIVO<br />");
		}
	}
	
  ?>
  </p>
  	<p>	<input type="button" name="salir" value="VOLVER" onclick="location.href='subidaListados.php'"/></p>
</div>
</body>
</html>
