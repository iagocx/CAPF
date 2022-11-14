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
            include("conexao.php");					
            
        }
	?>
    
        <!--<h1>Menu Para ADM</h1>-->
        <nav class="nav">
            <ul>
                <?php if ($_SESSION['tipo'] == 1): ?>
                    <li class="drop"><a href="#">Manutenções</a>
                        <ul class="dropdown">
                            <li><a href="./paginas/regiaoBrasil/viewRegiaoBrasil.php">Regiões do Brasil</a></li>
                            <li><a href="./paginas/estado/viewEstado.php">Estado</a></li>
                            <li><a href="./paginas/cidade/viewCidade.php">Cidades</a></li>
                            <li><a href="./paginas/bairro/viewBairro.php">Bairros</a></li>
                            <li><a href="./paginas/regiaoFranquia/viewregiaoFranquia.php">Regiões de Franquia</a></li>
                            <li><a href="./paginas/userMasterFranqueado/viewMasterFranqueado.php">Master Franqueados</a></li>
                        </ul>
                    </li>
                    <li class="drop"><a href="#">Master Franquia</a>
                        <ul class="dropdown">
                            <li><a href="#">Categorias de Kpi's</a></li>
                            <li><a href="#">Kpi's</a></li>
                            <li><a href="#">Consolidar Kpi's</a></li>
                            <li><a href="#">Avaliar Metas</a></li>
                            <li><a href="#">Franqueados</a></li>
                        </ul>
                    </li>
                    <li class="drop"><a href="#">Franquia</a>
                        <ul class="dropdown">
                            <li><a href="#">Registrar kpi's</a></li>
                            <li><a href="#">Enviar Kpi's</a></li>
                        </ul>
                    </li>

                <?php elseif ($_SESSION['tipo'] == 2): ?>
                    <li class="drop"><a href="#">Master Franquia</a>
                        <ul class="dropdown">
                            <li><a href="#">Categorias de Kpi's</a></li>
                            <li><a href="#">Kpi's</a></li>
                            <li><a href="#">Consolidar Kpi's</a></li>
                            <li><a href="#">Avaliar Metas</a></li>
                            <li><a href="#">Franqueados</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="drop"><a href="#">Franquia</a>
                        <ul class="dropdown">
                            <li><a href="#">Registrar kpi's</a></li>
                            <li><a href="#">Enviar Kpi's</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <li class="drop"><a href="#">Painel de Usuário</a>
                    <ul class="dropdown">
                        <li><a href="#">Perfil</a></li>
                        <li><a href='logout.php'>Logout</a></li>
                    </ul>
                </li>
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