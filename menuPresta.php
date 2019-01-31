<?php
session_save_path ( "sesiones" );
session_start ();
if ($_SESSION ['nrpresta'] == NULL)
	header ( "Location: index.php" );
include ("conexion.php");
$nrpres = $_SESSION ['nrpresta'];
$today = date ( "Y-m-d" );
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Prestadores</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
<link href='https://fonts.googleapis.com/css?family=Roboto:500,700' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="include/js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="include/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css"/>

</head>
<body>
	<div class="container">
		<div class="row" style="margin-top: 10px">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-heading" style="text-align: center; font-size: 25px">Bienvenido - "<?php echo $_SESSION['nombre']  ?>"</div>
				</div>
				<div class="panel-body">
					<h4>Noticias</h4>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						<b>Información para los prestadores de Medicina.</b> En los archivos Excel que conforman los padrones de beneficiarios
						se ha agregado una columna al final de la tabla para la identificación de los beneficiarios que pagan o no <b>coseguro</b>.
						El dato es de tipo numérico, y los valores posibles son <b>0 (NO abona coseguro) y 1 (SI abona coseguro)</b>
					</p>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						Ha sido modificada la frecuencia de publicación de los padrones de beneficiarios de mensual a quincenal.
						Los mismos estarán activos para su descarga <b>los días 8 y 22 de cada mes</b> con los movimientos relacionados 
						a la segunda quincena del mes anterior al mes en curso y a la primera quincena del mes en curso respectivamente.
					</p>
					<hr>
					<h4>Archivos Útiles</h4>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						En el siguiente Link usted podr&aacute; descargar un archivo
						comprimido que contiene ambas tablas codificadoras: <a
							href="files/codificadoras.zip">Tablas Codificadoras </a>
					</p>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						En el siguiente Link usted podr&aacute; descargar un archivo
						pdf donde se explica el contenido de cada columna de los padrones <a
							href="files/referenciacolumnas.pdf" target="_blank">Referencia Columnas </a>
					</p>
					<hr>
					<h4>Descarga de Padrones</h4>
					<table class="table" style="text-align: center">
						<thead>
							<tr>
								<th style="text-align: center">Período</th>
								<th style="text-align: center">Tipo</th>
								<th style="text-align: center">Fecha de Subida</th>
								<th style="text-align: center">Primera Descarga</th>
								<th style="text-align: center">Descarga Padron</th>
							</tr>
						</thead>
						<tbody>
				    <?php 
				   		$sqlPeriodos = "SELECT * FROM periodos WHERE disponible <= '$today' ORDER BY anopad DESC, mespad DESC, quincena DESC LIMIT 6";
				   		$resPeriodos = mysql_query($sqlPeriodos,$db);
				    	while($rowPeriodos = mysql_fetch_array($resPeriodos)) {
									// para saber si pongo o no el link de descarga
									$link = 0;
									// datos de subida
									$sql1 = "select * from subida where codigo = '$nrpres' and mespad=".$rowPeriodos['mespad']." and anopad = ".$rowPeriodos['anopad']." and quincena = ".$rowPeriodos['quincena'];
									$result1 = mysql_query ( $sql1, $db );
									if (mysql_num_rows ( $result1 ) == 0) {
										$subida = "NO SUBIDO";
										$link = 1;
									} else {
										$row1 = mysql_fetch_array ( $result1 );
										$subida = $row1 ['fecsub'] . " // " . $row1 ['horsub'];
										$quincena = $row1['quincena'];
									}
									
									// datos de descarga
									$sql2 = "select * from descarga where codigo = '$nrpres' and mespad=".$rowPeriodos['mespad']." and anopad=".$rowPeriodos['anopad']." and quincena = ".$rowPeriodos['quincena']." and estdes='S' order by codigo, anopad, mespad, nrodes LIMIT 1";
									$result2 = mysql_query ( $sql2, $db );
									if (mysql_num_rows ( $result2 ) == 0) {
										$descarga = "NUNCA";
									} else {
										$row2 = mysql_fetch_array ( $result2 );
										$descarga = $row2 ['fecdes'] . " // " . $row2 ['hordes'];
									} ?>
									<tr>
										<td><?php echo $rowPeriodos['mespad'] . "/" . $rowPeriodos['anopad'] ?></td>
										<?php 
										$infoQuin = "Mensual";
										if ($rowPeriodos['quincena'] == 1) { $infoQuin =  "1era Quincena"; } 
				    					if ($rowPeriodos['quincena'] == 2) { $infoQuin =  "2da Quincena"; }?>
										<td><?php echo $infoQuin?></td>
										<td><?php echo $subida ?></td>
										<td><?php echo $descarga ?></td>
							<?php		if ($link == 1) { ?>
											<td></td>
							<?php		} else { ?>
											<td><a href="javascript:void(window.open('updateDescarga.php?pres=<?php echo $nrpres?>&mes=<?php echo $rowPeriodos['mespad'] ?>&anio=<?php echo $rowPeriodos['anopad'] ?>&quincena=<?php echo $rowPeriodos['quincena']?>'))"> <span title="Descasrgar" style="font-size: 25px" class="glyphicon glyphicon-download "></span> </a></td>
							<?php		}  ?>
									</tr>
						<?php	} ?>
							</tbody>
	 					 </table>
	 				</div>
				    <?php 	// update de la fecha y la hora
							$pres = $_SESSION ['nrpresta'];
							$hoy = date ( "Ymd" );
							$hora = date ( "H:i:s" );
							$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres";
							$result9 = mysql_query ( $sql9, $db ); ?>
							<div class="panel-footer" align="center" style="background-color: #337ab7">
								<a href="logout.php" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-log-out"></span> Salir</a>
							</div>
			</div>
		</div>
  </div>
</body>
</html>
