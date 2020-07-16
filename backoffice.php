<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice Inicio - DotLog</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/backoffice.css">

</head>

<body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>
	
	<div id="wrapper" class="d-flex">
	
		<div id="left_sidebar" class="mainsidebar dark_background">
			
		<div class="sidebar-heading sidebar_padding dark_background">
			DotLog BackOffice
		</div>
		
		<div class="list-group list-group-flush">
			
				<a href="backoffice.php" class="list-group-item list-group-item-action dark_background">Inicio</a>
				<a href="admin_utilizadores.php" class="list-group-item list-group-item-action dark_background">Utilizadores</a>
				<a href="admin_posts.php" class="list-group-item list-group-item-action dark_background">Posts</a>
<div id="accordion">
  <div class="card" style="background-color:rgb(51,51,51); padding:.75rem 1.25rem">
    
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding:0px;color:white;text-decoration:none">
          Produtos
        </button>
      </h5>
    

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="padding:0px">
        <a href="admin_prod_hardware.php" class="list-group-item list-group-item-action dark_background">Hardware</a> 
		<a href="admin_prod_software.php" class="list-group-item list-group-item-action dark_background">Software</a>
		<a href="admin_prod_consumiveis.php" class="list-group-item list-group-item-action dark_background">Consumiveis</a>
      </div>
    </div>
  </div>
  </div>
				
				<a href="admin_servicos.php" class="list-group-item list-group-item-action dark_background">Serviços Agendados</a>
			
		</div>
		
		</div>
		
		<div style="min-height:100vh">
			
			<nav class="navbar navbar-expand-lg border-bottom sidebar_padding dark_background2">
				<div>
					<a id="left_sidebar_button" class="btn">
						<svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
						</svg>
					</a>
				</div>
				<div>BackOffice</div>
				
				<ul class="navbar-nav mr-auto">

				</ul>
				<div class="user_info"><img class="row_image" src="images/sign_in.png" alt="foto"><?php echo $_SESSION['userpname']," ",$_SESSION['useraname']?>
				<a style="color:white;text-decoration:none" href="index.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
				</svg></a>
				</div>
			</nav>
			
			<div class="container-fluid before_navbar">
				<h1>Bem Vindo Ao BackOffice</h1>
				<br>
				<p style="width:100%">Aqui pode adicionar, editar ou apagar dados da base de dados.</p>
				
			</div>
			
		</div>
		
	</div>
	
	<script>
		$("#left_sidebar_button").click(function() {
			if ($("#left_sidebar").hasClass("activated")) {
				$("#left_sidebar").removeClass("activated");
			} else {
				$("#left_sidebar").addClass("activated");
			}
			
		});
	</script>
    
</body>

</html>