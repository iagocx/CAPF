<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Listas Registros de KPI</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");
    $idkpi = $_GET['id'];
    $idfran = $_GET['id1'];
    $nomefran = $_GET['nome1'];
    $nomecat = $_GET['nome2'];
    $datareg = $_GET['datareg'];
    //$dataMesAno = new DateTime($datareg);
    //echo $datareg;
    //echo $dataMesAno;
    $dataref = $_GET['dataref'];
    $nomemf = $_GET['nomemf'];
    $meta = $_GET['meta'];
    $case = $_GET['case'];
    $cpf = $_SESSION['cpf'];
    

    //echo date_format($dataref, 'd-m-Y');
    //echo "<br>Data de referencia: ".$dataref;
    //echo "<br>Data de registro: ".$datareg;

    if(isset($_POST['submit'])) {
        if($case == 3){
            $valor = $_POST['valor'];

            if($valor == "" ) {
                echo "O campo valor está vazio. Eles deve ser preenchido";
            }else {
                $cpf = $_SESSION['cpf'];
                mysqli_query($mysqli, 
                "INSERT INTO registrokpi
                VALUES('', '$dataref','$datareg', '', 'R', '$valor', '$meta', '$idkpi', '$cpf', '$idfran')")
                    or die("Could not execute the insert query.");
                
                    header('Location: ./viewRegistrarKpi.php');   
                echo "Registration successfully";
                echo "<br/>";
            } 
        }elseif($case == 1){//status == R
            $valor = $_POST['valor'];
            $idreg = $_GET['idreg'];

            if($valor == "" ) {
                echo "O campo valor está vazio. Eles deve ser preenchido";
            }else {
                $cpf = $_SESSION['cpf'];
                mysqli_query($mysqli, 
                "UPDATE registrokpi
                SET dataRegistro='$datareg', valorRegistro='$valor'
                WHERE id_registro='$idreg'")
                    or die("Could not execute the insert query.");
                
                    header('Location: ./viewRegistrarKpi.php');   
                echo "Registration successfully";
                echo "<br/>";
            } 
        }elseif($case == 2){//status vazio e possui algum registro
    
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
                            Registrar Kpi
                        </span>
                    </div> 
                    <form id="formAero" name="form1" action="" method="post">
                        <div class="title-section">
                            <span class="sub-title">
                                -Master Franquia:
                                <?php echo "<span>".$nomemf."</span>";?>
                                <br>-Nome Franquia: 
                                <?php echo "<span>".$nomefran."</span>";?>
                                <br>-Categoria:
                                <?php echo "<span>".$nomecat."</span>";?>
                                <br>-Data de referência:
                                <?php echo "<span>".$dataref."</span>";?>
                                <br>-Data de registro:   
                                <?php echo "<span>".$datareg."</span>";?>  
                            </span>
                        </div>
                    <!-- Formulario -->
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações do Kpi</h4>
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Valor:*</label>
                                    <input id="nome" name="valor" class="w-100" type="text" placeholder="Informe o valor do KPI"
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
                            <a href='./viewRegistrarKpi.php'>
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