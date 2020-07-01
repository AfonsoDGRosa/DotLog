<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up - DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/inicial.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">

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

  <section class="before_navbar">
    <?php
    $validar = 0;
    $email = "";
    $nome = "";
    $apelido = "";
    $pass = "";
    if (!empty($_POST)) {
      if (isset($_POST["email"])) {
        $email = $_POST["email"];
      }
      if (isset($_POST["nome"])) {
        $nome = $_POST["nome"];
      }
	  if (isset($_POST["apelido"])) {
        $apelido = $_POST["apelido"];
      }
      if (isset($_POST["pass"])) {
        $pass = $_POST["pass"];
      }
      if (!empty($email) && !empty($nome) && !empty($pass)) {
        if ($conn->connect_errno) {
          $code = $conn->connect_errno;
          $message = $conn->connect_error;
          echo "<p>Erro de conexão à base de dados: $code $message</p>";
        } else {
          $email = mysqli_real_escape_string($conn, $email);

          $sql = "SELECT email FROM utilizador where email='$email'";
          $result = $conn->query($sql);

          if ($result && $result->num_rows) {
            echo "<p>Já existe o email indicado</p>";
          } else {
            $uploadOk = 1;
            if ($uploadOk) {
              $nome = mysqli_real_escape_string($conn, $nome);
              $pass = mysqli_real_escape_string($conn, $pass);
              $apelido = mysqli_real_escape_string($conn, $apelido);
              $pass = hash('sha512', $pass);
              //$sql = "insert into utilizador (Email, PrimeiroNome, Apelido, Pass) values ('$email','$nome', '$apelido', '$pass')";
			  $sql = "insert into utilizador values(null,'$nome','$apelido','Cliente','$email','$pass',null)";
              $result = $conn->query($sql);
              if ($result) {
                echo "Dados registados com sucesso";
                $validar = 1;
                header("Location: index.php");
              } else {
                $code = $conn->errno;
                $message = $conn->error;
                echo "<p>Erro ao inserir utilizador: $code $message</p>";
              }
            }
          }
          $conn->close();
        }
      } else {
        echo "<p>Introduza valores para os campos obrigatórios</p>";
      }
    }
    if ($validar == 0) {
      echo '
        <div id="login">
        <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
                    <form action="#" class="form" method="post" id="login-form" enctype="multipart/form-data">
					<img id="login-img" src="images/sign_in.png" class="signin">
					<div class="text-center h4 mt-2">Registar Conta</div>
                    <div class="form-group">
                      <label for="idEmail" class="text-info">*Email:</label><br>
                      <input class="form-control" type="email" name="email" id="idEmail" required value="' . $email . '"><br>
                    </div>
                      <div class="form-group">
                      <label for="idNome" class="text-info">*Nome: </label>
                      <input class="form-control" type="text" name="nome" id="idNome" required value="' . $nome . '"><br>
                    </div>
                      <div class="form-group">
                      <label for="idApelido" class="text-info">Apelido</label>
                      <input class="form-control" type="text" name="apelido" id="idApelido" required value="' . $apelido . '"><br>
                    </div>
                      <div class="form-group">

                      <label for="idPass" class="text-info">*Password: </label>
                      <input class="form-control" type="password" name="pass" id="idPass" required ><br>
                    </div>
                      
                      <div class="form-group">
                      <input class="btn btn-info btn-md" type="submit" value="Criar Conta" id="btSubmit">
					  <input class="btn btn-info btn-md" type="reset" value="Limpar" id="btReset">
					  
                      
                      </div>
                     </form>
                     </div>
                     </div>
                     </div>
                     </div>
                     </div>
        ';
    }
	
	/*$query_count = "select count(*) as total_users from utilizador";
	$result_count = $conn->query($query_count);
	
	if ($result_count) {
		$row = $result_count->fetch_assoc()
		?><p>Utilizadores Totais: <?=$row['total_users']?></p><?php
	}*/
	
	
	
    ?>

  </section>

  <?php
  require_once "footer.php";

  ?>


</body>

</html>
