<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include RegCategorias de Kpi's</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");

    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
    WHERE id_franqueado IN 
       (SELECT Franqueado_id_franqueado  
          FROM masterfranquia)");

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        

        if($name == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } elseif($_SESSION['tipo'] == 2) {//sessao = 2
            $cpf = $_SESSION['cpf'];

            $result3 = mysqli_query($mysqli, "SELECT * FROM masterfranquia where UsuarioMasterFranqueado_Usuario_cpf='$cpf'");
            $res3 = mysqli_fetch_array($result3);
            $idfranq = $res3['Franqueado_id_franqueado'];

            mysqli_query($mysqli, 
            "INSERT INTO categoriakpi
            (id_categoria, nome, MasterFranquia_Franqueado_id_franqueado) 
            VALUES('', '$name', '$idfranq')")
                or die("Could not execute the insert query.");

            header('Location: ./viewCategoriaKpi.php');   
            echo "Registro bem sucedido.";
            echo "<br/>";
        }elseif($_SESSION['tipo'] == 1){
            $mf = $_POST['mf'];
            if($mf == ''){
                echo "Campo da master franquia associada está vazio. Ele deve ser preenchido.";
            }else{
                mysqli_query($mysqli, 
                "INSERT INTO categoriakpi
                (id_categoria, nome, MasterFranquia_Franqueado_id_franqueado) 
                VALUES('','$name','$mf')");
                header('Location: ./viewCategoriaKpi.php');
                echo "Registro bem sucedido.";
                }
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
                            Adicionar Categorias de KPI's
                        </span>
                    </div>
                    <form id="formAero" name="form1" action="" method="post">
                        
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações da Categoria</h4>
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome da categoria:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome da Categoria"
                                    required>
                                </div>
                                <?php if ($_SESSION['tipo'] == 1): ?> 
                                <div class="form-area form-col">
                                    <label for="bairro">Master Franquia:*</label>
                                    <select  id="estado" class="w-100" name="mf" required>
                                        <option selected="true" disabled="disabled">Seleção da master franquia associada a região</option>
                                        <?php
                                        while($res2 = mysqli_fetch_array($result2)) {	
                                            $nome1 = $res2['nome_franquia'];
                                            $idfranq = $res2['id_franqueado'];
                                            echo "<option value ='.$idfranq.' >".$nome1."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <?php endif; ?> 
                            </div>
                        </section>
                        <div>
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='./viewCategoriaKpi.php'><!--javascript:self.history.back();-->
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