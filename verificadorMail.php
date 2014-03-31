<?php
$datos = array_values($_POST);
$mail = $datos [0];
$nrpresta = $datos [1];

include ("conexion.php");
$sql = "select * from usuarios where codigo = '$nrpresta' and emails = '$mail'";
$result = mysql_query($sql,$db);
$cant = mysql_num_rows($result);

if ($cant > 0) {
	$row=mysql_fetch_array($result);
	$asunto = "Recordatorio de Contraseña del sitio www.ospim.com.ar";
	
	// mensaje
	$mensaje = $row['nombre'].": " . "\r\n";
	$mensaje .= "La contraseña requerida del usuario ".$delcod." es ".$row['claves']." .";
	
	// Para enviar correo HTML, la cabecera Content-type debe definirse
	$cabeceras = "MIME-Version: 1.0" . "\r\n";
	$cabeceras .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	
	// Cabeceras adicionales
	//$cabeceras .= $mail. "\r\n";
	$cabeceras .= "From: O.S.P.I.M. <no-replay@ospim.com.ar>" . "\r\n";
	$cabeceras .= 'Bcc: intranet@ospim.com.ar' . "\r\n";
	
	// Enviarlo
	mail($mail, $asunto, $mensaje, $cabeceras);
	
	header ('location:claveEnviada.php');
} else {
	header ('location:olvido.php?err=1');
}
?>


