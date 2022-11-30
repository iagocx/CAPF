<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <link href="./estilos/menu2.css" type="text/css" rel="stylesheet">
    <link href="./estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>CAPF Menu</title>
</head> 
<body>
    <!--<h1>Menu Para ADM</h1>-->

    <section class="sectionMenu">
        <div class="body">
            <div class="img-logo">
                <a href="./menu.php">
                    <img src="./imagens/cropped-icone-site.png"/>
                </a>
            </div>
            <div class="nav">
                <ul>
                    <?php if($_SESSION['tipo'] == 1): ?>
                        <li class="drop"><a href="#">Manutenções</a>
                            <ul class="dropdown">
                                <li><a href="./paginas/regiaoBrasil/viewRegiaoBrasil.php">Regiões do Brasil</a></li>
                                <li><a href="./paginas/viewEstado.php">Estados</a></li>
                                <li><a href="./paginas/viewCidade.php">Cidades</a></li>
                                <li><a href="./paginas/viewBairro.php">Bairros</a></li>
                                <li><a href="./paginas/viewregiaoFranquia.php">Regiões de Franquia</a></li>
                                <li><a href="./paginas/userMasterFranqueado/viewUserMasterFranqueado.php"> Usuários Master Franqueados</a></li>
                                <li><a href="./paginas/masterFranquia/viewMasterFranqueado.php"> Master Franquias</a></li>
                                
                            </ul>
                        </li>
                        <li class="drop"><a href="#">Master Franquia</a>
                            <ul class="dropdown">
                                <li><a href="./paginas/categoriaKpi/viewCategoriaKpi.php">Categorias de Kpi's</a></li>
                                <li><a href="./paginas/kpis/viewKpi.php">Kpi's</a></li>
                                <li><a href="./paginas/consolidarKpi/ConsolidarKpi.php">Consolidar Kpi's</a></li>
                                <li><a href="./paginas/metas/viewMetas.php">Metas</a></li>
                                <li><a href="./paginas/AvaliarMetas/viewAvaliarMetas.php">Avaliar Metas franquia</a></li>     
                                <li><a href="./paginas/usuariosFranqueados/viewUsuariosFranqueados.php">Usuários Franqueados</a></li>
                                <li><a href="./paginas/franquias/viewFranquias.php">Franquias</a></li>
                            </ul>
                        </li>
                        <li class="drop"><a href="#">Franquia</a>
                            <ul class="dropdown">
                                <li><a href="./paginas/registrarKpi/viewRegistrarKpi.php">Registrar kpi's</a></li>
                                <li><a href="./paginas/enviarKpi/EnviarKpi.php">Enviar Kpi's</a></li>
                            </ul>
                        </li>

                    <?php elseif ($_SESSION['tipo'] == 2): ?>
                        <li class="drop"><a href="#">Master Franquia</a>
                            <ul class="dropdown">
                                <li><a href="./paginas/categoriaKpi/viewCategoriaKpi.php">Categorias de Kpi's</a></li>
                                <li><a href="./paginas/kpis/viewKpi.php">Kpi's</a></li>
                                <li><a href="./paginas/consolidarKpi/ConsolidarKpi.php">Consolidar Kpi's</a></li>
                                <li><a href="./paginas/metas/viewMetas.php">Metas</a></li>
                                <li><a href="./paginas/AvaliarMetas/viewAvaliarMetas.php">Avaliar Metas franquia</a></li>
                                <li><a href="./paginas/franquias/viewFranquias.php">Franquias</a></li>
                                <li><a href="./paginas/usuariosFranqueados/viewUsuariosFranqueados.php">Usuários Franqueados</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="drop"><a href="#">Franquia</a>
                            <ul class="dropdown">
                                <li><a href="./paginas/registrarKpi/viewRegistrarKpi.php">Registrar kpi's</a></li>
                                <li><a href="./paginas/enviarKpi/EnviarKpi.php">Enviar Kpi's</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <li class="drop"><a href="#">Painel de Usuário</a>
                        <ul class="dropdown">
                            <li><a href="./paginas/perfil/viewPerfil.php">Perfil</a></li>
                            <li><a href='./logout.php'>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <br><br><h1 class="h1">Bem vindo <?php echo $_SESSION['nome'] ?></h1>
            </div>
        </div>
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
    </section>
    <section class="section0002">
        <div class="img-002">
            

        </div>
    </section>
</body>
</html>