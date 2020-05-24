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
        echo '<p>email ou pass vazias</p>';
      } else {
        $sql = "SELECT * FROM utilizador WHERE Email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo '<p>sql error</p>';
        } else {
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($result)) {
            $passCheck = hash('sha512', $pass) == $row['Pass'];
            if ($passCheck == false) {
              echo '<p>pass errada 1</p>';
            } else if ($passCheck == true) {
              $validar = 1;

              $_SESSION['userpname'] = $row['PrimeiroNome'];
              $_SESSION['useraname'] = $row['Apelido'];
              echo '<p>Login completo</p>';
            } else {
              echo '<p>pass errada 2</p>';
            }
          } else {

            echo $email;
            echo $pass;
            echo '<p>no user</p>';
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
                <input type="text" name="usermail" id="usermail" class="form-control">
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
