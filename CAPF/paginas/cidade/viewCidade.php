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
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões do Brasil</title>
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
                    Cidades
                </span>
            </div> 
            <div class="conteudo">
                <!-- Titulo da sessão -->
                <div class="title-section">
                    <span class="sub-title">
                        Lista de <span>cidades</span> do Brasil
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Região</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {	
                                $aux1=$res['Estado_id_estado1'];//tabela 'cidade' campo 'Estado_id_estado1'
                                $result2 = mysqli_query($mysqli, "SELECT * FROM estado WHERE id_estado=$aux1 ORDER BY nome");
                                
                                $res2 = mysqli_fetch_array($result2);//tabela 'estado' cidade.Estado_id_estado1 = estado.id_estado 
                                $aux2=$res2['RegiaoBrasil_id_RegiaoBrasil1'];//tabela 'estado' campo 'RegiaoBrasil_id_RegiaoBrasil1'

                                $result3 = mysqli_query($mysqli, "SELECT * FROM regiaobrasil WHERE id_RegiaoBrasil=$aux2 ORDER BY nome");
                                $res3 = mysqli_fetch_array($result3);//tabela 'regiaobrasil' 
                                

                                echo "<tr>";
                                echo "<td>".$res3['nome']."</td>";//região
                                echo "<td>".$res2['nome']."</td>";//estado
                                echo "<td>".$res['nome']."</td>";//cidade
                                echo "<td><a href=\"editCidade.php?id=$res[id_cidade]&&nome1=$res[nome]\">Edit</a></td>";
                                echo "<td><a href=\"delCidade.php?id=$res[id_cidade]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href="./addCidade.php">
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