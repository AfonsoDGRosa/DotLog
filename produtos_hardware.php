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
                      <table>
                        <tr>
                          <th>Subcategorias</th>
                        </tr>
                        <tr>
                          <td><button>Consumiveis</button></td>
                          <br>
                          
                        </tr>
                        <tr>
                        <td><button>Video-Vigilancia</button></td>
                        </tr>
                        <tr>
                        <td><button>Controlo Acesso</button></td>
                        </tr>
                      </table>
                    </div>

                </div>
            </th>

            <th>
                <div class="lista_container">
                    <div class="lista_div row" style="overflow: hidden;">

					<?php
						require_once "connectdb.php";
						
						if ($conn->connect_error) {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							die("Erro na ligação da base de dados" . $conn->connect_error);
						}
						
						$query = "SELECT Nome, Imagem, Descricao, Preco FROM dotlog.produto where CategoriaId = 1";
						
						$result_set = $conn->query($query);
						
						if ($result_set) {
							if ($result_set->num_rows > 0) {
								while($row = $result_set->fetch_assoc()) { 
                    ?>
                    <div class="card text-center text-dark col" style="width: 18rem;">
                      <img src=<?=$row['Imagem']?> class="card-img-top p-3">
                      <div class="card-body">
                        <h5 class="card-title"><?= $row['Nome'] ?></h5>
                        <br>
                        
                        <p class="card-text"><?= $row['Descricao'] ?></p>
                        <a href="produto.php?produto=<?php echo htmlspecialchars($row['Nome']); ?>" class="btn btn-primary btn-light servico_button">Saber Mais</a>
                      </div>
                    </div>
            
									
							
									
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
            </th>
        </tr>
    </table>

    <?php
  require_once "footer.php";
 ?>
</body>

</html>
