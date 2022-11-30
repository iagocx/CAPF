<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

$tipo = $_SESSION['tipo'];
$cpf = $_SESSION['cpf'];

if($tipo == 2){
    $result = mysqli_query($mysqli, 
    "SELECT * FROM masterfranquia
    WHERE UsuarioMasterFranqueado_Usuario_cpf='$cpf'");
    $res = mysqli_fetch_array($result);
    $aux = $res['Franqueado_id_franqueado'];
    
    $result3 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado='$aux'");
    $res3 = mysqli_fetch_array($result3);
    $nomem2 = $res3['nome_franquia'];
    $idfran2 = $res3['id_franqueado'];

    $result1 = mysqli_query($mysqli, 
    "SELECT * FROM categoriaKpi 
    WHERE MasterFranquia_Franqueado_id_franqueado='$aux'");

}elseif($tipo == 1){
    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM usuario 
    WHERE tipo=2");

    if(isset($_POST['submit'])) {
        $idmf = $_POST['mf'];

        if($idmf == "") {  
            echo "Campos id da master franquia está vazio.";
        } else {
            $result1 = mysqli_query($mysqli, 
            "SELECT * FROM categoriakpi 
            WHERE MasterFranquia_Franqueado_id_franqueado='$idmf'");

            $result3 = mysqli_query($mysqli, 
            "SELECT * FROM franqueado 
            WHERE id_franqueado='$idmf'");
            $res3 = mysqli_fetch_array($result3);
            $nomem1 = $res3['nome_franquia'];
            $idfran1 = $res3['id_franqueado'];

        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Categorias KPI</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
    <div class="title-section2">
                <span class="sub-title2">
                    Categorias de KPI's
                </span>
            </div>
        <div class="content">
        <?php if ($tipo == 1): ?>
            <form id="formAero" name="form1" action="" method="post">
                <div class="title-section">
                    <span class="sub-title">
                        Listar Categorias KPI da <span>Master Franquia</span>:
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
                                
                                $nomeu = $res3['nome_franquia'];
                                echo "<option value ='$idfranq'>".$nomeu."</option>";
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
            <!-- Titulo da sessão -->
            
             
            <div class="conteudo">
            <div class="title-section">
                <?php if($tipo == 1): ?>
                    <?php if (isset($_POST['submit'])): ?>
                    <span class="sub-title">
                        Listar <span>Metas</span>:
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
                        <th>Categoria KPI</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                    
                    <?php
                        if(isset($_POST['submit'])){
                            while($res1 = mysqli_fetch_array($result1)) {	
                                echo "<tr>";
                                echo "<td>".$res1['nome']."</td>";
                                echo "<td><a href=\"editCategoriaKpi.php?id=$res1[id_categoria]&&nome=$res1[nome]&&nome1=$nomem1&&id1=$idfran1\">Edit</a></td>";
                                echo "<td><a href=\"delCategoriaKpi.php?id=$res1[id_categoria]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        }elseif($tipo==2){
                            while($res1 = mysqli_fetch_array($result1)) {
                                echo "<tr>";
                                echo "<td>".$res1['nome']."</td>";
                                echo "<td><a href=\"editCategoriaKpi.php?id=$res1[id_categoria]&&nome=$res1[nome]&&nome2=$nomem2&&id2=$idfran2\">Edit</a></td>";
                                echo "<td><a href=\"delCategoriaKpi.php?id=$res1[id_categoria]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        }
                        
                    ?>   
                </table>
            </div>
            <div class="btn-sv">
                <a href="./addCategoriaKpi.php">
                    <button class="btn-clean btn-submit" type="submit">Incluir</button>
                </a>
                <a href='../../menu.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
            </div>  
    </section>
</body>
</html>