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
    <title>Document</title>
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

<div class="container before_navbar">
	<div class="row">
      <div class="col-md-12 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">
          <fieldset>
            <legend class="text-center">Agende um serviço</legend>

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

    <div class="custom-control custom-checkbox my-1 mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="customControlInline">
    </div>
    
            <div class="form-group">
              <label class="my-1 mr-2" for="message">Mensagem</label>
              <div class="col-md-8">
                <textarea class="form-control" id="message" name="message" placeholder="O que precisa?" rows="5"></textarea>
              </div>
            </div>
    
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-dark btn-lg">Enviar</button>
                
                <?php
                    $result = mysqli_query($conn, "SELECT distinct * FROM dotlog.tipo_de_servicos where Descricao = ServicoID");
                    $sql = "INSERT INTO servico_cliente(UtilizadorID,ServicoID,Descricao,DataDePedido)VALUES(
                      '".$_SESSION['utilizador_id']."',
                      '".$row['ServicoID']."',
                      '".$row['Descricao']."',
                      '2020-04-02 11:12:11')";

                      $result_set = $conn->query($sql);

                   
                        if ($result_set) {
							
                        }
              
                ?>

                
                </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
	</div>
</div>

</body>

</html>