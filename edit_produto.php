<?php
	session_start();
	$Valor = array_key_exists("Valor", $_GET) ? $_GET["Valor"] : "";
	
	$_SESSION["Value_Hardware"] = $Valor;
	$_SESSION["Action_Hardware"] = "Edit";
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>
