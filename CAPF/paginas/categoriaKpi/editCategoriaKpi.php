<?php session_start(); ?>

<?php
// including the database connection file
include_once("../../conexao.php");

$id = $_GET['id'];//id categoria
$nome = $_GET['nome'];//nome categoria
$tipo = $_SESSION['tipo'];//tipo de ussuario

if($tipo == 2){
    $id2 = $_GET['id2'];//id do franqueado
    $nome2 = $_GET['nome2'];//nome da MF
}elseif($tipo == 1){
    $id1 = $_GET['id1'];
    $nome1 = $_GET['nome1'];
}

              
if(isset($_POST['update'])){	
	$name = $_POST['name'];
    		
	if(empty($name)) {
		echo "O Campo de categoria está vazio.";
    }elseif($tipo == 1){
        $result = mysqli_query($mysqli, 
        "UPDATE categoriaKpi 
        SET nome='$name',MasterFranquia_Franqueado_id_franqueado='$id1' 
        WHERE id_categoria='$id'");	

         header("Location: viewCategoriaKpi.php");
    }elseif($tipo == 2){
        $result = mysqli_query($mysqli, 
        "UPDATE categoriaKpi 
        SET nome='$name',MasterFranquia_Franqueado_id_franqueado='$id2' 
        WHERE id_categoria='$id'");	

         header("Location: viewCategoriaKpi.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Edit Categorias de Kpi's</title>
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
                    <!-- Titulo da sessão -->
                   
                    <div class="title-section2">
                        <span class="sub-title2">
                           Editar Categorias de KPI's
                        </span>
                    </div>       
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post">   
                        <div class="title-section">
                            <span class="sub-title">
                            Dados referentes:    
                            <br>-Categoria:   
                                <?php echo "<span>".$nome."</span>"; ?>
                                <?php if($tipo == 2){ ?>
                                    <br>-Master Franquia:
                                    <?php echo "<span>".$nome2."</span>"; ?>
                                <?php }elseif(tipo == 1){?>
                                    <br>-Master Franquia:
                                    <?php echo "<span>".$nome1."</span>"; ?>
                                <?php }?>
                            </span>
                        </div>
                    
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Editar informações da Categoria de KPI:</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Categoria:*</label>
                                    <input id="nome" name="name" class="w-100" type="text" placeholder="Informe o nome da categoria de KPI"
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
                            <a href='./viewCategoriaKpi.php'><!--javascript:self.history.back();-->
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