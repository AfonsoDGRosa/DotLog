<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
    header('Location: login.php');
    exit(0);
}


$utilizadores = array();
$pesquisa = array_key_exists("pesquisa", $_GET) ? $_GET["pesquisa"] : "";

require_once "connectdb.php";

if ($conn->connect_errno) {
    $code = $conn->connect_errno;
    $message = $conn->connect_error;
    $msg_erro = "Falha na ligação a base de dados";
} else {
    //$stmt = $conn->prepare("SELECT * FROM utilizador");
    //$stmt = $conn->prepare("SELECT * FROM utilizador");
	$stmt = "SELECT * FROM utilizador";
	
    $criterio = "%$pesquisa%";
    //$stmt->bind_param('s', $criterio);

    //$result = $stmt->execute();
	$result = $conn->query($stmt);
    if ($result) {
        //$stmt->bind_result($UtilizadorID,$primeiro_nome,$apelido,$perfil,$email,$pass,$foto);

        while ($row = $result->fetch_assoc()) {
            $nome = htmlspecialchars($row['PrimeiroNome']);
            $email = htmlspecialchars($row['Email']);
            $foto = htmlspecialchars($row['Imagem']);
            $utilizador = array('nome' => $nome, 'email' => $email, 'foto' => $foto,);
            $utilizadores[] = $utilizador;
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
    <title>List User</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/simple.css">
	<link rel="stylesheet" type="text/css" href="css/inicial.css">
	
    <style>
        .row_image {
            width: 64px;
            height: 64px;
            object-fit: scale-down;
        }
    </style>
</head>

<body>
	<script src="scripts/jquery-3.4.1.js"></script>
	<script src="scripts/js/bootstrap.min.js"></script>
	<script src="scripts/js/bootstrap.bundle.min.js"></script>

	
	<?php
		require_once "navbar.php";
	?>
	
    <h2 class="before_navbar" style="padding-top:25px">Listagem De Utilizadores</h2>
	
    <form action="listuser.php">
        <!--<label>Pesquisa: <input type="text" id="myInput" name="pesquisa" value="<?= ($pesquisa); ?>"></label>
        <input type="submit" value="Procurar">-->
    </form>
	
	<br>
	
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Nome</th>
                <th scope="col">Foto</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php foreach ($utilizadores as $um_utilizador) { ?>
                <tr>
                    <td scope="row"><?= htmlspecialchars($um_utilizador['email']) ?></td>
                    <td><?= htmlspecialchars($um_utilizador['nome']) ?></td>
					
                    <td><img class="row_image" src="images/sign_in.png" alt="foto"></td>
				
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>