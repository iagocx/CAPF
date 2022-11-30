<?php session_start(); ?>

<?php
//including the database connection file
include("../../conexao.php");

//fetching data in descending order (lastest entry first)
$cpf = $_SESSION['cpf'];
$tipo = $_SESSION['tipo'];

$result = mysqli_query($mysqli, "SELECT *FROM usuario WHERE cpf='$cpf'");
$res = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Perfil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
    <!-- Sesão Formulário-->
    <section id="formulario" class="section-content-row" >
        <div class="content">
         <!-- Conteudo dos boxs -->
            <div class="container">
                <div class="form-container"> 
                    <div class="title-section2">
                        <span class="sub-title2">
                        Perfil
                        </span>
                    </div>
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <div class="title-section">
                            <span class="sub-title">Editar 
                                <span>informações</span>
                                do usuário
                            </span><br>
                            <span class="sub-title">Perfil do usuário: 
                                <?php 
                                echo "<span>".$res['nome']."</span>"; ?>
                            </span><br>
                            <span class="sub-title">CPF: 
                                <?php 
                                echo "<span>".$res['cpf']."</span>"; ?>
                            </span>
                        </div>

                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Informações do perfil</h4>
                            
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="<?=$res['nome']?>"
                                    required>
                                </div>
                              
                            </div>

                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Usuário:*</label>
                                    <input id="nome" name="user" class="w-100" type="text" placeholder="<?=$res['usuario']?>"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Creci:*</label>
                                    <input id="nome" name="creci" class="w-100" type="text" placeholder="<?=$res['creci']?>"
                                    required>
                                </div>
                            </div>
                            <h4>- Trocar senha</h4>
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
                            </div>
                            <h4>- Trocar email</h4>
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Email:*</label>
                                    <input id="nome" name="email" class="w-100" type="email" placeholder="<?=$res['email']?>"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Email:*</label>
                                    <input id="nome" name="email2" class="w-100" type="email" placeholder="Confirmar Email"
                                    required>
                                </div>
                            </div>
                            
                        </section>
                        <div>
                            
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Salvar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='../../menu.php'><!--javascript:self.history.back();-->
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