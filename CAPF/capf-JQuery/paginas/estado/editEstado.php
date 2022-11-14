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

    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, "SELECT * FROM regiaobrasil ORDER BY nome");

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $sigla = $_POST['sigla'];
        $idregiao = $_POST['idregiao'];
        $id = $_GET['id'];

        if($name == "" || $sigla == "" || $idregiao == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        }else {
            $cpf = $_SESSION['cpf'];
            //updating the table
		   
            mysqli_query($mysqli, "UPDATE estado SET nome='$name', sigla='$sigla', Adm_Usuario_cpf='$cpf', RegiaoBrasil_id_RegiaoBrasil1='$idregiao') WHERE id_estado='$id'")
                or die("Could not execute the insert query.");
            header('Location: ./viewEstado.php');   
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
                            <span>estados</span>
                            do Brasil
                        </span>
                    <!-- <h2>Cadastra-se Agora</h2>-->
                    </div>
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações dos Estados do Brasil</h4>
                            <div class="doisfr">

                                <div class="form-area  form-col">
                                    <label for="nome">Nome do Estado:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome do estado do Brasil"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Sigla:*</label>
                                    <input id="nome" name="sigla" class="w-100" type="text" placeholder="Informe a sigla do estado"
                                    required>
                                </div>
                                <div class="form-area form-col">
                                    <label for="bairro">Região:*</label>
                                    <select  id="estado" class="w-100" name="idregiao" required>
                                        <option selected="true" disabled="disabled">Selecio uma Região para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	
                                            
                                            $nome1 = $res['nome'];
                                            echo "<option value ='.$nome1.' >".$nome1."</option>";
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
                            <a href='./viewEstado.php'>
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