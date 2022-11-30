<?php
	if(!isset($_SESSION))  {
		session_start();
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">  
	<head> 
		<meta charset="UTF-8">
		<title>Painel</title>
	</head> 
	<body>  
		Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>
	</body>
</html>
