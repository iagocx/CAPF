<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Include Franquias</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
    <script>
        function testaSelect(){
            var nomeF = form1.namef;
            var idR = form1.idregfranq;
            var UF = form1.uf;
            if(nomeF.selectedIndex==0){        
                alert("Campo Região Franquia é obrigatório.");
                nomeF.focus();
                return false;
            }
            if(idR.selectedIndex==0){
                alert("Campo Nome Franquia é obrigatório.");
                idR.focus();
                return false;
            }
            if(UF.selectedIndex==0){ 
                alert("Campo Usuário Franquia é obrigatório.");
                UF.focus();
                return false;
            }
        }
    </script>
</head> 

<body>
    <?php
    include("../../conexao.php");

    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
     WHERE id_franqueado IN 
        (SELECT franqueado_id_franqueado   
        FROM franquia)");

    $result1 = mysqli_query($mysqli, "SELECT * FROM regiaofranquia");
    
    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM usuario
    WHERE tipo=3 and cpf NOT IN 
        (SELECT UsuarioFranqueado_Usuario_cpf    
         FROM franquia)");

    $result3 = mysqli_query($mysqli, "SELECT * FROM masterfranquia");

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
        $idregfranq = $_POST['idregfranq'];//id regiao franquia
        $uf = $_POST['uf'];//id usuario franquia
        if($_SESSION['tipo'] == 1){
            $mfa = $_POST['mfa'];//id master franquia associada
        }

        if($namef == "" || $idregfranq == "" || $uf == "" ) {
            echo "Campo nome franquia deve estar preenchido. Either one or many fields are empty.";
        }elseif($_SESSION['tipo'] == 1 && $mfa != ""){
            mysqli_query($mysqli, 
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

        }elseif($_SESSION['tipo'] == 2){
            $cpf = $_SESSION['cpf'];

            $result4 = mysqli_query($mysqli, 
            "SELECT * FROM masterfranquia WHERE UsuarioMasterFranqueado_Usuario_cpf ='$cpf'");
            $res4 = mysqli_fetch_array($result4);//master franquia associada
            $aux4 = $res4['Franqueado_id_franqueado'];

            mysqli_query($mysqli, 
            "INSERT INTO franqueado(id_franqueado, nome_responsavel, nome_franquia, numero, endereco, tel_franquia, tel_responsavel, cep) 
            VALUES('', '$namer','$namef', '$num', '$end', '$telf', '$telr', '$cep')")
                or die("Could not execute the insert query.");
            
            $result5 = mysqli_query($mysqli, "SELECT * FROM franqueado WHERE nomef='$namef'");
            $aux5 = $res5['id_franqueado'];

            mysqli_query($mysqli, 
            "INSERT INTO franquia(Franqueado_id_franqueado , creciRespTec, nomeRespTec, cnpj, email, whatsapp, data_operacao, data_inauguracao, incMunicipal, MasterFranquia_Franqueado_id_franqueado, RegiaoFranquia_id_RegiaoFranquiacol, UsuarioFranqueado_Usuario_cpf) 
            VALUES('$aux5', '$creci','$nomet', '$cnpj','$email', '$whatsapp', '$datao', '$datai', '$incm', '$aux4', '$idregfranq', '$uf')")
                or die("Could not execute the insert query.");
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
                    <!-- Titulo da sessão -->
                    <div class="title-section2">
                        <span class="sub-title2">
                            Adicionar Franquias
                        </span>
                    </div> 
                    <!-- Formulario -->
                    <form id="formAero" name="form1" action="" method="post" onSubmit="return testaSelect();" >
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações da franquia </h4>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome franquia:*</label>
                                    <input name="namef" class="w-100" type="text" placeholder="Informe o nome do responsável da franquia">
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

                            <div class="tresfr">
                                <div class="form-area form-col">
                                    <label for="regiaofranquia">Região Franquia:*</label>
                                    <select  id="estado" class="w-100" name="idregfranq">
                                        <option selected="true" disabled="disabled">Selecione uma região franquia para Associar</option>
                                        <?php
                                        while($res1 = mysqli_fetch_array($result1)) {//tabela MF 2 resgistros
                                            $idrf= $res1['id_RegiaoFranquiacol'];
                                            $nomerf = $res1['nome'];
                                            echo "<option value ='.$idrf.'>".$nomerf."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <div class="form-area form-col">
                                    <label for="masterfranquia">Usuário Franquia:*</label>
                                    <select id="estado" class="w-100" name="uf">
                                        <option selected="true" disabled="disabled" >Selecione um usuário franquia para associar</option>
                                        <?php
                                        while($res2 = mysqli_fetch_array($result2)) {//tabela MF 2 resgistros
                                            $cpfu= $res2['cpf'];
                                            $nomeu = $res2['nome'];
                                            echo "<option value ='.$cpfu.'>".$nomeu."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <?php if ($_SESSION['tipo'] == 1): ?>
                                <div class="form-area form-col">
                                    <label for="regiaofranquia">Master Franquia Associada:*</label>
                                    <select  id="estado" class="w-100" name="mfa" required>
                                        <option selected="true" disabled="disabled">Selecione uma Master franquia para Associar</option>
                                        <?php
                                        while($res3 = mysqli_fetch_array($result3)) {//tabela MF 2 resgistros
                                            $aux1 = $res3['Franqueado_id_franqueado'];
                                            
                                            $result4 = mysqli_query($mysqli, 
                                            "SELECT * FROM franqueado
                                            WHERE id_franqueado='$aux1'");
                                            $res4 = mysqli_fetch_array($result4);

                                            $idmf= $res4['id_franqueado'];
                                            $nomemf = $res4['nome_franquia'];
                                            echo "<option value ='.$idmf.'>".$nomemf."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <?php endif; ?>   
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