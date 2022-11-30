<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
$tipo = $_SESSION['tipo'];
$cpf = $_SESSION['cpf'];

if($tipo == 2){
    //echo 'tipo: '.$tipo;
    $result = mysqli_query($mysqli, 
    "SELECT * FROM masterfranquia
    WHERE UsuarioMasterFranqueado_Usuario_cpf='$cpf'");
    $res = mysqli_fetch_array($result);
    $aux = $res['Franqueado_id_franqueado'];

    $result1 = mysqli_query($mysqli, 
    "SELECT * FROM kpi 
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");

    $result3 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado='$aux'");
    $res3 = mysqli_fetch_array($result3);
    $nomem2 = $res3['nome_franquia'];

}elseif($tipo == 1){
    //echo 'tipo: '.$tipo;
    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM usuario 
    WHERE tipo=2");

    if(isset($_POST['submit'])) {
        $idmf = '';
        $idmf = $_POST['mf'];
        //echo "<br>idmf: ".$idmf."<br>";
        if($idmf == "") {  
            echo "Campos id da master franquia está vazio.";
        } else {

            $result1 = mysqli_query($mysqli, 
            "SELECT * FROM kpi 
            WHERE MasterFranquia_Franqueado_id_franqueado='$idmf'");

            $result4 = mysqli_query($mysqli, 
            "SELECT * FROM franqueado 
            WHERE id_franqueado='$idmf'");
            $res4 = mysqli_fetch_array($result4);
            $nomem1 = $res4['nome_franquia'];
        }
    }
    //echo $nomem2;
                    //echo "nome MF tipo=1: ".$nomem1;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Metas KPI's</title>
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
                    Metas
                </span>
            </div> 
            <?php if ($tipo == 1): ?>
            <form id="formAero" name="form1" action="" method="post">
                <div class="title-section">
                    <span class="sub-title">
                        Listar Metas da <span>Master Franquia</span>
                    </span>
                </div>
                <div class="tresfr">
                    <div class="form-area form-col">
                        <label for="masterfranquia">Master Franquia:*</label>
                        <select  id="masterfranquia" class="w-100" name="mf" required>
                            <option selected="true" disabled="disabled">Selecione uma Master franquia para listar as metas</option>
                            <?php
                            while($res2 = mysqli_fetch_array($result2)) {//tabela MF 2 resgistros
                                $cpfu = $res2['cpf'];
                                $result = mysqli_query($mysqli, 
                                "SELECT * FROM masterfranquia
                                WHERE UsuarioMasterFranqueado_Usuario_cpf='$cpfu'");
                                $res = mysqli_fetch_array($result);
                                $idfranq= $res['Franqueado_id_franqueado'];

                                $result3 = mysqli_query($mysqli, 
                                "SELECT * FROM franqueado
                                WHERE id_franqueado='$idfranq'");
                                $res3 = mysqli_fetch_array($result3);
                                
                                $nomef = $res3['nome_franquia'];
                                echo "<option value ='$idfranq'>".$nomef."</option>";
                            }
                            ?>                    
                        </select>
                    </div>
                </div>  
                <div>  
                    <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                    <button class="btn-clean btn-submit" type="submit" name="submit">Listar</button>
                </div>
            </form>
            <?php endif; ?>
            
            <div class="conteudo">
                <!-- Titulo da sessão -->
                
                <div class="title-section">
                <?php if($tipo == 1): ?>
                    <?php if (isset($_POST['submit'])): ?>
                    <span class="sub-title">
                        Referentes a:
                        <br>-Master franquia: 
                        <?php echo "<span>".$nomem1."</span>"; ?>
                    </span>
                    <?php endif; ?> 
                <?php elseif($tipo == 2): ?>
                    
                    <span class="sub-title">
                        Dados referentes:
                        <br>-Master franquia: 
                        <?php echo "<span>".$nomem2."</span>"; ?>
                    </span>
                <?php endif; ?> 
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Nome do KPI</th>
                            <th>Valor da meta</th>
                            <th>Alterar</th>
                        </tr>
                        <?php
                            if(isset($_POST['submit'])){
                                while($res1 = mysqli_fetch_array($result1)) {
                                    echo "<tr>";
                                    echo "<td>".$res1['nome']."</td>";
                                    echo "<td>".$res1['valorMeta']."</td>";
                                    echo "<td><a href=\"editMetas.php?id=$res1[id_kpi]&&nome1=$res1[nome]\">Edit</a></td>";		
                                    echo "</tr>";
                                }
                            }elseif($tipo==2){
                                while($res1 = mysqli_fetch_array($result1)) {
                                    echo "<tr>";
                                    echo "<td>".$res1['nome']."</td>";
                                    echo "<td>".$res1['valorMeta']."</td>";
                                    echo "<td><a href=\"editMetas.php?id=$res1[id_kpi]&&nome1=$res1[nome]\">Edit</a></td>";		
                                    echo "</tr>";
                                }
                            }

                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href='../../menu.php'>
                        <button class="btn-clean btn-submit" type="submit">Voltar</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>