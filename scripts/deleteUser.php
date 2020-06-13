<?php
session_start();

if (!isset($_SESSION["authenticated"])) {
    header('Location: login.php');
    exit(0);
}

$email = array_key_exists("email", $_GET) ? $_GET["email"] : "";

$error_message = "";

require_once "connectdb.php";

if ($conn->connect_errno) {
    $code = $conn->connect_errno;
    $message = $conn->connect_error;
    $error_message = "Falha na ligaçao a base de dados";
} else {
    $query = "DELETE FROM utilizadores WHERE email='$email'";
	$sucesso_query = $conn->query($query);

	if ($sucesso_query) {
		header("Location: listUser.php");
		exit(0);
	} else {
		$code = $conn->errno;
		$message = $conn->error;
		printf("<p>Query error: %d %s</p>", $code, $message);
	}

	$conn->close();
	var_dump($utilizador);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Utilizador</title>
</head>

<body>

	<h2>Removido com sucesso!</h2>

</body>
</html>