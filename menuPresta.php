<?php
session_save_path ( "sesiones" );
session_start ();
if ($_SESSION ['nrpresta'] == NULL)
	header ( "Location: index.php" );

include ("conexion.php");
$nrpres = $_SESSION ['nrpresta'];

// me da el mes que corresponde al año anterior...
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
	if (($per == 6) || ($per == - 6)) {
		return "06";
	}
	if (($per == 7) || ($per == - 5)) {
		return "07";
	}
	if (($per == 8) || ($per == - 4)) {
		return "08";
	}
	if (($per == 9) || ($per == - 3)) {
		return "09";
	}
	if (($per == 10) || ($per == - 2)) {
		return "10";
	}
	if (($per == 11) || ($per == - 1)) {
		return "11";
	}
	if (($per == 12) || ($per == 0)) {
		return "12";
	}
}

$dia = date ( "j" );
$mes = date ( "m" );
$anio = date ( "Y" );

if ($dia < 15) {
	$inicio = 2;
	$fin = 7;
} else {
	$inicio = 1;
	$fin = 6;
}

for($i = $inicio; $i <= $fin; $i ++) {
	$perAux = $mes - $i;
	if ($perAux <= 0) {
		$anioArc [$i] = $anio - 1;
		$mesArc [$i] = formatoPerido ( $perAux );
	} else {
		$anioArc [$i] = $anio;
		$mesArc [$i] = formatoPerido ( $perAux );
	}
}

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
		<h2 align="center">Menu Prestadores</h2>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Padrones</h2>
				</div>
				<div class="panel-body">
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						Comunicamos que a partir de los padrones correspondientes a
						<b>Noviembre de 2014 (11/2014)</b> en el archivo excel que contiene la
						información de beneficiarios titulares la columna "L" (código de
						empresa) ya no contendrá esa información. Para identificar la
						empresa donde trabajan los beneficiarios titulares deberá utilizar
						sólo el C.U.I.T.</p>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						Comunicamos que a partir de los padrones correspondintes a 
						<b>Febrero de 2015 (02/2015)</b> en el archivo de
						excel que contiene la informaci&oacute;n de beneficiarios
						titulares en la columna &quot;I&quot; (provincia) se ha modificado
						el dato conteniendo un c&oacute;digo en lugar del nombre. De igual
						manera en el archivo de excel que contiene la informaci&oacute;n
						de beneficiarios familiares en la columna &quot;B&quot; (tipo de
						familiar) se ha modificado el dato conteniendo un c&oacute;digo en
						lugar de la descripci&oacute;n.
					</p>
					<p>
						<span style="color: green" class="glyphicon glyphicon-exclamation-sign "></span> 
						En el siguiente Link usted podr&aacute; descargar un archivo
						comprimido que contiene ambas tablas codificadoras: <a
							href="files/codificadoras.zip">Tablas Codificadoras </a>
					</p>
					<table class="table" style="text-align: center">
						<thead>
							<tr>
								<th style="text-align: center">Per&iacute;odo</th>
								<th style="text-align: center">Fecha de Subida</th>
								<th style="text-align: center">Primera Descarga</th>
								<th style="text-align: center">Descarga Padron</th>
							</tr>
						</thead>
						<tbody>
				    <?php for($i = $inicio; $i <= $fin; $i ++) {
									// para saber si pongo o no el link de descarga
									$link = 0;
									// datos de subida
									$sql1 = "select * from subida where codigo = '$nrpres' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]'";
									$result1 = mysql_query ( $sql1, $db );
									$row1 = mysql_fetch_array ( $result1 );
									if (mysql_num_rows ( $result1 ) == 0) {
										$subida = "NO SUBIDO";
										$link = 1;
									} else {
										$subida = $row1 ['fecsub'] . " // " . $row1 ['horsub'];
									}
									
									// datso de descarga
									$sql2 = "select * from descarga where codigo = '$nrpres' and mespad='$mesArc[$i]' and anopad='$anioArc[$i]' and estdes='S' order by codigo, anopad, mespad, nrodes LIMIT 1";
									$result2 = mysql_query ( $sql2, $db );
									$row2 = mysql_fetch_array ( $result2 );
									if (mysql_num_rows ( $result2 ) == 0) {
										$descarga = "NUNCA";
									} else {
										$descarga = $row2 ['fecdes'] . " // " . $row2 ['hordes'];
									} ?>
									<tr>
										<td><?php echo $mesArc [$i] . "/" . $anioArc [$i] ?></td>
										<td><?php echo $subida ?></td>
										<td><?php echo $descarga ?></td>
							<?php		if ($link == 1) { ?>
											<td></td>
							<?php		} else { ?>
											<td><a href="javascript:void(window.open('updateDescarga.php?pres=$nrpres&mes=<?php echo $mesArc[$i] ?>&anio=<?php echo $anioArc[$i] ?>'))"> <span title="Descasrgar" style="font-size: 25px" class="glyphicon glyphicon-download "></span> </a></td>
							<?php		}  ?>
									</tr>
						<?php	} ?>
							</tbody>
	 					 </table>
    <?php if (($_SESSION ['nrpresta'] != "000") and ($_SESSION ['nrpresta'] != "999")) {
					// update de la fecha y la hora
					$pres = $_SESSION ['nrpresta'];
					$hoy = date ( "Ymd" );
					$hora = date ( "H:i:s" );
					$sql9 = "UPDATE usuarios SET fecuac= '$hoy', horuac = '$hora' where codigo = $pres";
					$result9 = mysql_query ( $sql9, $db );
					?>
					<div class="panel-footer" align="center">
						<a href="logout.php" class="btn btn-info btn-lg">
				          <span class="glyphicon glyphicon-log-out"></span> Salir
				        </a>
					</div>
  <?php	} ?>
			  </div>
			</div>
		</div>
  </div>
</body>
</html>
