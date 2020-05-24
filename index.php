<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/inicial.css">

</head>

<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
  <!--<script src="scripts/simple.js"></script>-->
	<?php
		require_once "navbar.php";
	?>

<div id="carouselExampleIndicators" class="carousel slide before_navbar" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
		
		<img class="d-block w-100" src="images/Homepage/Slider_b.png" alt="First slide">
		
    </div>
    <div class="carousel-item">
		<img class="d-block w-100" src="images/Homepage/Slider_a.png" alt="Second slide">
    </div>
    <div class="carousel-item">
		<img class="d-block w-100" src="images/Homepage/Slider_b.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class=".container">
<br><br><br>
<h1 class="text-center" style="font-size:40pt; font-family:oxanium">Produtos Populares</h1>
<br><br><br>
<div class="row justify-content-center">
	
	<?php
		require_once "connectdb.php";
		
		$error_message = "";
		
		if ($conn->connect_error) {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
			die("Erro na ligação da base de dados" . $conn->connect_error);
		}
		
		$query1 = "select * from produto where produtoID = 6";
		$query2 = "select * from produto where produtoID = 5";
		$query3 = "select * from produto where produtoID = 8";
		
		$card1 = $conn->query($query1);
		$card2 = $conn->query($query2);
		$card3 = $conn->query($query3);
		
		if ($card1) {
			$card_array = array(
					1 => $card1,
					2 => $card2,
					3 => $card3,
				);
				
				foreach ($card_array as $for_card => $for_card_value) {
					
			if($for_card_value->num_rows == 1) { 
				$row = $for_card_value->fetch_assoc();
				
				
				?>
				
				<div class="card text-center text-dark servicos_lista servicos_card" style="width: 18rem;">
					<img src="images/Homepage/POS.png" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title"><?= $row['Nome'] ?></h5>
						<br>
						
						<p class="card-text"><?= $row['Descricao'] ?></p>
						<a href="servicos.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
					</div>
				</div>
				<?php 
				} else { 
				$error_message = "Produto não encontrado";
				
				?>
				
				<div class="card text-center 	text-dark servicos_lista servicos_card" style="width: 18rem;">
					<span><?= $error_message ?></span>
				</div>
				<?php }}
		} else { 
				$code = $conn->connect_errno;
				$message = $conn->connect_errno;
				$error_message = "Falha na ligação da base de dados (query1)";
		}
		
	?>
	
	<!--<div class="card text-center text-dark servicos_card" style="width: 18rem;">
		<img src="images/Homepage/POS.png" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Rolo de Papel<br>(Grande)</h5>
			<br>

			<p class="card-text">Rolo de papel de tamanho grande.</p>
			<a href="servicos.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
		</div>
	</div>
	
	<div class="card text-center text-dark servicos_lista servicos_card" style="width: 18rem;">
		<img src="images/Homepage/POS.png" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Terminal Móvel - Zebra MT2070</h5>
			<br>
			<p class="card-text">Um terminal móvel de 320x240 píxeis (cinzento).</p>
			<a href="servicos.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
		</div>
	</div>-->
	
</div>
<br><br><br>
</div>
  
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
