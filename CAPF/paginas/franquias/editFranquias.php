<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Franquias</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");
    $tipo = $_SESSION['tipo'];
    $idF = $_GET['id'];
    $nomeF = $_GET['nomeF'];
    $nomeR = $_GET['nomeR'];
    $nomeMF = $_GET['nomeMF'];


    if(isset($_POST['submit'])) {
        $namef = $_POST['namef'];
        $namer = $_POST['namer'];
        $namet = $_POST['namet'];
        $creci = $_POST['creci'];
        $end = $_POST['end'];
        $num = $_POST['num'];
        $cep = $_POST['cep'];
        $telf = $_POST['telf'];
        $telr = $_POST['telr'];
        $email = $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $whatsapp = $_POST['whatsapp'];
        $datao = $_POST['datao'];
        $datai = $_POST['datai'];
        $incm = $_POST['incm'];
        
       
        if($tipo == 1){
            $mfa = $_POST['mfa'];//id master franquia associada
        }

        if($namef == "" ) {
            echo "Campo nome franquia deve estar preenchido. Either one or many fields are empty.";
        }elseif($tipo == 1 && $mfa != ""){
 /*           mysqli_query($mysqli, 
            "INSERT INTO franqueado(id_franqueado, nome_responsavel, nome_franquia, numero, endereco, tel_franquia, tel_responsavel, cep) 
            VALUES('', '$namer','$namef', '$num', '$end', '$telf', '$telr', '$cep')")
                or die("Could not execute the insert query.");
            
            $result6 = mysqli_query($mysqli, "SELECT * FROM franqueado WHERE nome_franquia='$namef'");
            $res6 = mysqli_fetch_array($result6);
            $aux6 = $res6['id_franqueado'];

            mysqli_query($mysqli, 
            "INSERT INTO franquia(Franqueado_id_franqueado , creciRespTec, nomeRespTec, cnpj, email, whatsapp, data_operacao, data_inauguracao, incMunicipal, MasterFranquia_Franqueado_id_franqueado, RegiaoFranquia_id_RegiaoFranquiacol, UsuarioFranqueado_Usuario_cpf) 
            VALUES('$aux6', '$creci', '$namet', '$cnpj', '$email', '$whatsapp', '$datao', '$datai', '$incm', '$mfa', '$idregfranq', '$uf')")
                or die("Could not execute the insert query.");
            header('Location: ./viewFranquias.php');   
            echo "Registration successfully";
            echo "<br/>";
*/
        }elseif($tipo == 2){
            $cpf = $_SESSION['cpf'];

            $result = mysqli_query($mysqli, 
            "UPDATE franqueado
             SET nome_responsavel='$namer', nome_franquia='$namef', numero='$num', endereco='$end', 
             tel_franquia='$telf', tel_responsavel='$telr', cep='$cep'
             WHERE id_franqueado='$idF'");
            
            mysqli_query($mysqli, 
            "UPDATE franquia 
            SET creciRespTec='$creci', nomeRespTec='$namet', cnpj='$cnpj', email='$email',
             whatsapp='$whatsapp', data_operacao='$datao', data_inauguracao='$datai', incMunicipal='$incm'
            WHERE Franqueado_id_franqueado='$idF'");
  
            header('Location: ./viewFranquias.php');   
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
                     <!-- Formulario -->
                     <div class="title-section2">
                        <span class="sub-title2">
                            Editar Franquias
                        </span>
                    </div> 
                    <form id="formAero" name="form1" action="" method="post">
                        <section id="etapa-1" class="formulario-etapas">
                        <!-- Titulo da sessão -->
                            <div class="title-section">
                                <span class="sub-title">Dados referentes:
                                    <br>-Master Franquia:
                                    <?php echo "<span>".$nomeMF."</span>"; ?>
                                    <br>-Região da Franquia:
                                    <?php echo "<span>".$nomeR."</span>"; ?>
                                    <br>-Franquia:
                                    <?php echo "<span>".$nomeF."</span>"; ?>
                                </span>
                            </div>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome franquia:*</label>
                                    <input id="nome" name="namef" class="w-100" type="text" placeholder="Informe o nome do responsável da franquia"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Franqueado responsável:</label>
                                    <input id="nome" name="namer" class="w-100" type="text" placeholder="Informe o nome do franqueado responsável">
                                </div>
                            </div>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Responsável técnico:</label>
                                    <input id="nome" name="namet" class="w-100" type="text" placeholder="Informe o nome do responsável técnico">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">CRECI do responsável técnico:</label>
                                    <input id="nome" name="creci" class="w-100" type="text" placeholder="Informe o CRECI do responsável técnico">
                                </div> 
                            </div>
                            
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Endereço:</label>
                                    <input id="nome" name="end" class="w-100" type="text" placeholder="Informe o endereço da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Número:</label>
                                    <input id="nome" name="num" class="w-100" type="text" placeholder="Informe o número da franquia">
                                </div>
                            </div>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">CEP:</label>
                                    <input id="nome" name="cep" class="w-100" type="text" placeholder="Informe o número do CEP">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Telefone Franquia:</label>
                                    <input id="nome" name="telf" class="w-100" type="text" placeholder="Informe o telefone da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Telefone Responsável:</label>
                                    <input id="nome" name="telr" class="w-100" type="text" placeholder="Informe o telefone do responsável">
                                </div>
                            </div>
                               
                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Email:</label>
                                    <input id="nome" name="email" class="w-100" type="text" placeholder="Informe o email da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">CNPJ:</label>
                                    <input id="nome" name="cnpj" class="w-100" type="text" placeholder="Informe o CNPJ da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">whatsapp:</label>
                                    <input id="nome" name="whatsapp" class="w-100" type="text" placeholder="Informe o whatsapp da franquia">
                                </div>
                            </div>
                            
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Data de início de Operação:</label>
                                    <input id="nome" name="datao" class="w-100" type="date" placeholder="Informe a data da operação">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Data da inauguração:</label>
                                    <input id="nome" name="datai" class="w-100" type="date" placeholder="Informe a data da inauguração da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Inclusão municipal:</label>
                                    <input id="nome" name="incm" class="w-100" type="text" placeholder="Informe o número de inclusão municipal">
                                </div>
                            </div>
                        </section>
                        <div>   
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                        <div class="link-inc">
                            <a href='./viewFranquias.php'>
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