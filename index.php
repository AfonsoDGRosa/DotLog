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
  <link rel="stylesheet" type="text/css" href="css/inicial.css">

</head>

<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
  <!--<script src="scripts/simple.js"></script>-->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="images/dotlog_logo.png" class="logo" style="width: 200px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
        
      </ul>

      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto opcao">
          <li class="nav-item opcao">
            <a class="nav-link" href="sobre.html">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link opcao" href="contactos.php">Contactos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Produtos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item opcao" href="#">Hardware</a>
			  <div class="dropdown-divider"></div>
              <a class="dropdown-item opcao" href="#">Software</a>
			  <div class="dropdown-divider"></div>
              <a class="dropdown-item opcao" href="#">Consumiveis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link opcao" href="servicos.html">Serviços</a>
          </li>
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="images/sign_in.png" class="signin" style="width: 25px">
            </a>
            <div class="dropdown-menu dropdown-menu-right text-muted" aria-labelledby="navbarDropdown">
				<!--<p style="border-block-end: 0px">António Silva</p>
				<p style="border-block-end: 0px">SilvaInc</p>-->
				<p style="justify-content:normal;color:rgb(54, 54, 54);padding:.25rem 1.5rem">
					António Silva
					<br>
					SilvaInc
				</p>
				<div class="dropdown-divider"></div>
              <a class="dropdown-item opcao" href="login.php">Sign Out</a>
              
          </li>
		  
        </ul>
      </form>
    </div>
  </nav>
<!--
  <table border="1" style="width:100%">
    <tr>
      <th rowspan="2" style="background-color: rgb(51,51,51)">
        <div class="front_text">

          <div class="Imtext">
            <p class="main_text">Ajudamos a sua companhia de maneira simples</p>
            <p class="lower_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
              neque
              pretium,
              blandit turpis nec, fermentum mi. Ut finibus felis</p>
          </div>
          <div class="POS load">
            <img src="images/Homepage/POS.png" style="width: 500pt;" alt="">
          </div>
        </div>
      </th>
      <td style="background-color: whitesmoke; width: 30%;height: 50%;">
        <div class="div_button">Serviços</div>
      </td>
    </tr>
    <tr style="margin: 0;padding: 0;">
      <td style=" width: 30%;height: 50%;background-color: whitesmoke;">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" style="margin: 0;height:100%; width:100%">
            <div class="carousel-item active">
              <img class="d-block w-100" src="images/Homepage/slider1.png" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/Homepage/slider2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="images/Homepage/slider3.png" alt="Third slide">
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
      </td>
    </tr>

  </table>
-->


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
		<img class="d-block w-100" src="images/Homepage/testing.png" alt="Third slide">
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

	<div class="card text-center 	text-dark servicos_lista servicos_card" style="width: 18rem;">
		<img src="images/Homepage/POS.png" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Produto1</h5>
			<br>
			<p class="card-text">Um dos muitos produtos que a DotLog oferece.</p>
			<a href="produto.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
		</div>
	</div>
	
	<div class="card text-center text-dark servicos_card" style="width: 18rem;">
		<img src="images/Homepage/POS.png" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Produto2</h5>
			<br>
			<p class="card-text">Um dos muitos produtos que a DotLog oferece.</p>
			<a href="produto.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
		</div>
	</div>
	
	<div class="card text-center text-dark servicos_lista servicos_card" style="width: 18rem;">
		<img src="images/Homepage/POS.png" class="card-img-top">
		<div class="card-body">
			<h5 class="card-title">Produto3</h5>
			<br>
			<p class="card-text">Um dos muitos produtos que a DotLog oferece.</p>
			<a href="produto.php" class="btn btn-primary btn-light servico_button">Saber Mais</a>
		</div>
	</div>
	
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
  
  
<!--<footer class="page-footer font-small unique-color-dark footer" style="background-color: #30373f;">

  <br>

  <div class="container text-center text-md-left mt-5">


    <div class="row mt-3">


      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <h6 class="text-uppercase font-weight-bold">Dotlog</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;border-top: 1px solid rgb(255,255,255)">
          <p>lorem ipsum</p>

        </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <h6 class="text-uppercase font-weight-bold">Contactos</h6>
          <hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 60px">
		  <hr class="rgba-white-light" style="margin: 0 15%;">
          <p>Leiria</p>
          <p>dotlog@gmail.com</p>
          <p>923 424 112</p>
          <p>08:00 - 21:00</p>
        </div>
  
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <h6 class="text-uppercase font-weight-bold">Links Rapidos</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
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

  </div>
 
  <div class="footer-copyright text-center font-weight-bold" style="color: white;font-size: 11t;">
	<br>
	© 2020 DotLog
   </div>

</footer>-->
  
</body>

</html>
