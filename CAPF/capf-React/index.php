<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) { // isset Verifica se uma variável está definida 
	if(strlen($_POST['email']) == 0) {
		echo "Por favor preencha seu e-mail";
	} else 
		if(strlen($_POST['senha']) == 0) {
			echo "Por favor preencha sua senha";
		} else { 
			$email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['senha']);
			$sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL : " . $mysqli->error);

			$quantidade = $sql_query->num_rows;
			if($quantidade == 1) {
				$usuario = $sql_query->fetch_assoc();
				if(!isset($_SESSION)) {
					session_start();
				}
				$_SESSION['id'] = $usuario['id'];
				$_SESSION['nome'] = $usuario['nome'];

				header("Location: painel.php");

			} else {
				echo "Falha ao logar! E-mail ou senha invalidos";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
		<title>Login</title>
        <link rel="stylesheet" href="src/index.css">
    </head>
    <body class="body">
        
        <div id="root"></div>
        <script type="module" src="src/index.jsx" ></script>
    </body>
</html>