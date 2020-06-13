<?php
    session_start();
    require "connectdb.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>
<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
	<?php
    require_once "navbar.php";
	?>

<div class="row py-5 px-4 before_navbar">
    <div class="col-xl-12 col-md-6 col-sm-10 mx-auto">


      <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <div class="profile mr-3"><img src="images/sign_in.png" alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="#" class="btn btn-dark btn-sm btn-block">Edit profile</a></div>
                    <div class="media-body mb-5 text-white">
                    <?php
						$error_message = "";
						
						if ($conn->connect_error) {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							die("Erro na ligação da base de dados" . $conn->connect_error);
						}
						
						$query = "SELECT * FROM utilizador where UtilizadorID = '".$_SESSION['utilizador_id']."'";
						
						$result_set = $conn->query($query);
						
						if ($result_set) {
							if ($result_set->num_rows == 1) {
								$row = $result_set->fetch_assoc();
								?>
									<h4 class="mt-0 mb-0"><?=$row['PrimeiroNome']." ".$row['Apelido']?></h4>
								<?php
							}
						} else {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							$error_message = "Falha na ligação da base de dados (query1)";
						}
                      //if (isset($_SESSION['userpname'])){
                      //  echo'<h4 class="mt-0 mb-0">' .$_SESSION['userpname'] . '</h4>';
                      //}

                    ?>
                        
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i><?=$row['Perfil']?></p>
						
						<?php
							$result_set->free();
							$conn->close();
						?>
						
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">

            </div>

            <div class="py-4 px-4">
                <div class="py-4">
                    <h5 class="mb-3">Sobre mim</h5>
                    <div class="p-4 bg-light rounded shadow-sm">
                        <p class="font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                </div>
            </div>
           </div>

          </div>
   </div>


    </div>
</div>

</body>

</html>