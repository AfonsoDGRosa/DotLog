<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
<<<<<<< HEAD
          <a class="nav-link" href="sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="contactos.php">Contactos</a>
=======
          <a class="nav-link" href="sobre.html">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="contactos.html">Contactos</a>
>>>>>>> master
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
            <a class="dropdown-item opcao" href="#">Consumiveis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link opcao" href="servicos.php">Serviços</a>
        </li>



        <?php
        if (isset($_SESSION['userpname'])) {
          echo '<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="images/sign_in.png" class="signin" style="width: 25px">
				</a>
				<div class="dropdown-menu dropdown-menu-right text-muted" aria-labelledby="navbarDropdown">
				<p style="justify-content:normal;color:rgb(54, 54, 54);padding:.25rem 1.5rem;margin-bottom:0px">
				' . $_SESSION["userpname"]," ",$_SESSION["useraname"] . '    
				<div style="margin-bottom:0px;margin-top:0px" class="dropdown-divider"></div>
				<a class="dropdown-item opcao" href="profile.php">Perfil</a>
				<a class="dropdown-item opcao" href="backoffice.php">BackOffice</a>
				</p>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item opcao" href="logout.php">Sign Out</a>
				</li>';
        } else {
<<<<<<< HEAD
          echo '<li class="nav-item dropdown"><a class="nav-link opcao"  href="login.php">Login</a></li>';
=======
          echo '<a class="dropdown-item"  href="login.php">Login</a>
    <a class="dropdown-item opcao"  href="signup.php">Criar Conta</a>';
>>>>>>> master
        }

        ?>


      </ul>
    </form>
  </div>
</nav>
