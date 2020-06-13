<?php
	session_start();
	$Valor = array_key_exists("Valor", $_GET) ? $_GET["Valor"] : "";
	
	$_SESSION["Value_Utilizador"] = $Valor;
	$_SESSION["Action_Utilizador"] = "Delete";
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	
?>