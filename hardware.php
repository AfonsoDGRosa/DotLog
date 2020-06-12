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
  require "connectdb.php";
  
    ?>


<table border="1" style="width:100%">
    <tr>
      <th rowspan="2" style="background-color: rgb(230, 230, 230)">
        <div class="front_text">

          <div>
            <p>SubCategorias</p>
            <br>
            <a href="comercial.php">Comercial</a> <br>
            <a href="videovig.php">Video Vigilancia</a> <br>
            <a href="ctrlaccess.php">Controlo Acesso</a> <br>
          </div>
      </div>
    </th>
    <td style="background-color: whitesmoke; width: 60%; height: 50%;">
      <div class="div_button">
      
      <?php
      $error_message = "";
		
		if ($conn->connect_error) {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
			die("Erro na ligação da base de dados" . $conn->connect_error);
		}
		
		$query1 = "select * from produto where CategoriaID = 1";
		$query2 = "select * from produto where produtoID = 1";
		$query3 = "select * from produto where produtoID = 1";
		
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
						<a href="produto.php?produto=<?php echo htmlspecialchars($row['Nome']); ?>" class="btn btn-primary btn-light servico_button">Saber Mais</a>
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
	
          </p>
        </div>
      </td>
    </tr>

  </table>


<?php
  require_once "footer.php";
 ?>


</body>

</html>
