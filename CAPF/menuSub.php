<!--<h1>Menu Para ADM</h1>-->
<script src="../../node_modules/jquery/dist/jquery.js"></script>
<link href="../../estilos/menu2.css" type="text/css" rel="stylesheet">
<section class="sectionMenu">
        <div class="body">
            <div class="img-logo">
                <a href="../../menu.php">
                    <img src="../../imagens/cropped-icone-site.png"/>
                </a>
            </div>
            <div class="nav">
                <ul>
                    <?php if($_SESSION['tipo'] == 1): ?>
                        <li class="drop"><a href="#">Manutenções</a>
                            <ul class="dropdown">
                                <li><a href="../regiaoBrasil/viewRegiaoBrasil.php">Regiões do Brasil</a></li>
                                <li><a href="../estado/viewEstado.php">Estados</a></li>
                                <li><a href="../cidade/viewCidade.php">Cidades</a></li>
                                <li><a href="../bairro/viewBairro.php">Bairros</a></li>
                                <li><a href="../regiaoFranquia/viewregiaoFranquia.php">Regiões de Franquia</a></li>
                                <li><a href="../userMasterFranqueado/viewUserMasterFranqueado.php"> Usuários Master Franqueados</a></li>
                                <li><a href="../masterFranquia/viewMasterFranqueado.php"> Master Franquias</a></li>
                                
                            </ul>
                        </li>
                        <li class="drop"><a href="#">Master Franquia</a>
                            <ul class="dropdown">
                                <li><a href="../categoriaKpi/viewCategoriaKpi.php">Categorias de Kpi's</a></li>
                                <li><a href="../kpis/viewKpi.php">Kpi's</a></li>
                                <li><a href="../consolidarKpi/ConsolidarKpi.php">Consolidar Kpi's</a></li>
                                <li><a href="../metas/viewMetas.php">Metas</a></li>
                                <li><a href="../AvaliarMetas/viewAvaliarMetas.php">Avaliar Metas franquia</a></li>     
                                <li><a href="../usuariosFranqueados/viewUsuariosFranqueados.php">Usuários Franqueados</a></li>
                                <li><a href="../franquias/viewFranquias.php">Franquias</a></li>
                            </ul>
                        </li>
                        <li class="drop"><a href="#">Franquia</a>
                            <ul class="dropdown">
                                <li><a href="../registrarKpi/viewRegistrarKpi.php">Registrar kpi's</a></li>
                                <li><a href="../enviarKpi/EnviarKpi.php">Enviar Kpi's</a></li>
                            </ul>
                        </li>

                    <?php elseif ($_SESSION['tipo'] == 2): ?>
                        <li class="drop"><a href="#">Master Franquia</a>
                            <ul class="dropdown">
                                <li><a href="../categoriaKpi/viewCategoriaKpi.php">Categorias de Kpi's</a></li>
                                <li><a href="../kpis/viewKpi.php">Kpi's</a></li>
                                <li><a href="../metas/viewMetas.php">Metas</a></li>
                                <li><a href="../consolidarKpi/ConsolidarKpi.php">Consolidar Kpi's</a></li>
                                <li><a href="../AvaliarMetas/viewAvaliarMetas.php">Avaliar Metas franquia</a></li>                 
                                <li><a href="../usuariosFranqueados/viewUsuariosFranqueados.php">Usuários Franqueados</a></li>
                                <li><a href="../franquias/viewFranquias.php">Franquias</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="drop"><a href="#">Franquia</a>
                            <ul class="dropdown">
                                <li><a href="../registrarKpi/viewRegistrarKpi.php">Registrar kpi's</a></li>
                                <li><a href="../enviarKpi/EnviarKpi.php">Enviar Kpi's</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    
                    <li class="drop"><a href="#">Painel de Usuário</a>
                        <ul class="dropdown">
                            <li><a href="../perfil/viewPerfil.php">Perfil</a></li>
                            <li><a href='../../logout.php'>Logout</a></li>
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