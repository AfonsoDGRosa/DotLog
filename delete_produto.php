<?php
	session_start();
	$Valor = array_key_exists("Valor", $_GET) ? $_GET["Valor"] : "";
	
	$_SESSION["Value_Produto"] = $Valor;
	$_SESSION["Action_Produto"] = "Delete";
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>
