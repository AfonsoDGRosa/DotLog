<?php
	session_start();
	
	$postID = array_key_exists("postID", $_GET) ? $_GET["postID"] : "";
	
	//$postID = array_key_exists("postID", $_POST) ? $_POST["postID"] : "";
	
	$mensagem = "";
	
	if (isset($_POST['post_comment'])) {
		require_once "connectdb.php";
		
		$post_message = "";
		$post_assunto = "Resposta";
		$utilizador_id = null;
		
		if ($conn->connect_errno) {
			$code = $conn->connect_errno;
			$message = $conn->connect_error;
			echo "<script>alert('Falha na ligação a base de dados')</script>";
		} else {
		
			$post_message = $_POST["post_message"];
			//$post_assunto = $_POST['post_assunto'];
			$utilizador_id = $_SESSION['utilizador_id'];
			
			if (empty($post_message) || strlen($post_message) > 255) {
				echo "<script>alert('Campos não foram preenchidos')</script>";
			} else {
				$post_message = $conn->real_escape_string($post_message);
				
				$query = "insert into mensagem values (null,'".$post_message."',now(),'".$post_assunto."', '".$postID."','".$utilizador_id."');";
				$result = $conn->query($query);
				
				if ($result) {
					header("Location: forum_post.php?postID=$postID");
				} else {
					header("Location: servicos.php");
				}
			}
    
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DotLog</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/simple.css">
  <link rel="stylesheet" type="text/css" href="css/forum.css">

</head>

<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
  <!--<script src="scripts/simple.js"></script>-->
	<?php
	require_once "navbar.php";
	
	require_once "connectdb.php";
	
    if ($conn->connect_errno) {
        $code = $conn->connect_errno;
        $message = $conn->connect_error;
        echo "<script>alert('Falha na ligação a base de dados')</script>";
    } else {
		
        $query = "select * from mensagem join utilizador on mensagem.UtilizadorID = utilizador.UtilizadorID where PostID = '$postID'";
		
        $result_set = $conn->query($query);
		
        if ($result_set) {
			
			if($result_set->num_rows == 1) {
				
				$row = $result_set->fetch_assoc();
				
			?>
			<div class="container before_navbar forum_dotlog_post">
				<h2 class="post_assunto"><?=$row['Assunto']?></h2>
				<p><?="Postado em ",$row['DataHora']?></p>
				
				<div class="container" style="background-color:white;height:2px;padding-bottom:15px">
					<hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 100%;border-top: 1px solid color:rgb(100,100,100))">
				</div>
				
				<img src="images/sign_in.png">
				<h3><?=$row['PrimeiroNome']," ",$row['Apelido']," | ",$row['Perfil']?></h3>
				
				<p class="forum_message_post"><?=$row['Mensagem']?></p>
				
			</div>		
			<?php
			}} else {
            $code = $conn->errno;
            $message = $conn->error;
            printf("<p>Query error: %d %s</p>", $code, $message);
        }

        //$result_set->free();
       //$conn->close();
    }
	?>
	
	<div class="container post_commentarios">
	<h2 style="font-size:20px">Comentários</h2>
	
	<div>
		<!--<img src="images/sign_in.png" style="width:64px">-->
		<form method="post">
			<textarea name="post_message" class="textbox_comment" maxlength="255" placeholder="Adicione um comentário" required></textarea>
			
			<button name="post_comment" class="btn btn-primary" style="float:right" type="submit">Publicar</button>
		</form>
	</div>
	
	
	
	<?php
	
	//require_once "connectdb.php";
	
	$query_comentarios = "select * from mensagem join utilizador on mensagem.UtilizadorID = utilizador.UtilizadorID where id_mensagem_pai = '$postID' LIMIT 50";
	
	$result_set_comentario = $conn->query($query_comentarios);
	
	//echo "<input class='comment_input' type='text' name='mensagem' id='mensagem' required value=" . $mensagem . "><br>";
	
	
	if ($result_set_comentario) {
			if ($result_set_comentario->num_rows > 0) {
				$cont = 0;
				
				?><div class="forum_comment_div"><?php
				
				while($row = $result_set_comentario->fetch_assoc()) {
					$cont += 1;
					
					?>
					<div class="container forum_post forum_comment" style="border-bottom: 1px solid color:rgb(100,100,100)">
						<img src="images/sign_in.png">
						<h2><?=$row['PrimeiroNome']," ",$row['Apelido']," | ",$row['Perfil']?></h2>
						<p class="forum_message_post"><?=$row['Mensagem']?></p>
						
						<div class="post_more_info" style="padding-top:5px">
							<p><?="Postado em ",$row['DataHora']?></p>
						</div>
					</div>
					
					<?php
					
				}
				
			}
			
		} else {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
		}
		
		$result_set->free();
		$conn->close();
	?>
	
	</div>
	<br>
	</div>
  
  <?php
	require_once "footer.php";
  ?>
  
</body>

</html>