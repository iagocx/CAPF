<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//Pegando o nome da franquia associada ao usuário logado
if($_SESSION['tipo'] == 3){
    $cpf = $_SESSION['cpf'];

    $result = mysqli_query($mysqli, 
    "SELECT * FROM franquia
    WHERE UsuarioFranqueado_Usuario_cpf='$cpf'");
    $res = mysqli_fetch_array($result);
    $aux = $res['Franqueado_id_franqueado'];
    $aux2 = $res['MasterFranquia_Franqueado_id_franqueado'];

    $result8 = mysqli_query($mysqli, 
    "SELECT * FROM masterfranquia
    WHERE Franqueado_id_franqueado='$aux2'");
    $res8 = mysqli_fetch_array($result8);
    $aux6 = $res8['Franqueado_id_franqueado'];

    $result9 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado='$aux6'");
    $res9 = mysqli_fetch_array($result9);
    $aux6 = $res9['nome_franquia'];

    $result1 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado='$aux'");
    $res1 = mysqli_fetch_array($result1);
    $aux1 = $res1['nome_franquia'];

    $result4 = mysqli_query($mysqli, 
        "SELECT * FROM categoriaKpi
        WHERE MasterFranquia_Franqueado_id_franqueado='$aux2'");

    
}

    $result3 = mysqli_query($mysqli, 
    "SELECT CURRENT_DATE AS 'Data Atual',
    CURRENT_TIME AS 'Hora Atual',
    CURRENT_TIMESTAMP 'Data e Hora atuais',
    EXTRACT( DAY FROM CURRENT_DATE) AS 'Dia Atual',
    EXTRACT( MONTH FROM CURRENT_DATE) AS 'Mês Atual',
    EXTRACT( YEAR FROM CURRENT_DATE) AS 'Ano Atual'");
    $res3 = mysqli_fetch_array($result3);
    $dataAtual = $res3['Data Atual'];
    $dataDia = $res3['Dia Atual'];
    $dataMes = $res3['Mês Atual']; 
    $dataAno = $res3['Ano Atual'];
    $dataReg = $res3['Data Atual'];

    //$dataMesAno = '2222/22/22';//inicializa vazio
    $aux3 = '';//inicializa vazio
    if(isset($_POST['submit'])) {
        $dataMesAno = $_POST['dataMAR'];
        $idcat = $_POST['idcat'];
        //echo $idcat;
       //echo 'dataMesAno2 == '.$dataMesAno;
        //echo '<br>idcat == '.$idcat;
        
        if($dataMesAno == "") {
            echo "Campo data de referência deve ser preenchido. Este campo está vazio.";
        }elseif($idcat == "") {
            echo "Campo id categoria deve ser preenchido. Este campo está vazio.";
        }else{
            $result6 = mysqli_query($mysqli, 
            "SELECT * FROM categoriaKpi WHERE id_categoria='$idcat'"); 
            $res6 = mysqli_fetch_array($result6); 
            $aux3 = $res6['nome'];
            //echo "<br>".$res6['nome'];

            $result7 = mysqli_query($mysqli, 
            "SELECT * FROM kpi 
            WHERE CategoriaKpi_id_categoria ='$idcat' 
            and MasterFranquia_Franqueado_id_franqueado='$aux2'");

        }
    }
    if(isset($_POST['enviar'])) {
        $idRegKpi = $_POST['idRegKpi'];
        
        if($idRegKpi == '') {
            echo "Não recebeu o valor do id_kpi.";
        }else{
            mysqli_query($mysqli, 
            "UPDATE registrokpi
            SET status='E', dataEnvio='$dataAtual'
            WHERE id_registro='$idRegKpi'");
                  
        }                        
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/form2.css" type="text/css" rel="stylesheet">
    
	<meta charset="UTF-8">
	<title>Enviar KPI</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="top" class="section-content-row">
        <div>
            <div class="title-section2">
                <span class="sub-title2">
                    Enviar KPI's
                </span>
            </div> 
            <form id="formAero" name="form1" action="" method="post">
                <div class="tresfr">
                    <div class="form-area form-col">
                        <span class="letratopo">Data do registro: 
                            <?php echo "<span>".$dataDia."/".$dataMes."/".$dataAno."</span>";?>
                        </span>
                    </div>
                </div>
                <div class="tresfr">
                    <div class="form-area form-col">
                        <label for="categoria">Categoria:*</label>
                        <select id="categoria" class="w-100" name="idcat" required>
                            <option selected="true" disabled="disabled">Selecione uma categoria de KPI's</option>
                            <?php
                            while($res4 = mysqli_fetch_array($result4)) {//franquia do asuario tipo 3
                                $nome4 = $res4['nome'];
                                $id4 = $res4['id_categoria'];
                                echo "<option value ='$id4'>".$nome4."</option>";
                                
                            }
                            ?>                    
                        </select>
                    </div>
                    <div class="form-area form-col">
                        <label for="nome">Mês/Ano de referência:</label>
                        <input id="nome" name="dataMAR" class="w-100" type="date" placeholder="Informe a data da operação">
                    </div>
                </div>          
                <div>         
                    <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                    <button class="btn-clean btn-submit" type="submit" name="submit">Pesquisar</button>
                </div>
                <span class="lembrete">Clique em pesquisar para visualizar os registros de KPI's</span>      
            </form>
        </div>
        
        <div class="conteudo">
            <!-- Titulo da sessão -->
            <div class="title-section">
                <span class="sub-title">
                    Lista de KPI'S referenciando:
                    <?php if ($_SESSION['tipo'] == 3): ?>
                        <?php if ($aux1 == '' || $aux3 == '' || $dataMesAno == ''): ?>
                            <br>-Franquia:
                            <?php echo "<span>Selecione</span>";?>
                            <br>-Categoria:
                            <?php echo "<span>Selecione</span>";?>
                            <br>-Mês/Ano de referência:
                            <?php echo "<span>Selecione</span>";?>
                        <?php else: ?>
                            <br>-Franquia:
                            <?php echo "<span>".$aux1."</span>";?>
                            <br>-Categoria:
                            <?php echo "<span>".$aux3."</span>";?>
                            <br>-Mês/Ano de referência:
                            <?php echo "<span>".$dataMesAno."</span>";?>
                        <?php endif; ?>
                    <?php endif; ?> 
                </span>
            </div>
            <div class="tb-scrol">
                <table>
                    <tr>
                        <th>Nome do KPI</th>     
                        <th>Valor de Registro</th>
                        <th>Valor da Meta</th>
                        <th>Data de registro</th>
                        <th>Data de envio</th>
                        <th>Mês/Ano de referência</th>
                        <th>Status</th>
                        <th>Incluir</th>
                    </tr>
                    <?php
                        if(isset($_POST['submit'])) {
                            while($res7 = mysqli_fetch_array($result7)) {//tabela kpi
                                $aux4 = $res7['id_kpi'];//kpi.id_kpi
                                $aux5 = $res7['nome'];//kpi.nome

                                $result2 = mysqli_query($mysqli,//tabela registrokpi
                                "SELECT * FROM registrokpi 
                                WHERE kpi_id_kpi='$aux4'");
                                $res2 = mysqli_fetch_array($result2);
                                	
                                $statusString = '';
                                if(mysqli_num_rows($result2) >0){//SELECT registroKpi; nao retornou vazio registro
                                    if($res2['status'] == 'R'){//se existe, status R
                                        $statusString = 'Registrado';
                                        echo "<tr>";
                                        echo "<td>".$res7['nome']."</td>";
                                        echo "<td>".$res2['valorRegistro']."</td>";
                                        echo "<td>".$res7['valorMeta']."</td>";
                                        echo "<td>".$res2['dataRegistro']."</td>";
                                        echo "<td>".$res2['dataEnvio']."</td>";
                                        echo "<td>".$res2['mesAnoReferencia']."</td>";
                                        echo "<td>".$statusString."</td>";
                                        $aux7 = $res2['id_registro'];
                                        echo "<td>
                                            <form name='form2' action='' method='post'>
                                            <input id='nome' name='idRegKpi' class='w-100' type='hidden' value='$aux7'>
                                                <button class='btn-clean btn-submit' type='submit' name='enviar'>Enviar</button>
                                            </form>
                                        </td>";

                                        echo "</tr>";
                                        //deixa editar valor
                                    }elseif($res2['status'] == 'E'){//se existe, status E
                                        $statusString = 'Enviado';
                                        //não deixa editar
                                        echo "<tr>";
                                        echo "<td>".$res7['nome']."</td>";
                                        echo "<td>".$res2['valorRegistro']."</td>";
                                        echo "<td>".$res2['valorMeta']."</td>";
                                        echo "<td>".$res2['dataRegistro']."</td>";
                                        echo "<td>".$res2['dataEnvio']."</td>";
                                        echo "<td>".$res2['mesAnoReferencia']."</td>";
                                        echo "<td>".$statusString."</td>";
                                        echo "<td>Finalizado</td>";
                                        echo "</tr>";
                                    }elseif($res2['status'] == 'C'){//se existe, status E
                                        $statusString = 'Consolidado';
                                        echo "<tr>";
                                        echo "<td>".$res7['nome']."</td>";
                                        echo "<td>".$res2['valorRegistro']."</td>";
                                        echo "<td>".$res2['valorMeta']."</td>";
                                        echo "<td>".$res2['dataRegistro']."</td>";
                                        echo "<td>".$res2['dataEnvio']."</td>";
                                        echo "<td>".$res2['mesAnoReferencia']."</td>";
                                        echo "<td>".$statusString."</td>";
                                        echo "<td>Finalizado</td>";
                                        echo "</tr>";
                                    }else{//status vazio
                                        echo "<tr>";
                                        echo "<td>".$res7['nome']."</td>";
                                        echo "<td></td>";
                                        echo "<td>".$res7['valorMeta']."</td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                }else{//0 registros
                                    echo "<tr>";
                                    echo "<td>".$res7['nome']."</td>";
                                    echo "<td></td>";
                                    echo "<td>".$res7['valorMeta']."</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";	
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "</tr>";//nome1=$aux1   --> nome_franquia
                                }                //nome2=$aux3   --> nome_cateoria
                            }                    //dataref=$dataMesAno  --> $dataMesAno
                        }                        //datareg=$dataAtual   -->data de registro
                                                 //nomemf=$aux6         -->nome_franquia da master franquia
                                                //id1=$aux          -->id_franquia
                    ?>                                      
                </table>
        </div> 
        <div class="btn-sv">
                <a href='../../menu.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
                <!--<a href="./addRegistrarKpi.php">
                    <button class="btn-clean btn-submit" type="submit">Registrar</button>
                </a>-->
            </div> 
    </section>
</body>
</html>