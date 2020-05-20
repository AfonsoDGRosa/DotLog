<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/servicos.css">
    
</head>

<body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>
	
    <?php
		require_once "navbar.php";
	?>

    <table id="table_tamanho" style="width:50%; height: 600px;">
        <tr>
            <th rowspan="2" style="background-color: rgb(51,51,51)">
                <div class="front_text">

                    <div class="Imtext">
                        <p class="main_text">Os Nossos serviços</p>
                        <p class="lower_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet
                            neque
                            pretium,
                            blandit turpis nec, fermentum mi. Ut finibus felis</p>
                    </div>

                </div>
            </th>

            <th>
                <div class="lista_container">
                    <div class="lista_div">

					<?php
						require_once "connectdb.php";
						
						if ($conn->connect_error) {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							die("Erro na ligação da base de dados" . $conn->connect_error);
						}
						
						$query = "SELECT distinct Descricao,Detalhes FROM dotlog.tipo_de_servicos where Detalhes is not null";
						
						$result_set = $conn->query($query);
						
						if ($result_set) {
							
							if ($result_set->num_rows > 0) {
								$total_servicos = $result_set->num_rows;
								
								//$row = $result_set->fetch_assoc();
								$cont = 0;
								while($row = $result_set->fetch_assoc()) {
									$cont += 1;
									?>
									
									<div class="Lista">
										<h2><?=$row['Descricao']?></h2>
										<!--<p><?=$row['Detalhes']?></p>-->
										<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia omnis excepturi voluptatibus id iusto? Atque earum nobis eligendi architecto inventore, voluptate minima rem et nemo quo placeat illo voluptatum quas!</p>
										<a href="forum.php">Agendar Serviços</a>
										<!--<p><?=$cont?></p>-->
									</div>
									
									<?php
								}
								
								//for ($i = 0;$i < $total_servicos;$i++) {
									//echo "yatta desu ne!!!! UWU<br>";
									

									
									//<div class="Lista">
									//	<h2>Assitencia Por Telefone</h2>
									//	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia omnis excepturi voluptatibus id iusto? Atque earum nobis eligendi architecto inventore, voluptate minima rem et nemo quo placeat illo voluptatum quas!</p>
									//</div>
								//}
								
							}
							
						} else {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
						}
						
					?>
					
                    </td>
                </div>
                </div>
            </th>

    </table>

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