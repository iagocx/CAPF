<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
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
        $cpf = $_POST['cpf'];
        $name = $_POST['name'];
        $user = $_POST['user'];
        $senha = $_POST['senha'];
        $creci = $_POST['creci'];
        $email = $_POST['email'];
        $cpfAdm = $_SESSION['cpf'];
        
        if($name==""||$cpf==""||$user==""||$senha==""||$creci==""||$email=="") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } else {
            mysqli_query($mysqli, 
                "UPDATE usuario 
                SET cpf='$cpf', nome='$name', usuario='$user', senha='$senha', tipo=2, creci='$creci', email='$email'
                WHERE cpf='$id'")
                or die("Could not execute the insert query.");    
            mysqli_query($mysqli, 
                "UPDATE usuariomasterfranqueado 
                SET Usuario_cpf='$cpf', Adm_Usuario_cpf='$cpfAdm'  
                WHERE Usuario_cpf='$id'")
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
                            Editar Regiões de Franquia
                        </span>
                    </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <div class="title-section">
                                <span class="sub-title">
                                    Dados referentes:
                                    <br>-Região:
                                    <br>
                                </span>
                            </div> 
                            <h4>- Preencha as informações de cadastro do Master franqueado</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Cpf:*</label>
                                    <input id="nome" name="cpf" class="w-100" type="text" placeholder="Informe o cpf"
                                    required>
                                </div>
                            </div>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome "
                                    required>
                                </div>
                            </div>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Usuário:*</label>
                                    <input id="nome" name="user" class="w-100" type="text" placeholder="Informe o usuário"
                                    required>
                                </div>
                            </div>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Senha:*</label>
                                    <input id="nome" name="senha" class="w-100" type="text" placeholder="Informe a senha"
                                    required>
                                </div>
                            </div>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Creci:*</label>
                                    <input id="nome" name="creci" class="w-100" type="text" placeholder="Informe o número do CRECI"
                                    required>
                                </div>
                            </div>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Email:*</label>
                                    <input id="nome" name="email" class="w-100" type="text" placeholder="Informe o Email"
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
                            <a href='./viewRegiaofranquia.php'><!--javascript:self.history.back();-->
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