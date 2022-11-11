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
	<link href="estilos/index.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Login</title>
<head> 

<body>
	<div class="container">
		<div class="container-login">
			<div class="wrap-login">
				<form method="POST" class="login-form">
					<span class="login-form-title">
						Faça o login
					</span> 
					<div class="wrap-input margin-top-35 margin-bottom-35">
						<input class="span1" type="text" name="email" autocomplete="off" onfocus="this.value='';">
					</div> 
					<div class="wrap-input margin-bottom-35">
						<input class="span2" type="password" name="senha" autocomplete="off" onfocus="this.value='';">
					</div>
					<div class="container-login-form-btn">
						<button type="submit" class="login-form-btn">
							Entrar
						</button>
					</div>
				</form>
			</div>
			<img src="./imagens/remax001.jpg" width="300" height="300" class="margin-left-50" />
		</div>
	</div>
</body>
</html>

