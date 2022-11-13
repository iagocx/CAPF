<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
	<link href="./estilos/menu.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>CAPF Menu</title>
</head> 
<body>
    <?php
        if(isset($_SESSION['valid'])) {			
            include("connection.php");					
            $result = mysqli_query($mysqli, "SELECT * FROM login");
        }
	?>
    <!--<h1>Menu Para ADM</h1>-->
    <nav class="nav">
        <ul>
            <li class="drop"><a href="#">Manutenções</a>
                <ul class="dropdown">
                    <li><a href="./regiaoBrasil/viewRegiaoBrasil.php">Regiões do Brasil</a></li>
                    <li><a href="#">Estados</a></li>
                    <li><a href="#">Cidades</a></li>
                    <li><a href="#">Bairros</a></li>
                    <li><a href="#">Regiões de Franquia</a></li>
                    <li><a href="#">Master Franqueados</a></li>
                    <li><a href="#">Franqueados</a></li>
                </ul>
            <li class="drop"><a href="#">Master Franquia</a>
                <ul class="dropdown">
                    <li><a href="#">Categorias de Kpi's</a></li>
                    <li><a href="#">Kpi's</a></li>
                    <li><a href="#">Consolidar Kpi's</a></li>
                    <li><a href="#">Avaliar Metas</a></li>
                </ul>
            <li class="drop"><a href="#">Franquia</a>
                <ul class="dropdown">
                    <li><a href="#">Registrar kpi's</a></li>
                    <li><a href="#">Enviar Kpi's</a></li>
                </ul>
            </li>
            <li class="drop"><a href="#">Painel de Usuário</a>
                <ul class="dropdown">
                    <li><a href="#">Perfil</a></li>
                    <li><a href='logout.php'>Logout</a></li>
                </ul>
        </ul>
        <h1 class="welcome">Bemvindo <?php echo $_SESSION['nome'] ?><h1>
    </nav>

    <footer>
        <p class="main">
            2022 | Sistema CAPF - Controle e Acompanhamento do Processo de Franquias |
        </p>
    </footer>
    <script>    
        $(".drop").mouseover(
            function() {
                $(".dropdown", this).show(500);
        });
        $(".drop")
        .mouseleave(
            function() {
                $(".dropdown", this).hide(300);
        });
    </script>
</body>
</html>