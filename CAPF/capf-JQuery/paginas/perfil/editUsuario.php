<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link href="../../estilos/menu.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Regiões do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];

        	// checking empty fields
        if(empty($nome) || empty($cpf) || empty($usuario) || empty($creci)) {
                    
            if(empty($name)) {
                echo "<font color='red'>Name field is empty.</font><br/>";
            }
            
            if(empty($qty)) {
                echo "<font color='red'>Quantity field is empty.</font><br/>";
            }
            
            if(empty($price)) {
                echo "<font color='red'>Price field is empty.</font><br/>";
            }
        } else {
            $cpf = $_SESSION['cpf'];
            mysqli_query($mysqli, "INSERT INTO usuario(id_RegiaoBrasil, nome, Adm_Usuario_cpf) VALUES('', '$name', '$cpf')")
                or die("Could not execute the insert query.");
            header('Location: ./viewRegiaoBrasil.php');   
            echo "Registration successfully";
            echo "<br/>";
        }
    } 
?>

    <!-- Sesão Formulário-->
    <section id="formulario" class="section-content-row" >
        <div class="content">
         <!-- Conteudo dos boxs -->
            <div class="container">
                <div class="form-container"> 
                    <!-- Titulo da sessão -->
                    <div class="title-section">
                        <span class="sub-title">Adicionar 
                            <span>regiões</span>
                            do Brasil
                        </span>
                    <!-- <h2>Cadastra-se Agora</h2>-->
                    </div>
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações das Regiões do Brasil</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome da região:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome da Região do Brasil"
                                    required>
                                </div>
                            </div>
                        </section>
                        <div>
                            
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='javascript:self.history.back();'>
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