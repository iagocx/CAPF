<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/selectm.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Regiões franquiadas</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");
    $result = mysqli_query($mysqli, "SELECT * FROM franqueado ORDER BY nome_franquia");
    $result1 = mysqli_query($mysqli, "SELECT * FROM bairro ORDER BY nome");
    
 
    echo "<span>".$bairros."</span>"; 


    if(isset($_POST['submit'])) {
        $nomereg = $_POST['nomereg'];
        $bairros = $_POST['bairros'];
        $cpfAdm = $_SESSION['cpf'];

        if($nomereg==""||$bairros=="") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } else {
            
            mysqli_query($mysqli, "INSERT INTO usuario VALUES('$cpf', '$name', '$user', '$senha', '2', '$creci', '$email')")
                or die("Could not execute the insert query.");    
            mysqli_query($mysqli, "INSERT INTO usuariomasterfranqueado VALUES('$cpf', '$cpfAdm')")
                or die("Could not execute the insert query.");
            header('Location: ./viewMasterFranqueado.php');   
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
                    <!-- Titulo da sessão -->
                    <div class="title-section2">
                        <span class="sub-title2">
                            Adicionar Regiões de Franquia
                        </span>
                    </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações de cadastro da Região da franquia</h4>
                            
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome da região:*</label>
                                    <input id="nome" name="nomereg" class="w-100" type="text" placeholder="Informe o nome do responsável"
                                    required>
                                </div>
                                <div class="form-area form-col">
                                    <label for="bairro">Master Franquia:*</label>
                                    <select  id="estado" class="w-100" name="mf" required>
                                        <option selected="true" disabled="disabled">Seleção da master franquia associada a região</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	
                                            $nome1 = $res['nome_franquia'];
                                            $idregiao = $res['id_RegiaoBrasil'];
                                            echo "<option value ='.$idregiao.' >".$nome1."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                            </div>
                            <div class="tresfr">
                                <div class="form-area2 form-col">
                                    <label for="bairro">Bairros:*</label>
                                    <select multiple id="bairros" size="20" class="w-101" name="bairros" required>
                                        <option selected="true" disabled="disabled">Seleção dos bairros da região</option>
                                        <?php
                                        while($res1 = mysqli_fetch_array($result1)) {	
                                            $nome1 = $res1['nome'];
                                            $id1 = $res1['id_bairro'];
                                            echo "<option value ='.$id1.' >".$nome1."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>      
                        </section>
                        <div>                  
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='./viewRegiaoFranquia.php'><!--javascript:self.history.back();-->
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