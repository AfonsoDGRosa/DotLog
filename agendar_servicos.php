<?php
    session_start();
    require "connectdb.php";
	
	if (!isset($_SESSION["authenticated"])) {
		header("Location: login.php");
		exit(0);
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

    $tp_servico = "";
    $servico_desc = "";

	?>


<div class="p-5">
		<div class="container before_navbar submit_box">
			<form class="form-horizontal" action="" method="post">
			<fieldset>
				<div class="form-group">
				<h4 class="mb-4">Agendar um Serviço</h4>
			
				<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tipo de Serviço</label>
				<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option value= "0" >---</option>
                    <?php 
                        $result = mysqli_query($conn, "SELECT distinct * FROM dotlog.tipo_de_servicos where Detalhes is not null");
                        foreach($result as $row) {
                            {
                                echo "<option value=".$row['Descricao'].">".$row['Descricao']."</option>";
                                
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
						<button type="submit" class="btn btn-primary">Enviar</button>
						
                <?php
                    $result = mysqli_query($conn, "SELECT distinct * FROM dotlog.tipo_de_servicos where Descricao = ServicoID");
                    $sql = "INSERT INTO servico_cliente(UtilizadorID,ServicoID,Descricao,DataDePedido)VALUES(
                      '".$_SESSION['utilizador_id']."',
                      '".$row['ServicoID']."',
                      '".$row['Descricao']."',
                      '2020-04-02 11:12:11')";

                      $result_set = $conn->query($sql);

                   
                        if ($result_set) {
							printf("sucesso");
                        } else {
							printf("erro");
						}
              
                ?>

                
					</div>
				</div>
          </fieldset>
          </form>
			
		</div>
	</div>

</body>

</html>