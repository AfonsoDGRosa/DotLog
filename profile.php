<?php
    session_start();
    require "connectdb.php";
	
	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($conn->connect_errno) {
				$code = $conn->connect_errno;
				$message = $conn->connect_error;
		} else {
			if (isset($_POST['update_imagem'])){
				
				$post_foto_edit = $_FILES["get-img"]['name'];
				
				//$sql = "UPDATE utilizador SET PrimeiroNome = '".$_POST["edit_nome"]."',Apelido = '".$_POST["edit_apelido"]."', Email = '".$_POST["edit_email"]."' WHERE utilizador.Email = '".$_SESSION["Value_Utilizador"]."';";				
					
					if ($post_foto_edit != "" && getimagesize($_FILES['get-img']['tmp_name'])) {
						
						$diretoria_upload = "uploads/foto/";
						$extensao = pathinfo($post_foto_edit, PATHINFO_EXTENSION);
						$novo_ficheiro = $diretoria_upload . sha1(microtime()) . "." . $extensao;
						
						if (move_uploaded_file($_FILES['get-img']['tmp_name'], $novo_ficheiro)) {
							//echo "<script>alert('Upload da imagem bem sucedido!')</script>";
							//$sql = "insert into utilizador values(null,'".$post_nome."','".$post_apelido."','Cliente','".$post_email."',Sha2('123',512),'".$novo_ficheiro."')";
							$sql = "UPDATE utilizador SET Imagem = '".$novo_ficheiro."' WHERE utilizador.UtilizadorID = '".$_SESSION['utilizador_id']."';";
							$edit = $conn->query($sql);
							
							if ($edit) {
								header("Location: redirect.php");
							} else {
								echo "<script>alert('Erro')</script>";
							}
							
						} else {
							echo "<script>alert('Houve um problema no upload da imagem')</script>";
						}
					
					} else {
						echo "<script>alert('Não introduziu uma imagem')</script>";
					}

			}
		}
	}
	
	
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
								
								$profile_nome = htmlspecialchars($row['PrimeiroNome']);
								$profile_apelido = htmlspecialchars($row['Apelido']);
								$profile_perfil = htmlspecialchars($row['Perfil']);
								$profile_imagem = htmlspecialchars($row['Imagem']);
								$profile_email = htmlspecialchars($row['Email']);
								
								if (empty($profile_imagem)) {
									$profile_imagem = "images/sign_in.png";
								}
								
							}
						} else {
							$code = $conn->connect_errno;
							$message = $conn->connect_errno;
							$error_message = "Falha na ligação da base de dados (query1)";
						}
						
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefil - DotLog</title>
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
            <div class="px-4 pt-4 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
					
                    <div class="profile mr-3"><img src=<?php echo $profile_imagem ?> alt="..." width="130" class="rounded mb-2 img-thumbnail">
					
					
					
					<button type="button" class="btn btn-dark btn-sm btn-block" style="margin-bottom:15px" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Mudar Imagem</button>
	
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Mudar Imagem</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				
				
				
				<div class="modal-body">
				
				<form action="" method="post" enctype="multipart/form-data">
				
				
				
				
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Imagem:</label><br>
					<input type="file" class="btn" id="get-img" name="get-img">
				</div>
				
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" name="update_imagem">Confirmar</button>
				</form>
				</div>
				</div>
				</div>
				</div>
					
					
					
					
					</div>
                    <div class="media-body mb-5 text-white">
						
									<h4 class="mt-0 mb-0"><?=$profile_nome." ".$profile_apelido?></h4>
								
                        
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i><?=$profile_perfil?></p>
						
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
					<h5>Informação de Contactos</h5>
					<p>E-Mail: <?=$profile_email?></p>
						
               
					
                </div>
            </div>
           </div>

          </div>
   </div>


    </div>
</div>

</body>

</html>