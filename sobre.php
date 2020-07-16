<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre - DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/sobre.css">
  
</head>
<body>
  <script src="scripts/jquery-3.4.1.js"></script>

  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>

<?php
	require_once "navbar.php";
?>

  <table class="before_navbar" id="table_tamanho" style="height: 620px;">
    <tr>
      <th rowspan="2" style="width:30%;background-color: rgb(51,51,51)">
        <div class="front_text">

          <div class="Imtext">
            <p class="main_text">Sobre Nos:</p>
            
            <p class="lower_text">Nós somos uma empresa com o objectivo de ajudar outros negócios com produtos e serviços<!--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu mauris, sagittis ut euismod a, aliquet sed lacus. Sed hendrerit dolor sed vulputate digniss-->
            </p>
          </div>
      </div>
    </th>
    <td>
        <div class="lista_div p-5 d-flex justify-content-center">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/kqqXaLtlCJ4" frameborder="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>			
        </div>
    </td>
    </tr>

  </table>

  <?php
	require_once "footer.php";
  ?>
</body>
</html>
