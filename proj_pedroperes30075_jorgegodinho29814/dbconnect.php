<?php
$DBhost = "localhost";
$DBuser = "root";
$DBpass = "12345";
$DBname = "engswproj";

// Orientado a objetos
$DBcon = new MySQLi($DBhost, $DBuser, $DBpass, $DBname);

// Mensagem de erro se houver um erro
if ($DBcon->connect_errno) {
    die("ERRO : -> " . $DBcon->connect_error);
}
?>