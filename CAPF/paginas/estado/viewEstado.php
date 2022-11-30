<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM estado ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Estados</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
            <div class="title-section2">
                <span class="sub-title2">
                    Estados
                </span>
            </div> 
            <div class="conteudo">
                <!-- Titulo da sessão -->
                <div class="title-section">
                    <span class="sub-title">
                        Lista de <span>Estados</span> do Brasil:
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Região</th>
                            <!--<th>Id</th>-->
                            <th>Nome do Estado</th>
                            <th>Sigla</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {
                                $res3=$res['RegiaoBrasil_id_RegiaoBrasil1'];
                                $result2 = mysqli_query($mysqli, "SELECT * FROM regiaobrasil WHERE id_RegiaoBrasil=$res3 ORDER BY nome");
                                $res2 = mysqli_fetch_array($result2);
                                echo "<tr>";
                                echo "<td>".$res2['nome']."</td>";
                                //echo "<td>".$res['id_estado']."</td>";
                                echo "<td>".$res['nome']."</td>";
                                echo "<td>".$res['sigla']."</td>";
                        
                                echo "<td><a href=\"editEstado.php?id=$res[id_estado]&&nome1=$res[nome]\">Edit</a></td>";
                                echo "<td><a href=\"delEstado.php?id=$res[id_estado]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href="./addEstado.php">
                        <button class="btn-clean btn-submit" type="submit">Incluir</button>
                    </a>
                    <a href='../../menu.php'>
                        <button class="btn-clean btn-submit" type="submit">Voltar</button>
                    </a>
                </div> 
            </div>
        </content> 
    </section>
</body>
</html>