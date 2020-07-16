<?php
session_start();
$produto = array_key_exists("produto", $_GET) ? $_GET["produto"] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/produto.css">

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

  <section class="before_navbar" >
  <?php
  $error_message = "";

  $query1 = "select * from produto where Nome = '$produto'";

  $card1 = $conn->query($query1);

  if($card1->num_rows == 1) { 
    $row = $card1->fetch_assoc();
    ?><div class="produto_box">
    <img src=<?php echo $row['Imagem']?> style="width: 250px; margin-left: 15%; float: left">
      <div>
        <h2 class="card-title"><?php echo $produto ?></h2>
        <p style:"margin-bottom:25%"><?php echo $row['Descricao']?></p>
      </div> 
	  
      <br>
	  <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
	  </div>
	  <?php
  } else { 
    $error_message = "Produto não encontrado";
  }
    ?>
  </section>
  
  <?php
  require_once "footer.php";
 ?>


</body>

</html>
