<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Estados do Brasil</title>
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

        if($name == "" || $sigla == "" || $idregiao == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        }else {
            $cpf = $_SESSION['cpf'];
            mysqli_query($mysqli, "INSERT INTO estado(id_estado, nome, sigla, Adm_Usuario_cpf, RegiaoBrasil_id_RegiaoBrasil1) VALUES('', '$name','$sigla', '$cpf','$idregiao')")
                or die("Could not execute the insert query.");
            header('Location: ./viewEstado.php');   
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
                            Adicionar Estados
                        </span>
                    </div>  
                    <!-- Titulo da sessão -->
                    
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações dos Estados do Brasil</h4>
                            <div class="tresfr">
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
                                            $nomereg = $res['nome'];
                                            $idregiao = $res['id_RegiaoBrasil'];
                                            echo "<option value ='.$idregiao.' >".$nomereg."</option>";
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