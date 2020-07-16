<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
    header('Location: login.php');
    exit(0);
}

$ProdId = array_key_exists("ProdutoId", $_GET) ? $_GET["ProdutoId"] : "";

$produtos = array();
$pesquisa = array_key_exists("pesquisa", $_GET) ? $_GET["pesquisa"] : "";

require_once "connectdb.php";

if ($conn->connect_errno) {
    $code = $conn->connect_errno;
    $message = $conn->connect_error;
    $msg_erro = "Falha na ligação a base de dados";
} else {
	$stmt = "SELECT * FROM produto WHERE CategoriaID =3";
	
    $criterio = "%$pesquisa%";

	$result = $conn->query($stmt);
    if ($result) {

        while ($row = $result->fetch_assoc()) {
						$prodid = htmlspecialchars($row['ProdutoID']);
            $nome = htmlspecialchars($row['Nome']);
            $descricao = htmlspecialchars($row['Descricao']);
						$foto = htmlspecialchars($row['Imagem']);
						$preco = htmlspecialchars($row['Preco']);
            $produto = array('produtoid' =>$prodid ,'nome' => $nome, 'descricao' => $descricao, 'foto' => $foto, 'preco' => $preco);
            $produtos[] = $produto;
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
		$post_foto = array_key_exists('recipient-img', $_FILES) ? $_FILES['recipient-img']['name'] : "";
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			require_once "connectdb.php";
			
			if ($conn->connect_errno) {
				$code = $conn->connect_errno;
				$message = $conn->connect_error;
			} else {
			if (isset($_POST['add_item'])){
				
				if (!empty($descricao) && !empty($nome) && !empty($preco)) {
					$sql = "INSERT into produto values(null,'".$_POST["recipient-nome"]."','".$_POST["recipient-img"]."','".$_POST["recipient-descr"]."','".$_POST["recipient-preco"]."',3,1);";
					
					if ($post_foto != "" && getimagesize($_FILES['recipient-img']['tmp_name'])) {
						
						$diretoria_upload = "uploads/produtos/";
						$extensao = pathinfo($post_foto, PATHINFO_EXTENSION);
						$novo_ficheiro = $diretoria_upload . sha1(microtime()) . "." . $extensao;
						
						if (move_uploaded_file($_FILES['recipient-img']['tmp_name'], $novo_ficheiro)) {
							echo "<script>alert('Upload da imagem bem sucedido!')</script>";
							$sql = "INSERT into produto values(null,'".$_POST["recipient-nome"]."','".$novo_ficheiro."','".$_POST["recipient-descr"]."','".$_POST["recipient-preco"]."',3,1);";
						} else {
							echo "<script>alert('Houve um problema no upload da imagem')</script>";
						}
					
					}
					
					
					
					$add = $conn->query($sql);
					header("Location: redirect.php");
										
				}
				else {
					echo "<script>alert('Campos não foram preenchidos')</script>";
				}
			} elseif (isset($_POST['delete_item'])) {
				$sql = "delete from produto WHERE ProdutoID='".$_SESSION["Value_Produto"]."';";
				$delete = $conn->query($sql);
				unset($_SESSION["Value_Produto"]);
				unset($_SESSION["Action_Produto"]);
				
				header("Location: redirect.php");
			} elseif (isset($_POST['edit_item'])) {
				$sql = "UPDATE produto SET Nome = '".$_POST["edit_nome"]."', Preco = '".$_POST["edit_preco"]."' WHERE produto.ProdutoID = '".$_SESSION["Value_Produto"]."';";
				
				
				if ($post_foto != "" && getimagesize($_FILES['recipient-img']['tmp_name'])) {
						
					$diretoria_upload = "uploads/produtos/";
					$extensao = pathinfo($post_foto, PATHINFO_EXTENSION);
					$novo_ficheiro = $diretoria_upload . sha1(microtime()) . "." . $extensao;
					
					if (move_uploaded_file($_FILES['recipient-img']['tmp_name'], $novo_ficheiro)) {
						echo "<script>alert('Upload da imagem bem sucedido!')</script>";
						//$sql = "insert into utilizador values(null,'".$post_nome."','".$post_apelido."','Cliente','".$post_email."',Sha2('123',512),'".$novo_ficheiro."')";
						$sql = "UPDATE produto SET Nome = '".$_POST["edit_nome"]."', Preco = '".$_POST["edit_preco"]."', Imagem = '".$novo_ficheiro."' WHERE produto.ProdutoID = '".$_SESSION["Value_Produto"]."';";
					} else {
						echo "<script>alert('Houve um problema no upload da imagem')</script>";
					}
				
				}
				
				
				$edit = $conn->query($sql);
				
				unset($_SESSION["Value_Produto"]);
				unset($_SESSION["Action_Produto"]);
				
				header("Location: redirect.php");
			}
			
			}
		}
		
		require_once "connectdb.php";
		
		if ($conn->connect_errno) {
			$code = $conn->connect_errno;
			$message = $conn->connect_error;
		} else {
		
		if (isset($_SESSION["Action_Produto"])) {
			$sql = "select * from produto where ProdutoID = '".$_SESSION["Value_Produto"]."'";
			$search = $conn->query($sql);
			
			if ($sql) {
				if($search->num_rows == 1) { 
					$row = $search->fetch_assoc();
					
					
					$EditarPreco = $row['Preco'];
					$EditarNome = $row['Nome'];
					
				}
			} else {
				$code = $sql->errno;
				$message = $sql->error;
				printf("<p>Query error: %d %s</p>", $code, $message);
		}

    
    $search->close();
			
			
			if ($_SESSION["Action_Produto"] == "Delete") {
				?>
				<script type="text/javascript">
					$(window).on('load',function(){
						$('#ModalDelete').modal('show');
					});
				</script>
				<?php
			} elseif ($_SESSION["Action_Produto"] == "Edit") {
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
				<div>Consumiveis</div>
				
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
				<button type="button" class="btn btn-primary" style="margin-bottom:15px" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Adicionar</button>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				
				
				
				<div class="modal-body">
				
				<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Descricao</label>
				<input type="text" class="form-control" id="recipient-descr" required name="recipient-descr">
				</div>
				
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Nome:</label>
				<input type="text" class="form-control" id="recipient-nome" required name="recipient-nome">
				</div>

				<div class="form-group">
				<label for="recipient-preco" class="col-form-label">Preco:</label>
				<input type="text" class="form-control" id="recipient-preco" required name="recipient-preco">
				</div>
				
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Imagem:</label><br>
					<input type="file" class="" id="recipient-img" name="recipient-img">
				</div>
				
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" name="add_item">Adicionar</button>
				</form>
				</div>
				</div>
				</div>
				</div>
				
					<table id="mydatatable" class="table table-bordered mydatatable" style="width:100%">
						<thead>
							<tr>
								<th>Descricao</th>
								<th>Nome</th>
								<th>Preco</th>
								<th>Foto</th>
								<th>Ações</th>
								
							</tr>
						</thead>
						
						<tbody>
							 <?php foreach ($produtos as $um_produtos) {?>
								<tr>
								<td scope="row"><?= htmlspecialchars($um_produtos['descricao']) ?></td>
								<td><?= htmlspecialchars($um_produtos['nome']) ?></td>
								<td><?= htmlspecialchars($um_produtos['preco']) ?></td>
								<td><img src=<?=$um_produtos['foto'] ?> alt="produto" style="width:64px"></td>
								<td>
									<a href="edit_produto.php?Valor=<?php echo htmlspecialchars($um_produtos['produtoid']); ?>" class="option_edit" style="text-decoration:none;color:inherit"><svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
									</svg></a>
									
									<a href="delete_produto.php?Valor=<?php echo htmlspecialchars($um_produtos['produtoid']); ?>" class="" style="text-decoration:none;color:inherit"><svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
									<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
									</svg></a>
									
									<!--data-toggle="modal" data-target="#ModalDelete"-->

<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" value="25">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja apagar o produto <?php echo $_SESSION["Value_Produto"]?>?</h5>
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
        <h5 class="modal-title" id="exampleModalLabel">Deseja editar este Produto?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
	  
		<label for="">Nome</label>
		<input type="text" class="form-control" name="edit_nome" id="edit_nome" value="<?php echo $EditarNome?>">
		<label>Preco</label>
		<input type="text" class="form-control" name="edit_preco" id="edit_preco" value="<?php echo $EditarPreco?>">
		<label for="" >Imagem:</label><br>
		<input type="file" class="" id="recipient-img" name="recipient-img">
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
			$('#mydatatable').DataTable();
		} );
		
		$( "#left_sidebar_button" ).click(function() {
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
