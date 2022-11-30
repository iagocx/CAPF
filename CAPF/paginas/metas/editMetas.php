<?php session_start(); ?>

<?php
// including the database connection file
include_once("../../conexao.php");
$nome1 = $_GET['nome1'];

if(isset($_POST['update'])){	
	$meta = $_POST['meta'];
	$id = $_GET['id'];
    
	// checking empty fields		
	if(empty($meta)) {
		echo "<font color='red'>Name field is empty.</font><br/>";
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE kpi SET valorMeta='$meta' WHERE id_kpi='$id'");	
		//redirectig to the display page. In our case, it is view.php
		header("Location: viewMetas.php");
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Editar Metas dos KPI's</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
<!-- Sesão Formulário-->
<section id="formulario" class="section-content-row" >
        
         <!-- Conteudo dos boxs -->
            <div class="container">
                <div class="form-container"> 
                    <!-- Titulo da sessão -->
                    <div class="title-section2">
                        <span class="sub-title2">
                            Editar Metas
                        </span>
                    </div> 
                <!-- Formulario -->
                <form id="formAero" name="form1" action="" method="post">
                    <div class="title-section">
                        <span class="sub-title">KPI:
                            <?php echo "<span>".$nome1."</span>"; ?>
                        </span>
                    </div>  
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações das metas dos KPI's</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Valor da Meta:*</label>
                                    <input id="nome" name="meta" class="w-100" type="text" placeholder="Informe o valor da meta"
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
                            <a href='./viewMetas.php'><!--javascript:self.history.back();-->
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