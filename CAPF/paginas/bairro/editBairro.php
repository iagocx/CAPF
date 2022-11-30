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

    //Pegar lista de cidades
    $result = mysqli_query($mysqli, "SELECT * FROM cidade ORDER BY nome");
    $id = $_GET['id'];
    $nomebairro = $_GET['nom'];

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];//nome do bairro
        $idcidade = $_POST['cidadeid'];//id da cidade escolhida para substituir
        

        if($name == "" || $idcidade == "") {
            echo "All fields should be filled. Either one or many fields are empty.";
        } else {
            $cpf = $_SESSION['cpf'];
            mysqli_query($mysqli, "UPDATE bairro SET nome='$name', Cidade_id_cidade1='$idcidade' WHERE id_bairro='$id'")
                or die("Could not execute the insert query.");
            header('Location: ./viewBairro.php');   
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
                            Editar Bairros
                        </span>
                     </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">
                    <!-- Titulo da sessão -->
                        <div class="title-section">
                            <span class="sub-title">Dados referentes:
                                <br>-Bairro:
                                <?php echo "<span>".$nomebairro."</span>"; ?>
                                
                            </span>
                        </div>
                    
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações dos Bairros do Brasil</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome do Bairro:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome da Região do Brasil"
                                    required>
                                </div>
                                <div class="form-area form-col">
                                    <label for="bairro">Cidade:*</label>
                                    <select  id="estado" class="w-100" name="cidadeid" required>
                                        <option selected="true" disabled="disabled">Selecionar uma cidade para Associar</option>
                                        <?php
                                        while($res = mysqli_fetch_array($result)) {	//tabela cidade
                                            $nomecid = $res['nome'];
                                            $idcid = $res['id_cidade'];
                                            echo "<option value ='$idcid' >".$nomecid."</option>";
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
                            <a href='./viewBairro.php'><!--javascript:self.history.back();-->
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