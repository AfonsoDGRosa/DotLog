<?php
session_start();

$Email = array_key_exists("Email", $_GET) ? $_GET["Email"] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Software</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/backoffice.css">

</head>

<body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>
	
	<div id="wrapper" class="d-flex">
	
		<div class="mainsidebar dark_background">
			
		<div class="sidebar-heading sidebar_padding dark_background">
			DotLog BackOffice
		</div>
		
		<div class="list-group list-group-flush">
			
				<a href="#" class="list-group-item list-group-item-action dark_background">Dashboard</a>
				<a href="admin_utilizadores.php" class="list-group-item list-group-item-action dark_background">Utilizadores</a>
				<a href="#" class="list-group-item list-group-item-action dark_background">Hardware</a>
				<a href="#" class="list-group-item list-group-item-action dark_background">Software</a>
				<a href="#" class="list-group-item list-group-item-action dark_background">Consumiveis</a>
				<a href="#" class="list-group-item list-group-item-action dark_background">Serviços Agendados</a>
			
		</div>
		
		</div>
		
		<div style="min-height:100vh">
			
			<nav class="navbar navbar-expand-lg border-bottom sidebar_padding dark_background2">
				<div>Consumiveis</div>
			</nav>
			
			<div class="container-fluid before_navbar">
				<h1>Editar Utilizadores</h1>
				<br>
				<form method="post">
					
				</form>
			</div>
			
		</div>
		
	</div>
	
    
</body>

</html>