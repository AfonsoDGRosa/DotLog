<?php
session_start();

$sent = array_key_exists("sent", $_GET) ? $_GET["sent"] : "";

if ($sent == true) {
	echo "<script>alert('Mensagem publicada com sucesso!')</script>";
	header("Location: forum.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forum - DotLog</title>
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
	?>

	<div class="container before_navbar forum_dotlog">
		<h2>Forum DotLog</h2>
		<p>Seja bem vindo ao forum do DotLog<br>
		Caso tenha algum problema ou dúvida, publique aqui em baixo no forum.</p>
		<br>
		<br>
		<a href="forum_submit.php" class="btn btn-primary float-right">
			<svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
				<path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
			</svg>
		Publicar Um Post
		</a>
		<!--<div class="forum_filters">
			<a class="forum_filters_button">filter1</a>
			<a class="forum_filters_button">filter2</a>
		</div>-->
	</div>
	
	<?php
		require_once "connectdb.php";
		
		if ($conn->connect_error) {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
			die("Erro na ligação da base de dados" . $conn->connect_error);
		}
		
		$query = "SELECT * FROM dotlog.posts_principais";
		
		$result_set = $conn->query($query);
		
		if ($result_set) {
			if ($result_set->num_rows > 0) {
				$cont = 0;
				
				?>
				<div class="container forum_post_container">
				<?php
				
				while($row = $result_set->fetch_assoc()) {
					$cont += 1;
					
					
					?>
					
						<div class="container forum_post">
							<img src="images/sign_in.png">
							<a style="text-decoration:none" href="forum_post.php?postID=<?php echo htmlspecialchars($row['PostID']); ?>"><h2 style="font-weight:450;color:black;"><?=$row['Assunto']?></h2></a>
							<p class="forum_message"><?=$row['Mensagem']?></</p>
							
							<div class="post_more_info">
								<p><?=$row['Nome']." ".$row['Apelido']." | Postado em ".$row['DataHora']?></p>
							</div>
						</div>
						
						<div class="container" style="background-color:white;height:2px">
							<hr class="white mb-4 mt-0 d-inline-block mx-auto" style="width: 100%;border-top: 1px solid color:rgb(100,100,100))">
						</div>
					<?php
					
				}
				?></div><?php
			}
			
		} else {
			$code = $conn->connect_errno;
			$message = $conn->connect_errno;
		}
	?>
	

	<br>
	
  
  <?php
	require_once "footer.php";
  ?>
  
</body>

</html>