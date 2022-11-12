<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
	<link href="estilos/pagina1.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>CAPF Menu</title>
</head> 
<body>
    <h1>Menu Para ADM</h1>
    <nav class="nav">
        <ul>
            <li class="drop"><a href="#">Start</a>
                <ul class="dropdown">
                    <li><a href="#">Oferta 01</a></li>
                    <li><a href="#">Oferta 02</a></li>
                    <li><a href="#">Oferta 03</a></li>
                </ul>
            <li class="drop"><a href="#">O nas</a>
                <ul class="dropdown">
                    <li><a href="#">Oferta 01</a></li>
                    <li><a href="#">Oferta 02</a></li>
                    <li><a href="#">Oferta 03</a></li>
                </ul>
            <li class="drop"><a href="#">Oferta</a>
                <ul class="dropdown">
                    <li><a href="#">Oferta 01</a></li>
                    <li><a href="#">Oferta 02</a></li>
                    <li><a href="#">Oferta 03</a></li>
                </ul>
            </li>
            <li><a href="#">alguma coisa</a>
            <li class="drop"><a href="#">Painel de Usuário</a>
                <ul class="dropdown">
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Adicionar Usuários</a></li>
                </ul>
        </ul>
    </nav>

    <footer>
        <p class="main">
            2017 |  |</a>
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