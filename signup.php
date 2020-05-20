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
            $apelido= "";
            $pass = "";
            $foto = "";
            if (!empty($_POST)) {
                if (isset($_POST["email"])) {
                    $email = $_POST["email"];
                }
                if (isset($_POST["nome"])) {
                    $nome = $_POST["nome"];
                }
                if (isset($_POST["pass"])) {
                    $pass = $_POST["pass"];
                }
                if (isset($_FILES["foto"]["name"])) {
                    $foto = $_FILES["foto"]["name"];
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
                            if ($foto !== "") {
                                $diretoria_upload = "uploads/";
                                $extensao = pathinfo($foto, PATHINFO_EXTENSION);
                                $nova_foto = $diretoria_upload . microtime() . "." . $extensao;
                                // Check if image file is a actual image or fake image                        
                                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                                if (!$check) {
                                    echo "<p>Ficheiro não é imagem</p>";
                                    $uploadOk = 0;
                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $nova_foto);
                                }
                            }
                            if ($uploadOk) {
                                $nome = mysqli_real_escape_string($conn, $nome);
                                $pass = mysqli_real_escape_string($conn, $pass);
                                $pass = hash('sha512', $pass);
                                if ($foto !== "") {
                                    $sql = "insert into utilizador (Email, PrimeiroNome, Apelido, Pass, Imagem) values ('$email','$nome', '$apelido', '$pass','$nova_foto')";
                                } else {
                                    $sql = "insert into utilizador (Email, PrimeiroNome, Apelido, Pass) values ('$email','$nome', '$apelido', '$pass')";
                                }
                                $result = $conn->query($sql);
                                if ($result) {
                                    echo "Dados registados com sucesso";
                                    $validar = 1;
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
        
            <h2>Novo utilizador</h2> 

            <form action="#" method="post" id="insertUser" enctype="multipart/form-data">
                <label for="idEmail">Email: </label>
                <input type="email" name="email" id="idEmail" required value="' . $email . '">*<br>
                <label for="idNome">Nome: </label>
                <input type="text" name="nome" id="idNome" required value="' . $nome . '">*<br>
                <label for="idApelido">Apelido</label>
                <input type="text" name="apelido" id="idApelido" required value="' . $apelido . '">*<br>
                <label for="idPass">Password: </label>
                <input type="password" name="pass" id="idPass" required >*<br>
                <label for="idFoto">Foto: </label>
                <input type="file" name="foto" id="idFoto"><br>
                
                <input type="submit" value="Inserir" id="btSubmit">
                <input type="reset" value="Limpar" id="btReset">
                 <br>
                 <br>
            </form>
        ';
                if ($foto==""){
                    echo '<div id="zonaImg"><img id="idImgFoto" src="uploads/sem-imagem.png" alt="Imagem" height="90" /><br>
                          <a id="idApagar" href="#" style="display:none">Apagar Imagem</a></div>';
                }else{
                    echo '<div id="zonaImg"><img id="idImgFoto" src="'.$foto.'" alt="Imagem" height="90" /><br>
                          <a id="idApagar" href="#">Apagar Imagem</a></div>';
                }
            }
            ?>

        </section>

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
