<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

$nome1 = $_GET['nome1'];
$id = $_GET['id'];//MasterFranquia_Franqueado_id_franqueado da tabela kpi

$result = mysqli_query($mysqli, 
"SELECT * FROM franquia
 WHERE MasterFranquia_Franqueado_id_franqueado='$id'");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Lista Franquias associados</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
            <!-- Titulo da sessão -->
            <div class="title-section">
                        <span class="sub-title">Lista de <span>Franquias</span> associados ao KPI:
                            <?php echo "<span>".$nome1."</span>"; ?>     
                        </span>
                    </div>
            <div class="tb-scrol">
                <table>
                    <tr>
                        <th>Nome da franquia</th>
                        <th>Nome do responsável</th>
                        <th>Número</th>
                        <th>Endereço</th>
                        <th>Tel da franquia</th>
                        <th>Tel do responsável</th>
                        <th>CEP</th>  
                    </tr>
                    <?php
                        while($res = mysqli_fetch_array($result)) {//tabela franquia
                            $idf = $res['Franqueado_id_franqueado'];
                            
                            $result1 = mysqli_query($mysqli, 
                            "SELECT * FROM franqueado
                            WHERE id_franqueado='$idf'");

                            $res1 = mysqli_fetch_array($result1);

                            echo "<tr>";
                            echo "<td>".$res1['nome_franquia']."</td>";
                            echo "<td>".$res1['nome_responsavel']."</td>";
                            echo "<td>".$res1['numero']."</td>";
                            echo "<td>".$res1['endereco']."</td>";
                            echo "<td>".$res1['tel_franquia']."</td>";
                            echo "<td>".$res1['tel_responsavel']."</td>";
                            echo "<td>".$res1['cep']."</td>";	
                            echo "</tr>";
                        }
                    ?>   
                </table>
            </div>
            <div class="btn-sv">
                <a href='./viewKpi.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
            </div>  
    </section>
</body>
</html>