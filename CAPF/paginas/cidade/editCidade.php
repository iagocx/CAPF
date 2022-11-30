<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Cidades do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");

    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, "SELECT * FROM estado ORDER BY nome");
    $nome1 = $_GET['nome1'];
    $id = $_GET['id'];

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $id1 = $_POST['id1'];

        if($name == "" || $id1 == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        }else {
            $cpf = $_SESSION['cpf'];
            mysqli_query($mysqli, "UPDATE cidade SET nome='$name', Adm_Usuario_cpf='$cpf', Estado_id_estado1='$id1' WHERE id_cidade='$id'")
                or die("Could not execute the insert query.");
            header('Location: ./viewCidade.php');   
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
                            Editar Cidades
                        </span>
                    </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <div class="title-section">
                            <span class="sub-title">Dados referentes:
                                <br>-Cidade:
                                <?php echo "<span>".$nome1."</span>"; ?>
                                
                            </span>
                        </div>
                    
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações das Cidades do Brasil</h4>
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome da Cidade:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome do estado do Brasil"
                                    required>
                                </div>
                                
                                <div class="form-area form-col">
                                    <label for="bairro">Estado:*</label>
                                    <select  id="estado" class="w-100" name="id1" required>
                                        <option selected="true" disabled="disabled">Selecio um Estado para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	
                                            $nome2 = $res['nome'];
                                            $id1 = $res['id_estado'];
                                            echo "<option value ='.$id1.' >".$nome2."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                            </div>
                        </section>
                        <div>
                            
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='./viewCidade.php'>
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