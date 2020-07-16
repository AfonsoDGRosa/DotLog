<?php
    session_start();
	require_once "connectdb.php";
	
	if (!isset($_SESSION["authenticated"])) {
		header("Location: login.php");
		exit(0);
	}
	
	$agendar_servico = array_key_exists("Servico", $_POST) ? $_POST["Servico"] : "";
	$agendar_descricao = array_key_exists("message", $_POST) ? $_POST["message"] : "";
	
	
	if (isset($_POST['post_servico'])) {
		
		if ($conn->connect_errno) {
			$code = $conn->connect_errno;
			$message = $conn->connect_error;
			echo "<script>alert('Falha na ligação a base de dados')</script>";
		} else {
		
			$sql = "INSERT INTO servico_cliente(UtilizadorID,ServicoID,Descricao,DataDePedido)VALUES('".$_SESSION['utilizador_id']."','".$agendar_servico."','".$agendar_descricao."',now())";
			
            $result_set = $conn->query($sql);
       
            if ($result_set) {
				echo "<script>alert('Pedido de serviço enviado com sucesso!')</script>";
            } else {
				echo "<script>alert('Falha no pedido de serviço')</script>";
			}
              
    
		}
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviços - DotLog</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/agendar_servicos.css">
</head>
<body>
<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
	<?php
    require_once "navbar.php";

	?>


<div class="p-5">
		<div class="container before_navbar submit_box">
			<form class="form-horizontal" action="" method="post">
			<fieldset>
				<div class="form-group">
				<h4 class="mb-4">Agendar um Serviço</h4>
			
				<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de Serviço</label>
				<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="Servico">

                    <?php 
                        $result = mysqli_query($conn, "SELECT distinct * FROM dotlog.tipo_de_servicos where Detalhes is not null");
                        foreach($result as $row) {
                            {
                                echo "<option value=".$row['ServicoID'].">".$row['Descricao']."</option>";
                                
                            }
                        }
                    ?>
				</select>
				</div>
    
				<div class="form-group">
					<textarea class="form-control" id="message" name="message" placeholder="O que precisa?" rows="5"></textarea>
				</div>
    
				<div class="form-group">
					<div class="col-md-12 text-right">
						<button type="submit" class="btn btn-primary" name="post_servico">Enviar</button>						                
					</div>
				</div>
          </fieldset>
          </form>
			
		</div>
	</div>

</body>

</html>