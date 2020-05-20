<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/forum.css">

</head>

<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/forum.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
  <!--<script src="scripts/simple.js"></script>-->
	<?php
		require_once "navbar.php";
	?>

	<div class="container before_navbar forum_dotlog">
		<h2>Forum DotLog</h2>
		<p>Seja bem vindo ao forum do DotLog<br>
		Caso tenha algum problema ou dúvida, publique aqui em baixo no forum.</p>
		<br>
		<br>
		<div class="forum_filters">
			<a class="forum_filters_button">trove</a>
			<a class="forum_filters_button">not trove</a>
		</div>
	</div>
	
	<?php
		require_once "connectdb.php";
		
		if ($conn->connect_error) {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
			die("Erro na ligação da base de dados" . $conn->connect_error);
		}
		
		$query = "SELECT * FROM dotlog.posts_principais";
		
		$result_set = $conn->query($query);
		
		if ($result_set) {
			if ($result_set->num_rows > 0) {
				$cont = 0;
				
				?>
				<div class="container forum_post_container">
				<?php
				
				while($row = $result_set->fetch_assoc()) {
					$cont += 1;
					
					
					?>
					
						<div class="container forum_post">
							<img src="images/sign_in.png">
							<h2 style="font-weight:450"><?=$row['Assunto']?></h2>
							<p class="forum_message"><?=$row['Mensagem']?></</p>
							
							<div class="post_more_info">
								<p><?=$row['Nome']." ".$row['Apelido']." | Postado em ".$row['DataHora']?></p>
							</div>
						</div>
						
						<div class="container" style="background-color:white;height:2px">
							<hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 100%;border-top: 1px solid color:rgb(100,100,100))">
						</div>
					<?php
					
				}
				?></div><?php
			}
			
		} else {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
		}
	?>
	

	
	
  
  <footer class="page-footer font-small unique-color-dark footer" style="background-color: #30373f;"><br>
    <div class="container text-center text-md-left mt-5">

      <div class="row mt-3">

        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <h6 class="text-uppercase font-weight-bold">Dotlog</h6>
          <hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 75px;border-top: 1px solid rgb(255,255,255)">
          <p>lorem ipsum</p>

        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <h6 class="text-uppercase font-weight-bold">Contactos</h6>
          <hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 110px;border-top: 1px solid rgb(255,255,255)">
          <p>Leiria</p>
          <p>dotlog@gmail.com</p>
          <p>923 424 112</p>
          <p>08:00 - 21:00</p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase font-weight-bold">Links Rapidos</h6>
          <hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 150px;border-top: 1px solid rgb(255,255,255)">
          <p>
            <a href="#!">Home</a>
          </p>
          <p>
            <a href="#!">Serviços</a>
          </p>
          <p>
            <a href="#!">Sobre</a>
          </p>
          <p>
            <a href="#!">Contactos</a>
          </p>

        </div>

      </div>

	  
	  <div class="footer-copyright text-center font-weight-bold" style="color: white;font-size: 11t;">© 2020 DotLog
    </div>
    </div>
    
  </footer>
  
</body>

</html>