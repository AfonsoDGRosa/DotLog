<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - DotLog</title>
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
                        <p class="lower_text">Nós temos vários serviços para auxiliar a sua empresa</p>
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
										<?=$row['Detalhes']?></p>
										
										<a href="agendar_servicos.php">Agendar Serviços</a>
										<!--<p><?=$cont?></p>-->
									</div>
									
									<?php
								}
								
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

    <?php
		require_once "footer.php";
	?>
</body>

</html>