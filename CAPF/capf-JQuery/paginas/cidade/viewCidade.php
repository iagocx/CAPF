<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM cidade ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link href="../../estilos/menu.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
            <!-- Titulo da sessão -->
            <div class="title-section">
                <span class="sub-title">
                    Lista de <span>cidades</span> do Brasil
                </span>
            </div>
            <div class="tb-scrol">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php
                        while($res = mysqli_fetch_array($result)) {	
                            echo "<tr>";
                            echo "<td>".$res['id_cidade']."</td>";
                            echo "<td>".$res['nome']."</td>";
                            echo "<td><a href=\"editCidade.php?id=$res[id_cidade]\">Edit</a></td>";
                            echo "<td><a href=\"delCidade.php?id=$res[id_cidade]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                            echo "</tr>";
                        }
                    ?>   
                </table>
            </div>
            <a href="./addCidade.php">
                <button class="btn-clean btn-submit" type="submit">Incluir</button>
            </a>
            <a href='../../menu.php'>
                <button class="btn-clean btn-submit" type="submit">Voltar</button>
            </a>
            </div>  
    </section>
</body>
</html>