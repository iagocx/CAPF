<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include usuário franqueado</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");
    
    $result = mysqli_query($mysqli, "SELECT * FROM usuario where tipo=2");


    if(isset($_POST['submit'])) {
        $cpf = $_POST['cpf'];
        $name = $_POST['name'];
        $user = $_POST['user'];
        $senha = $_POST['senha'];
        $senha2 = $_POST['senha2'];
        $creci = $_POST['creci'];
        $email = $_POST['email'];
        $email2 = $_POST['email2'];
        $cpfs = $_SESSION['cpf'];
        $umf = $_POST['umf'];

        if($email2==""||$senha2=="" ||$name==""||$cpf==""||$user==""||$senha==""||$creci==""||$email==""||$email2=="" ) {
            echo "Todos os campos devem estar preenchidos. Um ou vários campos estão vazios.";
        } elseif ($senha!=$senha2){
            echo "Os campos senhas são diferentes.".$senha."-".$senha2." ";
            
        } elseif ($email!=$email2){
            echo "Os campos email são diferentes.";
        
        } elseif($_SESSION['tipo'] == 2) {
            mysqli_query($mysqli, "INSERT INTO usuario VALUES('$cpf', '$name', '$user', '$senha', '3', '$creci', '$email')")
                or die("Could not execute the insert query.");    
            mysqli_query($mysqli, "INSERT INTO usuariofranqueado VALUES('$cpf', '$cpfs')")
                or die("Could not execute the insert query.");
            header('Location: ./viewusuariosFranqueados.php');   
            echo "Registration successfully";
            echo "<br/>";
        } elseif($_SESSION['tipo'] == 1) {
            mysqli_query($mysqli, "INSERT INTO usuario VALUES('$cpf', '$name', '$user', '$senha', '3', '$creci', '$email')")
                or die("Could not execute the insert query.");    
            mysqli_query($mysqli, "INSERT INTO usuariofranqueado VALUES('$cpf', '$umf')")
                or die("Could not execute the insert query.");
            header('Location: ./viewusuariosFranqueados.php');   
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
                            Adicionar Usuários Franqueados
                        </span>
                    </div> 
                    
                    
                    <!-- <h2>Cadastra-se Agora</h2>-->
               
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações de cadastro do usuário franqueado</h4>
                            
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome "
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Cpf:*</label>
                                    <input id="nome" name="cpf" class="w-100" type="text" placeholder="Informe o cpf"
                                    required>
                                </div>                                
                            </div>

                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Usuário:*</label>
                                    <input id="nome" name="user" class="w-100" type="text" placeholder="Informe o usuário"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Creci:*</label>
                                    <input id="nome" name="creci" class="w-100" type="text" placeholder="Informe o número do CRECI"
                                    required>
                                </div>
                            </div>
                            
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Senha:*</label>
                                    <input id="nome" name="senha" class="w-100" type="text" placeholder="Informe a senha"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Senha:*</label>
                                    <input id="nome" name="senha2" class="w-100" type="text" placeholder="Confirmar a senha"
                                    required>
                                </div>

                                <?php if ($_SESSION['tipo'] == 1): ?> 
                                <div class="form-area  form-col">
                                    <label for="masterfranquia">Usuário Master Franquia:*</label>
                                    <select  id="estado" class="w-100" name="umf" required>
                                        <option selected="true" disabled="disabled">Selecio uma usuário MF para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {//tabela MF 2 resgistros
                                            $cpfu= $res['cpf'];
                                            $nomeu = $res['nome'];
                                            echo "<option value ='.$cpfu.'>".$nomeu."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <?php endif; ?>  
                                
                            </div>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Email:*</label>
                                    <input id="nome" name="email" class="w-100" type="text" placeholder="Informe o Email"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Email:*</label>
                                    <input id="nome" name="email2" class="w-100" type="text" placeholder="Confirmar Email"
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
                            <a href='./viewusuariosFranqueados.php'><!--javascript:self.history.back();-->
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