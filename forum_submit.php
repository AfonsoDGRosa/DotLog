<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
	header("Location: login.php");
	exit(0);
}

$msg_erro = "";

if (isset($_POST['post-submit'])) {
	require_once "connectdb.php";
	
	$post_message = "";
	$post_assunto = "";
	$utilizador_id = null;
	
	if ($conn->connect_errno) {
		$code = $conn->connect_errno;
		$message = $conn->connect_error;
		$msg_erro = "Falha na ligação a base de dados";
		echo "<script>alert('Falha na ligação a base de dados')</script>";
	} else {
    
	$post_message = $_POST["post_message"];
	$post_assunto = $_POST['post_assunto'];
	$utilizador_id = $_SESSION['utilizador_id'];
	
	if (empty($post_message) || empty($post_assunto) || strlen($post_message) > 255 || strlen($post_assunto) > 100 ) {
        echo "<script>alert('Campos não foram preenchidos')</script>";
    } else {
		$post_message = $conn->real_escape_string($post_message);
		$post_assunto = $conn->real_escape_string($post_assunto);
		
		$query = "insert into mensagem values (null,'".$post_message."',now(),'".$post_assunto."', null,'".$utilizador_id."');";
		$result = $conn->query($query);
		
		if ($result) {
			header("Location: forum.php?sent=true");
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
  <link rel="stylesheet" type="text/css" href="css/submit_post.css">
</head>

<body>
  <script src="scripts/jquery-3.4.1.js"></script>
  <script src="scripts/js/bootstrap.min.js"></script>
  <script src="scripts/js/bootstrap.bundle.min.js"></script>
  
	<?php
		require_once "navbar.php";
	?>
	
	<div class="p-5">
		<div class="container before_navbar submit_box">
			<form method="post">
				<h4 class="mb-4">Submeter um post</h4>
			
				<div class="form-group">
					<input maxlength="100" type="text" class="w-100 texto" name="post_assunto" id="post_assunto" placeholder="Assunto" required>
				</div>
				
				<div class="form-group">
					<textarea runat="server" maxlength="255" class="w-100 texto" name="post_message" id="post_message" placeholder="Texto" required></textarea>
				</div>
				
				<div class="form_buttons">
					<button type="submit" name="post-submit" class="btn btn-primary float-right">Submeter</button>
					<button type="button" class="btn btn-secondary goback float-right">Cancelar</button>
				</div>
				
			</form>
			
		</div>
	</div>
  
	
  
	<script>
		$(".goback" ).click(function() {
			window.location="forum.php";
		});
	</script>
  
</body>

</html>