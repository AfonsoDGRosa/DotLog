<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$database = "dotlog";
$conn = new mysqli($db_host,$db_user,$db_pass,$database);
$conn->set_charset("utf8");
?>