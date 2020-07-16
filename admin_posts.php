<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
    header('Location: login.php');
    exit(0);
}

$Email = array_key_exists("Email", $_GET) ? $_GET["Email"] : "";

$mensagens = array();

require_once "connectdb.php";

if ($conn->connect_errno) {
    $code = $conn->connect_errno;
    $message = $conn->connect_error;
    $msg_erro = "Falha na ligação a base de dados";
} else {
	$stmt = "SELECT * FROM mensagem";

	$result = $conn->query($stmt);
    if ($result) {

        while ($row = $result->fetch_assoc()) {
            $postID = htmlspecialchars($row['PostID']);
            $mensagem = htmlspecialchars($row['Mensagem']);
			
			$data = htmlspecialchars($row['DataHora']);
			$assunto = htmlspecialchars($row['Assunto']);
			
			$mensagem_pai = htmlspecialchars($row['id_mensagem_pai']);
			$mensagem_pai_tipo = "";
			
			if ($mensagem_pai == null) {
				$mensagem_pai_tipo = "Post";
			} else {
				$mensagem_pai_tipo = "Resposta";
			}
			
            //$foto = htmlspecialchars($row['Imagem']);
            $msg = array('postid' => $postID, 'mensagem' => $mensagem, 'data' => $data, 'assunto' => $assunto, 'mensagem_pai' => $mensagem_pai_tipo);
            $mensagens[] = $msg;
			//$utilizadores[] = $utilizador;
        }
    } else {
        $code = $stmt->errno;
        $message = $stmt->error;
        printf("<p>Query error: %d %s</p>", $code, $message);
    }

    
    $result->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
    <link rel="stylesheet" type="text/css" href="css/backoffice.css">
	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	
</head>

<body>
    <script src="scripts/jquery-3.4.1.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>
	
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			require_once "connectdb.php";
			
			if ($conn->connect_errno) {
				$code = $conn->connect_errno;
				$message = $conn->connect_error;
			} else {
			if (isset($_POST['delete_item'])) {
				$sql = "delete from mensagem WHERE PostID='".$_SESSION["Value_Utilizador"]."';";
				$delete = $conn->query($sql);
				//$sql = "insert into utilizador values(null,'hey','hey','Cliente','hey2@gmail.com','123',null)";
				//$add = $conn->query($sql);
				unset($_SESSION["Value_Utilizador"]);
				unset($_SESSION["Action_Utilizador"]);
				
				header("Location: redirect.php");
			} elseif (isset($_POST['edit_item'])) {
				
				$post_message = $_POST["edit_mensagem"];
				$post_assunto = $_POST["edit_assunto"];
				
				if (empty($post_message) || empty($post_assunto) || strlen($post_message) > 255 || strlen($post_assunto) > 100 ) {
					echo "<script>alert('Campos não foram preenchidos')</script>";
				} else {
					$post_message = $conn->real_escape_string($post_message);
					$post_assunto = $conn->real_escape_string($post_assunto);
					
					$sql = "UPDATE mensagem SET Assunto = '".$post_assunto."', Mensagem = '".$post_message."' WHERE mensagem.PostID = '".$_SESSION["Value_Utilizador"]."';";
					$edit = $conn->query($sql);
					
					unset($_SESSION["Value_Utilizador"]);
					unset($_SESSION["Action_Utilizador"]);
					
					if ($edit) {
						header("Location: redirect.php");
					} else {
						echo "<script>alert('Erro')</script>";
					}
				}
				
			}
			
			}
		}
		
		require_once "connectdb.php";
		
		if ($conn->connect_errno) {
			$code = $conn->connect_errno;
			$message = $conn->connect_error;
		} else {
		
		if (isset($_SESSION["Action_Utilizador"])) {
			$sql = "select * from mensagem where PostID = '".$_SESSION["Value_Utilizador"]."'";
			$search = $conn->query($sql);
			
			if ($sql) {
				if($search->num_rows == 1) { 
					$row = $search->fetch_assoc();
					
					
					//$EditarEmail = $row['Email'];
					$EditarAssunto = $row['Assunto'];
					$EditarMensagem = $row['Mensagem'];
					
				}
			} else {
				$code = $sql->errno;
				$message = $sql->error;
				printf("<p>Query error: %d %s</p>", $code, $message);
		}

    
    $search->close();
			
			
			if ($_SESSION["Action_Utilizador"] == "Delete") {
				?>
				<script type="text/javascript">
					$(window).on('load',function(){
						$('#ModalDelete').modal('show');
					});
				</script>
				<?php
			} elseif ($_SESSION["Action_Utilizador"] == "Edit") {
				?>
					<script type="text/javascript">
						$(window).on('load',function(){
							$('#myModale').modal('show');
						});
					</script>
				<?php
			}
		}
		}
	?>
	
	
	<div id="wrapper" class="d-flex">
	
		<div id="left_sidebar" class="mainsidebar dark_background">
			
		<div class="sidebar-heading sidebar_padding dark_background">
			DotLog BackOffice
		</div>
		
		<div class="list-group list-group-flush">
			
				<a href="backoffice.php" class="list-group-item list-group-item-action dark_background">Inicio</a>
				<a href="admin_utilizadores.php" class="list-group-item list-group-item-action dark_background">Utilizadores</a>
				<a href="admin_posts.php" class="list-group-item list-group-item-action dark_background">Posts</a>
<div id="accordion">
  <div class="card" style="background-color:rgb(51,51,51); padding:.75rem 1.25rem">
    
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding:0px;color:white;text-decoration:none">
          Produtos
        </button>
      </h5>
    

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="padding:0px">
        <a href="admin_prod_hardware.php" class="list-group-item list-group-item-action dark_background">Hardware</a> 
		<a href="admin_prod_software.php" class="list-group-item list-group-item-action dark_background">Software</a>
		<a href="admin_prod_consumiveis.php" class="list-group-item list-group-item-action dark_background">Consumiveis</a>
      </div>
    </div>
  </div>
  </div>
				
				<a href="admin_servicos.php" class="list-group-item list-group-item-action dark_background">Serviços Agendados</a>
			
		</div>
		
		</div>
		
		<div style="min-height:100vh">
			
			<nav class="navbar navbar-expand-lg border-bottom sidebar_padding dark_background2">
				<div>
					<a id="left_sidebar_button" class="btn">
						<svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
						</svg>
					</a>
				</div>
				<div>Posts</div>
				
				<ul class="navbar-nav mr-auto">

				</ul>
				<div class="user_info"><img class="row_image" src="images/sign_in.png" alt="foto"><?php echo $_SESSION['userpname']," ",$_SESSION['useraname']?>
				<a style="color:white;text-decoration:none" href="index.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
				</svg></a>
				</div>
			</nav>
			
			<div class="container-fluid before_navbar">
				<h1>Bem Vindo Ao BackOffice</h1>
				
				<div class="container lg-3 lg-3 mytable">
				<!--<button onclick="inserir()" style="margin-bottom:15px">Adicionar</button>-->
				

				
				
					<table id="mydatatable" class="table table-bordered mydatatable" style="width:100%">
						<thead>
							<tr>
								<th>PostID</th>
								<th>Assunto</th>
								<th>Mensagem</th>
								<th>Data</th>
								<th>Tipo</th>
								<th>Ações</th>
								
							</tr>
						</thead>
						
						<tbody>
							 <?php foreach ($mensagens as $um_utilizador) { ?>
								<tr>
								<td scope="row"><?= htmlspecialchars($um_utilizador['postid']) ?></td>
								<td><?= htmlspecialchars($um_utilizador['assunto']) ?></td>
								<td><?= htmlspecialchars($um_utilizador['mensagem']) ?></td>
								
								<td><?= htmlspecialchars($um_utilizador['data']) ?></td>
								
								<td><?= htmlspecialchars($um_utilizador['mensagem_pai']) ?></td>
								
								
								<td>
									<a href="edit_utilizador.php?Valor=<?php echo htmlspecialchars($um_utilizador['postid']); ?>" class="option_edit" style="text-decoration:none;color:inherit"><svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg></a>
									
									<a href="delete_utilizador.php?Valor=<?php echo htmlspecialchars($um_utilizador['postid']); ?>" class="" style="text-decoration:none;color:inherit"><svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
									<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg></a>
									
									<!--data-toggle="modal" data-target="#ModalDelete"-->

<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" value="25">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja apagar o post?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--<div class="modal-body">
        ...
      </div>-->
	  <form action="" method="post">
      <div class="modal-footer">
        <button type="submit" name="delete_item" class="btn btn-primary">Sim</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
	  </form>
    </div>
  </div>
</div>
									
								</td>
								</tr>
							<?php } ?>
						</tbody>
						
						<tfoot>
						
						</tfoot>
					</table>
				</div>
				
			</div>
			
		</div>
		
	</div>
    
	<div class="modal fade" id="myModale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja editar este post?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
	  
		<label for="">Assunto</label>
		<input type="text" class="form-control" name="edit_assunto" id="edit_assunto" value="<?php echo $EditarAssunto?>">
		<label for="exampleInputEmail1">Mensagem</label>
		<input type="text" class="form-control" name="edit_mensagem" id="edit_mensagem" aria-describedby="emailHelp" value="<?php echo $EditarMensagem?>">
      </div>
	  
      <div class="modal-footer">
        <button type="submit" name="edit_item" class="btn btn-primary">Confirmar</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
	  </form>
    </div>
  </div>
</div>
	
	<script>
		$(document).ready( function () {
			$('#mydatatable').DataTable({
				"scrollX": true
			});
		});
		
		$("#left_sidebar_button").click(function() {
			if ($("#left_sidebar").hasClass("activated")) {
				$("#left_sidebar").removeClass("activated");
			} else {
				$("#left_sidebar").addClass("activated");
			}
			
		});

		
	</script>
	<?php
	/*if (isset($_SESSION["Action"])) {
		unset($_SESSION["Action"]);
	}
	
	if (isset($_SESSION["Value"])) {
		unset($_SESSION["Value"]);
	}*/
	
	?>
</body>

</html>