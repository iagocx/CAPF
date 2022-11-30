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

    //Pegar lista de estados
    $result = mysqli_query($mysqli, "SELECT * FROM estado ORDER BY nome");

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $idestado = $_POST['idestado'];

        if($name == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } else {
            $cpf = $_SESSION['cpf'];
            mysqli_query($mysqli, "INSERT INTO cidade(id_cidade, nome, Adm_Usuario_cpf, Estado_id_estado1 ) VALUES('', '$name', '$cpf', '$idestado')")
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

                    <div class="title-section2">
                        <span class="sub-title2">
                            Adicionar Cidades
                        </span>
                    </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações das cidades do Brasil</h4>
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome do cidade:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome da cidade do Brasil"
                                    required>
                                </div>
                                <div class="form-area form-col">
                                    <label for="bairro">Estado:*</label>
                                    <select  id="estado" class="w-100" name="idregiao" required>
                                        <option selected="true" disabled="disabled">Selecio uma Estado para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	
                                            $nome = $res['nome'];
                                            $idestado = $res['id_estado'];
                                            echo "<option value ='.$idestado.' >".$nome."</option>";
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
                            <a href='./viewCidade.php'><!--javascript:self.history.back();-->
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