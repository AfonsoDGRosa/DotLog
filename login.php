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
    $pass = "";
    if (isset($_POST['login-submit'])) {

      $email = $_POST['usermail'];
      $pass = $_POST['pass'];

      if (empty($email) || empty($pass)) {
        echo '<p>Email ou Password vazios</p>';
      } else {
        $sql = "SELECT * FROM utilizador WHERE Email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo '<p>Erro de conexão à base de dados</p>';
        } else {
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $passCheck = hash('sha512', $pass) == $row['Pass'];
            if ($passCheck == false) {
              echo '<p>Password Errada</p>';
            } else if ($passCheck == true) {
              $validar = 1;

              $_SESSION['userpname'] = $row['PrimeiroNome'];
              $_SESSION['useraname'] = $row['Apelido'];
			  $_SESSION['utilizador_id'] = $row['UtilizadorID'];
			  
			  $_SESSION['authenticated'] = true;
			  
			  if ($row['Perfil'] == "Administrador") {
				header("Location: listUser.php");
			  } else {
				header("Location: index.php");  
			  }
			  exit(0);
			  
            } else {
              echo '<p>Password Errada</p>';
            }
          } else {

            echo '<p>Email errado!!</p>';
          }
        }
      }
    } else if ($validar == 0) {
      echo '
    <div id="login">
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
          <div id="login-box" class="col-md-12">
            <form id="login-form" class="form" action="" method="post">
              <img id="login-img" src="images/sign_in.png" class="signin">
              <div class="form-group">
                <label for="usermail" class="text-info">E-mail:</label><br>
                <input type="email" name="usermail" id="usermail" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Password:</label><br>
                <input type="password" name="pass" id="password" class="form-control">
              </div>
              <div class="form-group">
                <br>
                <input type="submit" name="login-submit" class="btn btn-info btn-md" value="submit">
              </div>
              <div id="register-link" class="text-right">
                <a href="signup.php" class="text-info">Register here</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>';
    }

    ?>
  </section>
  <?php
  require_once "footer.php";

  ?>


</body>

</html>
