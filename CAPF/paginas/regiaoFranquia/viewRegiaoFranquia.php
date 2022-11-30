<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
//$result2 = mysqli_query($mysqli, "SELECT * FROM masterfranquia ORDER BY Franqueado_id_franqueado");

$result = mysqli_query($mysqli, "SELECT * FROM regiaofranquia ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões franquiadas</title>
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
                    Regiões de Franquia
                </span>
            </div> 
            <div class="conteudo">
                <!-- Titulo da sessão -->
                <div class="title-section">
                    <span class="sub-title">
                        Lista das <span>Regiões</span> franquiadas:
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <!--<th>Estados</th>
                            <th>Cidades</th>-->
                            <th>Nome da região</th>
                            <th>Bairros</th>
                            <th>Editar</th>  
                            <th>Excluir</th>        
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {	//tabela regiaofranquia
                                /*
                                $aux = $res['id_RegiaoFranquiacol'];
                                $result1 = mysqli_query($mysqli, "SELECT * FROM masterfranquia WHERE RegiaoFranquia_id_RegiaoFranquiacol='$aux'");
                                $res1 = mysqli_fetch_array($result1);

                                $aux1 = $res1['RegiaoFranquia_id_RegiaoFranquiacol'];
                                $result2 = mysqli_query($mysqli, "SELECT * FROM franqueado WHERE id_franqueado='$aux1'");
                                $res2 = mysqli_fetch_array($result2);
                                */
                                echo "<tr>";
                                echo "<td>".$res['nome']."</td>";
                                echo "<td><a href=\"listaBairro.php?id=$res[id_RegiaoFranquiacol]&&nom=$res[nome]\">Listar Bairros</a></td>";
                            // echo "<td>".$res2['nome_franquia']."</td>";
                                echo "<td><a href=\"editRegiaoFranquia.php?id=$res[id_RegiaoFranquiacol]\">Edit</a></td>";
                                echo "<td><a href=\"delRegiaoFranquia.php?id=$res[id_RegiaoFranquiacol]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href="./addRegiaoFranquia.php">
                        <button class="btn-clean btn-submit" type="submit">Incluir</button>
                    </a>
                    <a href='../../menu.php'>
                        <button class="btn-clean btn-submit" type="submit">Voltar</button>
                    </a>
                </div>  
            </div>
    </section>
</body>
</html>