<?
session_save_path("sesiones");
session_start();
if ($_SESSION['aut'] != "pepe") {
	session_save_path("sesiones");
	session_start();
	session_unset();
	session_destroy();
	header ("Location: http://www.ospim.com.ar/prestadores/loginPresta.php");
} 
?>