<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//Pegando o nome da franquia associada ao usuário logado
$cpf = $_SESSION['cpf'];
$tipo = $_SESSION['tipo'];



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

if($tipo == 1){
 
}elseif($tipo == 2){
    //PEGAR MASTER FRANQUIA LIGADA AO USUÁRIO LOGADO
    $result = mysqli_query($mysqli, 
    "SELECT * FROM masterfranquia
    WHERE UsuarioMasterFranqueado_Usuario_cpf ='$cpf'");
    $res = mysqli_fetch_array($result);
    $aux = $res['Franqueado_id_franqueado'];//Id da MasterFranquia

    //Pegar nome_franquia para Master franquia
    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado ='$aux'");
    $res2 = mysqli_fetch_array($result2);
    $aux2 = $res2['nome_franquia'];//Nome Master franquia

    //Pegar lista de MoviemntosKpi do Master Franquiado
    $result4 = mysqli_query($mysqli, 
    "SELECT * FROM MovimentoKpi
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");

    //LISTAR FRANQUIAS QUE FAZEM PARTE DA MASTER FRANQUIA ACIMA
    $result1 = mysqli_query($mysqli, 
    "SELECT * FROM franquia
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'"); 

  /*  $result21 = mysqli_query($mysqli, 
    "SELECT * FROM franquia
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");*/
    
  /*  $result15 = mysqli_query($mysqli, 
    "SELECT * FROM franquia
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");*/

    $result13 = mysqli_query($mysqli,
    "SELECT * FROM categoriaKpi
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");
    
    
}
   
    
    $aux17 = '';//inicializa vazio
    $dataMesAno = '';
    if(isset($_POST['submit'])) {
        $dataMesAno = $_POST['dataMAR'];
        $idcat = $_POST['idcat'];
        
        if($dataMesAno == "" && $idcat == "") {
            echo "Campo data de referência e id_categoria devem ser preenchidos. Estes campos estão vazios.";
        }elseif($dataMesAno == "" && isset($_POST['idcat'])){
            
            $result12 = mysqli_query($mysqli, 
            "SELECT * FROM kpi 
            WHERE CategoriaKpi_id_categoria='$idcat' 
            and MasterFranquia_Franqueado_id_franqueado='$aux'");
 
        }elseif($idcat == "" && isset($_POST['dataMAR'])){

        }elseif(isset($_POST['dataMAR']) && isset($_POST['idcat'])){

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
	<title>Avaliar Metas</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php include '../../menuSub.php';?>

    <section id="top" class="section-content-row">
        <div>
            <div class="title-section2">
                <span class="sub-title2">
                    Avaliar Metas
                </span>
            </div>    
            <form id="formAero" name="form1" action="" method="post">
                <div class="tresfr">
                    <div class="form-area form-col">
                        <label for="categoria">Categoria:*</label>
                        <select id="categoria" class="w-100" name="idcat" required>
                            <option selected="true" disabled="disabled">Selecione uma categoria de KPI's</option>
                            <?php
                            
                            while($res13 = mysqli_fetch_array($result13)) {

                                $nome4 = $res13['nome'];
                                $id4 = $res13['id_categoria'];
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
                    Lista de registros consolidados:
                    <br>Dados referentes:
                    <br>-Master Franquia:
                    <?php echo "<span>".$aux2."</span>";?>
                    
                    <?php if ($aux17 == '' && isset($_POST['dataMAR'])): ?> 
                        <br>-Categoria:
                        <?php echo "<span>Selecione</span>";?>
                        <br>-Mês/Ano de referência:
                        <?php echo "<span>".$dataMesAno."</span>";?>   
                    
                    <?php elseif($dataMesAno == "" && isset($_POST['idcat'])): ?>
                        <br>-Categoria:
                        <?php echo "<span>".$aux17."</span>";?>
                        <br>-Mês/Ano de referência:
                        <?php echo "<span>Selecione</span>";?>
                    
                    <?php elseif(isset($_POST['dataMAR']) && isset($_POST['idcat'])): ?>
                        <br>-Categoria:
                        <?php echo "<span>".$aux17."</span>";?>
                        <br>-Mês/Ano de referência:
                        <?php echo "<span>".$dataMesAno."</span>";?>
                    
                    <?php elseif($aux17 == '' && $dataMesAno == ''): ?>
                        <br>-Categoria:
                        <?php echo "<span>Selecione</span>";?>
                        <br>-Mês/Ano de referência:
                        <?php echo "<span>Selecione</span>";?>
                    <?php endif; ?>  
                </span>
            </div>

            <div class="tb-scrol">
                <table>
                    <tr>
                        <th>Master Franquia</th>     
                        <th>Franquia</th>
                        <th>Categoria</th>
                        <th>KPI</th>
                        <th>Mês/Ano de referência</th>
                        <th>Data de consolidação</th>
                        <th>Valor Registro</th>
                        <th>Valor Meta</th>
                        <th>Relação Registro/Meta</th>
                        <!--<th>Status</th>-->
                    </tr>
                    <?php
                    
                    if(isset($_POST['submit'])) {/*
                        $array = [];
                        if($dataMesAno == "" && isset($_POST['idcat'])){
                            //lista de kpis associado ao Master e a Categoria
                            while($res14 = mysqli_fetch_array($result12)) {
                                $aux27 = $res14['CategoriaKpi_id_categoria'];
                                
                                $result22 = mysqli_query($mysqli, 
                                "SELECT * FROM categoriakpi
                                WHERE id_categoria='$aux27'");
                                $res23 = mysqli_fetch_array($result22);
                                $nomeCAT = $res23['nome'];

                                $aux14 = $res14['id_kpi'];
                                
                               // echo "<br>Número linhas KPI associado a MF e Cat: ".mysqli_num_rows($result12);
                                while($res15 = mysqli_fetch_array($result15)) {
                                    //echo "<br>lista de franquias associado a MF logada: ".mysqli_num_rows($result15);
                                    //lista de franquias da MF logada
                                    $aux15 = $res15['Franqueado_id_franqueado'];

                                    $result14 = mysqli_query($mysqli, 
                                    "SELECT * FROM registroKpi
                                    WHERE Franquia_Franqueado_id_franqueado='$aux15' 
                                    and (status='E' or status='C') 
                                    and Kpi_id_kpi='$aux14'");
            
                                    //echo "<br>Lisa de registros pela kpi_id, franquia_id e status E ou C: ".mysqli_num_rows($result14);
                                    if(mysqli_num_rows($result14) >0){
                                        while($res16 = mysqli_fetch_array($result14)) {//lista de registro
                                            $aux18 = $res16['Franquia_Franqueado_id_franqueado'];
                                            $aux20 = $res16['Kpi_id_kpi'];
                                            $aux28 = $res16['id_registro'];


                                            $result17 = mysqli_query($mysqli, 
                                            "SELECT * FROM franqueado
                                            WHERE id_franqueado='$aux18'");
                                            $res18 = mysqli_fetch_array($result17);
                                            $aux19 = $res18['nome_franquia'];

                                            $result18 = mysqli_query($mysqli, 
                                            "SELECT * FROM kpi
                                            WHERE id_kpi='$aux20'");
                                            $res19 = mysqli_fetch_array($result18);
                                            $aux21 = $res19['nome'];

                                            $statusString = '';
                                            if($res16['status'] == 'E'){

                                                $array[] = $aux28;

                                                $statusString = 'Enviado';
                                                echo "<tr>";  
                                                echo "<td>".$aux2."</td>";//nome master franquia
                                                echo "<td>".$aux19."</td>";//nome franquia
                                                echo "<td>".$nomeCAT."</td>";
                                                echo "<td>".$aux21."</td>";//nome kpi
                                                echo "<td>".$res16['mesAnoReferencia']."</td>";
                                                echo "<td>".$res16['dataRegistro']."</td>";
                                                echo "<td>".$res16['dataEnvio']."</td>";
                                                echo "<td>".$res16['valorRegistro']."</td>";
                                                echo "<td>".$res16['valorMeta']."</td>";
                                                echo "<td>".$statusString."</td>";
                                                echo "</tr>";
                                            
                                            }elseif($res16['status'] == 'C'){
                                                $statusString = 'Consolidado';
                                                echo "<tr>";      
                                                echo "<td>".$aux2."</td>";//nome master franquia
                                                echo "<td>".$aux19."</td>";//nome franquia
                                                echo "<td>".$nomeCAT."</td>";
                                                echo "<td>".$aux21."</td>";//nome kpi
                                                echo "<td>".$res16['mesAnoReferencia']."</td>";
                                                echo "<td>".$res16['dataRegistro']."</td>";
                                                echo "<td>".$res16['dataEnvio']."</td>";
                                                echo "<td>".$res16['valorRegistro']."</td>";
                                                echo "<td>".$res16['valorMeta']."</td>";
                                                echo "<td>".$statusString."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                
                                }

                            }
                        }*/
                    }else{
                        //
                        if(mysqli_num_rows($result4) >0){
                            //Lista de MovimentoKpis do Master Franquiado
                            while($res4 = mysqli_fetch_array($result4)){
                                $temp = $res4['mesAnoReferencia'];
                                $temp1 = $res4['dataConsolidado'];
                                $temp2 = $res4['valorRegistro'];
                                $temp3 = $res4['valorMeta'];
                                $temp4 = $res4['RegistroKpi_id_registro'];
                                
                                $result6 = mysqli_query($mysqli, 
                                "SELECT * FROM registroKpi 
                                WHERE id_registro='$temp4'");

                                //Lista de registros que estão no MovimentoKpi
                                while($res6 = mysqli_fetch_array($result6)){
                                    $temp5 = $res6['Kpi_id_kpi'];
                                    $temp6 = $res6['Franquia_Franqueado_id_franqueado'];
                                    $temp7 = $res6['id_registro'];

                                    $result7 = mysqli_query($mysqli, 
                                    "SELECT * FROM kpi 
                                    WHERE id_kpi='$temp5'");
                                    $res7 = mysqli_fetch_array($result7);
                                    $temp8 = $res7['nome'];
                                    $temp9 = $res7['id_kpi'];
                                    $tem10 = $res7['CategoriaKpi_id_categoria'];

                                    $result9 = mysqli_query($mysqli, 
                                    "SELECT * FROM franqueado 
                                    WHERE id_franqueado='$temp6'");
                                    $res9 = mysqli_fetch_array($result9);
                                    $temp12 = $res9['nome_franquia'];

                                    $result8 = mysqli_query($mysqli, 
                                    "SELECT * FROM categoriakpi 
                                    WHERE id_categoria='$tem10'");
                                    $res8 = mysqli_fetch_array($result8);
                                    $temp11 = $res8['nome'];

                                    $val1 = $temp2 - $temp3;
                                    if($val1 > 0){//meta - registro
                                        $msg = "Meta alcançada com ".$val1." excedentes.";
                                    }elseif($val1 == 0){
                                        $msg = "Meta alcançada.";
                                    }else{
                                        $msg = "Meta não alcançada com ".abs($val1)." de diferença.";
                                    }

                                    echo "<tr>";
                                    echo "<td>".$aux2."</td>";//nome master franquia
                                    echo "<td>".$temp12."</td>";//nome franquia
                                    echo "<td>".$temp11."</td>";//categoria
                                    echo "<td>".$temp8."</td>";//nome kpi
                                    echo "<td>".$temp."</td>";//Mes/Ano referencia
                                    echo "<td>".$temp1."</td>";//data de consolidação
                                    echo "<td>".$temp2."</td>";//valor registro
                                    echo "<td>".$temp3."</td>";//valor meta
                                    echo "<td>".$msg."</td>";
                                    //echo "<td></td>";
                                    echo "</tr>";  
                                }
                            }
                        }  
                    } ?>                                       
                </table>
            </div> 

            <div class="btn-sv">
                <a href='../../menu.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
                <a href="../consolidarKpi/ConsolidarKpi.php">
                    <button class="btn-clean btn-submit" type="submit">Limpar</button>
                </a>
                
            </div>
           
        </div>
    </section> 
</body>
</html>