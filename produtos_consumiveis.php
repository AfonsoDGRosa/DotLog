<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Software</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/produtos.css">
</head>

<body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>
	
    <?php
		require_once "navbar.php";
	?>
    <div class="wrapper">
      <div class="sidebar">
        <h2>Subcategorias</h2><br>
        <br>
        <p>Comercial</p>
        
      </div>
      <div>
      <?php
						require_once "connectdb.php";
						
						if ($conn->connect_error) {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							die("Erro na ligação da base de dados" . $conn->connect_error);
						}
						
						$query = "SELECT Nome, Imagem, Descricao, Preco FROM dotlog.produto where CategoriaId = 3";
						
						$result_set = $conn->query($query);
						
						if ($result_set) {
							if ($result_set->num_rows > 0) {
								while($row = $result_set->fetch_assoc()) { 
                    ?>
                    <ul class="card col">
                    <li class="card-body">
                      <img src=<?=$row['Imagem']?> class="card-img-top p-3" style="width: 200px;">
                      <h5 class="card-title"><?= $row['Nome'] ?></h5>
                      <p class="card-text"><?= $row['Descricao'] ?></p>
                      <a href="produto.php?produto=<?php echo htmlspecialchars($row['Nome']); ?>" class="btn btn-primary btn-light servico_button">Saber Mais</a>
                    </ul>
            
									<?php
								}
								
							}
							
						} else {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
						}
						
					?>
					
      </div>

    </div>
    <?php
  require_once "footer.php";
 ?>
</body>

</html>
