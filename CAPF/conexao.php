<?php
$usuario = 'root';
$senha = '';
$database = 'capf';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
	die("Falha ao concectar ao banco de dados : " . $mysqli->error);
}

