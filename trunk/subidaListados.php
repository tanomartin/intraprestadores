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
<title>Subida Padrones</title>
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
<div align="center"><span class="Estilo3">SUBIDA DE LISTADOS POR PRESTADOR POR DELEGACI&Oacute;N </span> </div>
<div align="center">
  <p><img src="ospimw.jpg" width="158" height="179" /></p>
  <table width="565" border="1">
    <tr>
      <td width="555">
	  
	  <form name="upArc" action="controSubidaListado.php" method="post" enctype="multipart/form-data">
      <p align="center">
	  
	  Prestador: <select name="prestador" id="prestador"> 
	  <?php
	  		$sql = "select * from usuarios";
			$result = mysql_query($sql,$db);
			while($linea = mysql_fetch_array($result)){ 
				//para que no aparezcan sistemas y admi como opcion del desplegable...
				if (($linea['codigo']!="000") and ($linea['codigo']!="999")){
     				echo " <option value=\"".$linea['codigo']."\">".$linea['codigo']." - ".$linea['nombre']."</option>\n"; 
				}
            }
	  ?>
	   </select> 
	  
	  - Mes:   <select name="periodo" size="1" id="periodo">
                      <option value="00">00</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select> 
	  - A&ntilde;o:   <select name="anio" size="1" id="anio">
                      <option value="0000">0000</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
					  <option value="2014">2014</option>
                    </select> 
	  
	  </p>
      <p align="center">
        <input type="file" name="archivo" />
      </p>
      <p align="center">
        <input type="submit" name="Submit" value="Enviar" />
      </p>
      </form></td>
    </tr>
  </table>
</div>
</body>
</html>
