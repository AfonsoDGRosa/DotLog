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
	$stmt = "SELECT * FROM produto WHERE CategoriaID =1";
	
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
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			require_once "connectdb.php";
			
			if ($conn->connect_errno) {
				$code = $conn->connect_errno;
				$message = $conn->connect_error;
			} else {
			if (isset($_POST['add_item'])){
				$sql = "insert into produto values(null,'".$_POST["recipient-nome"]."',".$_POST["recipient-img"].",".$_POST["recipient-descr"]."',".$_POST["recipient-preco"].",1, 1)";
				$add = $conn->query($sql);
				
				header("Location: redirect.php");
			} elseif (isset($_POST['delete_item'])) {
				$sql = "delete from produto WHERE ProdutoID='".$_SESSION["Value_Hardware"]."';";
				$delete = $conn->query($sql);
				unset($_SESSION["Value_Hardware"]);
				unset($_SESSION["Action_Hardware"]);
				
				header("Location: redirect.php");
			} elseif (isset($_POST['edit_item'])) {
				$sql = "UPDATE produto SET Nome = '".$_POST["edit_nome"]."', Preco = '".$_POST["edit_preco"]."' WHERE produto.ProdutoID = '".$_SESSION["Value_Hardware"]."';";
				$edit = $conn->query($sql);
				
				unset($_SESSION["Value_Hardware"]);
				unset($_SESSION["Action_Hardware"]);
				
				header("Location: redirect.php");
			}
			
			}
		}
		
		require_once "connectdb.php";
		
		if ($conn->connect_errno) {
			$code = $conn->connect_errno;
			$message = $conn->connect_error;
		} else {
		
		if (isset($_SESSION["Action_Hardware"])) {
			$sql = "select * from produto where ProdutoID = '".$_SESSION["Value_Hardware"]."'";
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
			
			
			if ($_SESSION["Action_Hardware"] == "Delete") {
				?>
				<script type="text/javascript">
					$(window).on('load',function(){
						$('#ModalDelete').modal('show');
					});
				</script>
				<?php
			} elseif ($_SESSION["Action_Hardware"] == "Edit") {
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
	
		<div class="mainsidebar dark_background">
			
		<div class="sidebar-heading sidebar_padding dark_background">
			DotLog BackOffice
		</div>
		
		<div class="list-group list-group-flush">
			
				<a href="backoffice.php" class="list-group-item list-group-item-action dark_background">Dashboard</a>
				<a href="admin_utilizadores" class="list-group-item list-group-item-action dark_background">Utilizadores</a>
<div id="accordion">
  <div class="card" style="background-color:rgb(51,51,51); padding:.75rem 1.25rem">
    
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding:0px;color:white;text-decoration:none">
          Produtos
        </button>
      </h5>
    

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="padding:0px">
        <a href="admin_utilizadores" class="list-group-item list-group-item-action dark_background">Hardware</a> 
		<a href="#" class="list-group-item list-group-item-action dark_background">Software</a>
		<a href="#" class="list-group-item list-group-item-action dark_background">Consumiveis</a>
      </div>
    </div>
  </div>
  </div>
				
				
				<a href="#" class="list-group-item list-group-item-action dark_background">Serviços Agendados</a>
			
		</div>
		
		</div>
		
		<div style="min-height:100vh">
			
		
			
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
				
				<form action="" method="post">
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Descricao</label>
				<input type="text" class="form-control" id="recipient-descr" name="recipient-descr">
				</div>
				
				<div class="form-group">
				<label for="recipient-name" class="col-form-label">Nome:</label>
				<input type="text" class="form-control" id="recipient-nome" name="recipient-nome">
				</div>

				<div class="form-group">
				<label for="recipient-preco" class="col-form-label">Preco:</label>
				<input type="text" class="form-control" id="recipient-preco" name="recipient-preco">
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
							 <?php foreach ($produtos as $um_produtos) { ?>
								<tr>
								<td scope="row"><?= htmlspecialchars($um_produtos['descricao']) ?></td>
								<td><?= htmlspecialchars($um_produtos['nome']) ?></td>
								<td><?= htmlspecialchars($um_produtos['preco']) ?></td>
								<td><img class="row_image" src="images/sign_in.png" alt="foto"></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Deseja apagar o produto <?php echo $_SESSION["Value_Hardware"]?>?</h5>
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
	  <form action="" method="post">
      <div class="modal-body">
	  
		<label for="">Nome</label>
		<input type="text" class="form-control" name="edit_nome" id="edit_nome" value="<?php echo $EditarNome?>">
		<label>Preco</label>
		<input type="text" class="form-control" name="edit_preco" id="edit_preco" value="<?php echo $EditarPreco?>">
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
		
		function inserir(){
			var nome = prompt("nome?","a");
			
		}
		
		$(".option_delete" ).click(function() {
			if (confirm("Deseja apagar este produto?")){
				alert("Produto apagado com sucesso!");
			};
		});
		
		
		var table = $('#mydatatable').DataTable();
 
		$('#mydatatable tbody').on( 'click', 'tr', function () {
			
			console.log( table.row( this ).data() );
			$('#mydatatable tbody').removeClass('select')
			$(this).addClass('select')
		} );
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
