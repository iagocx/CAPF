<?php session_start(); ?>

<?php
// including the database connection file
include_once("../../conexao.php");

if(isset($_POST['update'])){	
	$name = $_POST['name'];
	$id = $_GET['id'];
	// checking empty fields		
	if(empty($name)) {
		echo "<font color='red'>Name field is empty.</font><br/>";
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE regiaoBrasil SET nome='$name' WHERE id_regiaobrasil='$id'");	
		//redirectig to the display page. In our case, it is view.php
		header("Location: viewRegiaobrasil.php");
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link href="../../estilos/menu.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Edit Regiões do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
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
                            <button class="btn-clean btn-submit" type="submit" name="update">Enviar</button>
                            
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='./viewRegiaoBrasil.php'><!--javascript:self.history.back();-->
                                <button class="btn-clean btn-submit" type="submit">Voltar</button>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</body>
</html>