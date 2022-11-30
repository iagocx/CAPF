<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM bairro ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Bairros do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="title-section2">
            <span class="sub-title2">
                Bairros
            </span>
        </div> 
        <div class="conteudo">
            
            <!-- Titulo da sessão -->
            <div class="title-section">
                <span class="sub-title">
                    Lista de <span>bairros</span> do Brasil:
                </span>
            </div>
            <div class="tb-scrol">
                <table>
                    <tr>
                        <th>Região</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Nome do Bairro</th>
                        <th>Região Master Franquia</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php
                        while($res = mysqli_fetch_array($result)) {
                            $aux=$res['Cidade_id_cidade1'];

                            $result1 = mysqli_query($mysqli, "SELECT * FROM cidade WHERE id_cidade=$aux ORDER BY nome");
                            $res1 = mysqli_fetch_array($result1);
                            $aux1=$res1['Estado_id_estado1'];//tabela 'cidade' campo 'Estado_id_estado1'
                            
                            $result2 = mysqli_query($mysqli, "SELECT * FROM estado WHERE id_estado=$aux1 ORDER BY nome");
                            $res2 = mysqli_fetch_array($result2);//tabela 'estado' cidade.Estado_id_estado1 = estado.id_estado 
                            $aux2=$res2['RegiaoBrasil_id_RegiaoBrasil1'];//tabela 'estado' campo 'RegiaoBrasil_id_RegiaoBrasil1'

                            $result3 = mysqli_query($mysqli, "SELECT * FROM regiaobrasil WHERE id_RegiaoBrasil=$aux2 ORDER BY nome");
                            $res3 = mysqli_fetch_array($result3);//tabela 'regiaobrasil' 
                            
                            $aux3 = $res['RegiaoFranquia_id_RegiaoFranquiacol'];
                            $result4 = mysqli_query($mysqli, "SELECT * FROM regiaofranquia WHERE id_RegiaoFranquiacol=$aux3 ORDER BY nome");
                            $res4 = mysqli_fetch_array($result4);//tabela 'regiaofranquia' 

                            echo "<tr>";
                            echo "<td>".$res3['nome']."</td>";//região
                            echo "<td>".$res2['nome']."</td>";//estado
                            echo "<td>".$res1['nome']."</td>";//cidade
                            echo "<td>".$res['nome']."</td>";//bairro
                            echo "<td>".$res4['nome']."</td>";//região master franquia
                            echo "<td><a href=\"editBairro.php?id=$res[id_bairro]&&nom=$res[nome]\">Edit</a></td>";
                            echo "<td><a href=\"delBairro.php?id=$res[id_bairro]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                            echo "</tr>";
                        }
                    ?>   
                </table>
            </div>
            <div class="btn-sv">
                <a href="./addBairro.php">
                    <button class="btn-clean btn-submit" type="submit">Incluir</button>
                </a>
                <a href='../../menu.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
            </div>  
    </section>
</body>
</html>