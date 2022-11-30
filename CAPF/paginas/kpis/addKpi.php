<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include KPI</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");

    /*
    $idKPI = $_GET['id'];
    $nomeKPI = $_GET['nome'];
    
    $nomeMF = $_GET['nome1'];
    $idC = $_GET['id2'];
    $nomeC = $_GET['nome2'];
    */
    $idMF = $_GET['id1'];
    
    
    $result = mysqli_query($mysqli, 
    "SELECT * FROM categoriakpi 
    WHERE MasterFranquia_Franqueado_id_franqueado='$idMF'");
    

    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado IN 
       (SELECT Franqueado_id_franqueado  
          FROM masterfranquia)");
    
    $result3 = mysqli_query($mysqli, 
    "SELECT * FROM masterfranquia
    WHERE UsuarioMasterFranqueado_Usuario_cpf IN 
       (SELECT cpf  
          FROM usuario)");

    if(isset($_POST['submit'])) {
        $name = $_POST['nome'];
        $idcat = $_POST['idcat'];
                
        if($name == "" || /*$meta == "" ||*/ $idcat == "" ) {
            echo "All fields should be filled. Either one or many fields are empty.";
        } elseif($_SESSION['tipo'] == 2){

            mysqli_query($mysqli, 
            "INSERT INTO kpi(id_kpi,tipo,nome,valorMeta,CategoriaKpi_id_categoria,MasterFranquia_Franqueado_id_franqueado) 
            VALUES('','','$name',0,'$idcat','$idMF')");

            header('Location: ./viewKpi.php');   
            echo "Registration successfully";
            echo "<br/>";  
        } elseif($_SESSION['tipo'] == 1){
            $mf = $_POST['mf'];
            $res3 = mysqli_fetch_array($result3);
            $idfranq = $res3['Franqueado_id_franqueado'];
            mysqli_query($mysqli, 
            "INSERT INTO kpi(id_kpi,tipo,nome,valorMeta,CategoriaKpi_id_categoria,MasterFranquia_Franqueado_id_franqueado) 
            VALUES('','','$name',0,'$idcat','$mf')");

            header('Location: ./viewKpi.php');   
            echo "Registration successfully";
            echo "<br/>";  
        }
    } 
?>
    <?php include '../../menuSub.php';?>
    <!-- Sesão Formulário-->
    <section id="formulario" class="section-content-row" >
        <div class="content">
         <!-- Conteudo dos boxs -->
            <div class="container">
                <div class="form-container"> 
                    <div class="title-section2">
                        <span class="sub-title2">
                            Adicionar KPI's
                        </span>
                    </div> 
                    <!-- Titulo da sessão -->
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Informe um nome para o KPI e a Categoria a que pertence:</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome:*</label>
                                    <input id="nome" name="nome" class="w-100" type="text" placeholder="Informe o nome do KPI"
                                    required>
                                </div>
                                <?php if ($_SESSION['tipo'] == 1): ?>
                                <div class="form-area form-col">
                                    <label for="bairro">Master franquia:*</label>
                                    <select  id="estado" class="w-100" name="mf" required>
                                        <option selected="true" disabled="disabled">Seleção da Master Franquia associada</option>
                                        <?php
                                        while($res2 = mysqli_fetch_array($result2)) {	
                                            $nome2 = $res2['nome_franquia'];
                                            $id2 = $res2['id_franqueado'];
                                            echo "<option value ='.$id2.' >".$nome2."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>  
                                <?php endif; ?>  

                                <div class="form-area form-col">
                                    <label for="bairro">Categoria:*</label>
                                    <select  id="estado" class="w-100" name="idcat" required>
                                        <option selected="true" disabled="disabled">Selecione uma categoria para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	
                                            $nome1 = $res['nome'];
                                            $id3 = $res['id_categoria'];
                                            echo "<option value ='.$id3.' >".$nome1."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>            
                            </div>
                        </section>
                        <div> 
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Salvar</button>
                        </div>
                    </form>
            
                        <div class="link-inc">
                            <a href='./viewKPI.php'>
                                <button class="btn-clean btn-submit" type="submit" >Voltar</button>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</body>
</html>