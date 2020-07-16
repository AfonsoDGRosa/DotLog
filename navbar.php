<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand" href="index.php"><img src="images/dotlog_logo.png" class="logo" style="width: 200px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


    </ul>

    <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto opcao">
        <li class="nav-item opcao">
          <a class="nav-link" href="sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="contactos.php">Contactos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="forum.php">Forum</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Produtos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item opcao" href="produtos_hardware.php">Hardware</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item opcao" href="produtos_software.php">Software</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item opcao" href="produtos_consumiveis.php">Consumiveis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="servicos.php">Serviços</a>
        </li>



        <?php
        if (isset($_SESSION['userpname'])) {
			
			require_once "connectdb.php";
		
			$user_image = "";
			$user_rank = "";
		
			if ($conn->connect_errno) {
				$code = $conn->connect_errno;
				$message = $conn->connect_error;
			} else {
			
				
					$sql = "select * from utilizador where UtilizadorID = '".$_SESSION['utilizador_id']."'";
					$search = $conn->query($sql);
					
					if ($sql) {
						if($search->num_rows == 1) {
							$row = $search->fetch_assoc();
							
							$user_image = $row['Imagem'];
							$user_rank = $row['Perfil'];
						}
					} else {
						$code = $sql->errno;
						$message = $sql->error;
						printf("<p>Query error: %d %s</p>", $code, $message);
					}

					$search->close();
			
			}
			
			if (empty($user_image)) {
				$user_image = "images/sign_in.png";
			}
			
          echo '<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src='. $user_image .' class="signin" style="width: 25px;border-radius:100px">
				</a>
				<div class="dropdown-menu dropdown-menu-right text-muted" aria-labelledby="navbarDropdown">
				<p style="justify-content:normal;color:rgb(54, 54, 54);padding:.25rem 1.5rem;margin-bottom:0px">
				' . $_SESSION["userpname"]," ",$_SESSION["useraname"] . '    
				<div style="margin-bottom:0px;margin-top:0px" class="dropdown-divider"></div>
				
				<a class="dropdown-item opcao" href="profile.php">Perfil</a>
				';
				if ($user_rank == "Administrador") {
					echo '<a class="dropdown-item opcao" href="backoffice.php">BackOffice</a>';
				}
				echo '</p>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item opcao" href="logout.php">Sign Out</a>
				</li>';
        } else {
          echo '<li class="nav-item dropdown"><a class="nav-link opcao"  href="login.php">Login</a></li>';
        }

        ?>


      </ul>
    </form>
  </div>
</nav>
