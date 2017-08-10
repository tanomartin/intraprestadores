<?php session_save_path("sesiones");
session_start();
include ("conexion.php");
$sql = "select * from usuarios where codigo = '".$_POST['usuario']."' and claves = '".$_POST['pass']."'";
$result = mysql_query($sql,$db);
$cant = mysql_num_rows($result);
if ($cant > 0) {
	$row = mysql_fetch_assoc($result);
	$_SESSION['nrpresta'] = $_POST['usuario'];
	$_SESSION['nombre'] = $row['nombre'];
}
echo $cant;
?>
