<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/inicial.css">
  <link href="css/contacts.css" rel="stylesheet" />
	<title>Contactos</title>
    
  </head>
  <body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>

    <?php
	require_once "navbar.php";
	?>

    <table class="before_navbar" border="0" style="width:50%;border-collapse:collapse">
      <tr>
        <th rowspan="2" style="background-color: rgb(51,51,51)">
          <div class="front_text">
            <div class="Imtext">
              <p class="main_text">Contacte-nos:</p>
              <br />
              <p class="lower_text">
                923 424 112<br />
                Abertos Seg. a Sexta <br/>
                das  09:00 - 19:00
              </p>
            </div>
          </div>
        </th>
		
        <th>
          <div class="lista_container">
                    <div class="lista_div">


                    <div class="Lista">
                        <h2>Morada</h2>
                        <p>R. Cavaleiros da Grande Guerra, Leiria</p>
                    </div>

                    <div class="Lista">
                        <h2>Email Comercial</h2>
                        <p>dotlog@gmail.com</p>
                    </div>

                    <div class="Lista">
                        <h2>Email Administrativo</h2>
                        <p>rec_humanos@dotlog.com</p>
                    </div>

                    <div class="Lista">
                        <h2>Email Técnico</h2>
                        <p>ass_tec@dotlog.com</p>
                    </div>

                    <div class="Lista">
                        <h2>Redes Sociais</h2>
                        <img src="images/face_icon.png" class="face_icon" style="width: 74px"> 
                        <img src="images/linkedin_icon.jpg" class="linkedin_icon" style="width: 74px">
                    </div>

                    </th>
                </div>
                </div>
        </td>
      </tr>
    </table>

    <?php
  require_once "footer.php";

  ?>

  </body>
</html>
