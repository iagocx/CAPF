<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Editar MasterFranqueados</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <?php
    include("../../conexao.php");
    
    $result1 = mysqli_query($mysqli, 
    "SELECT * FROM usuario
    WHERE tipo=2 and cpf NOT IN 
        (SELECT UsuarioMasterFranqueado_Usuario_cpf   
         FROM masterfranquia)");
   
    $result2 = mysqli_query($mysqli, 
    "SELECT * FROM regiaofranquia
    WHERE id_regiaofranquiacol NOT IN 
        (SELECT RegiaoFranquia_id_RegiaoFranquiacol  
         FROM masterfranquia)");
    
    $id = $_GET['id'];
    $nome1 = $_GET['nome1'];
    $idu = $_GET['idu'];
    $idr = $_GET['idr'];

    if(isset($_POST['submit'])) {
        $nomer = $_POST['nome_responsavel'];
        $nomef = $_POST['nome_franquia'];
        $end = $_POST['endereco'];
        $numero = $_POST['numero'];
        $telf = $_POST['tel_franquia'];
        $telr = $_POST['tel_responsavel'];
        $cep = $_POST['cep'];
        $idusu2 = $_POST['umf'];
        $regfran = $_POST['regfranq'];
        
        if($nomer==""||$nomef=="") {  
            echo "Campos nome da franquia, nome do responsável, usuários master franqueado e região da franquia devem ser preenchidos. Um ou mais campos estão vazios.";
        } else {
            
            if($idusu2==""&&$regfran==""){    
                mysqli_query($mysqli, 
                "UPDATE franqueado 
                SET nome_responsavel='$nomer', nome_franquia='$nomef', numero='$numero', endereco='$end', tel_franquia='$telf', tel_responsavel='$telr', cep='$cep'
                WHERE id_franqueado='$id'"); 

                header('Location: ./viewMasterFranqueado.php');   
                echo "Registration successfully";
                echo "<br/>";
            }elseif($idusu2=""){
                mysqli_query($mysqli, 
                "UPDATE franqueado 
                SET nome_responsavel='$nomer', nome_franquia='$nomef', numero='$numero', endereco='$end', tel_franquia='$telf', tel_responsavel='$telr', cep='$cep'
                WHERE id_franqueado='$id'");   

                mysqli_query($mysqli, 
                "UPDATE masterfranquia 
                SET RegiaoFranquia_id_RegiaoFranquiacol ='$regfran'
                WHERE Franqueado_id_franqueado='$id'");

                header('Location: ./viewMasterFranqueado.php');   
                echo "Registration successfully";
                echo "<br/>";
            }elseif($regfran==""){
                mysqli_query($mysqli, 
                "UPDATE masterfranquia 
                SET UsuarioMasterFranqueado_Usuario_cpf='$idusu2'
                WHERE Franqueado_id_franqueado='$id'");

                header('Location: ./viewMasterFranqueado.php');   
                echo "Registration successfully";
                echo "<br/>";
            }
            else{
                mysqli_query($mysqli, 
                "UPDATE franqueado 
                SET nome_responsavel='$nomer', nome_franquia='$nomef', numero='$numero', endereco='$end', tel_franquia='$telf', tel_responsavel='$telr', cep='$cep'
                WHERE id_franqueado='$id'");
                
                mysqli_query($mysqli, 
                "UPDATE masterfranquia 
                SET  RegiaoFranquia_id_RegiaoFranquiacol ='$regfran', UsuarioMasterFranqueado_Usuario_cpf='$idusu2'
                WHERE Franqueado_id_franqueado='$id'");

                header('Location: ./viewMasterFranqueado.php');   
                echo "Registration successfully";
                echo "<br/>";
            }
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
                            Editar Master Franquia
                        </span>
                    </div> 
                    <!-- Titulo da sessão -->
                    <form id="formAero" name="form1" action="" method="post">
                        <div class="title-section">
                            <span class="sub-title">Dados referentes:
                                <br>-Franquia: 
                                <?php 
                                echo "<span>" .$nome1."</span>"; ?>
                            </span>
                        </div>
                 
                    <!-- Formulario -->
                    
                        <section id="etapa-1" class="formulario-etapas">
                            <h4>- Preencha as informações de cadastro da Master franquia</h4>
                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Nome do Responsável:*</label>
                                    <input id="nome" name="nome_responsavel" class="w-100" type="text" placeholder="Informe o nome do responsável"
                                    required>
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Nome da franquia:*</label>
                                    <input id="nome" name="nome_franquia" class="w-100" type="text" placeholder="Informe o nome da franquia"
                                    required>
                                </div>                            
                            </div>
                            
                            <div class="tresfr">
                                <div class="form-area form-col">
                                    <label for="masterfranquia">Usuário Master Franquia:*</label>
                                    <select  id="estado" class="w-100" name="umf" required>
                                        <option selected="true" disabled="disabled">Selecio uma usuário MF para Associar</option>
                                        <?php
                                        while($res1 = mysqli_fetch_array($result1)) {//tabela MF 2 resgistros
                                            $cpfu= $res1['cpf'];
                                            $nomeu = $res1['nome'];
                                            echo "<option value ='.$cpfu.'>".$nomeu."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                                <div class="form-area form-col">
                                    <label for="regiaofranquia">Região Franquia:*</label>
                                    <select  id="estado" class="w-100" name="regfranq" required>
                                        <option selected="true" disabled="disabled">Selecio uma região franquia para Associar</option>
                                        <?php
                                        while($res4 = mysqli_fetch_array($result2)) {//tabela MF 2 resgistros
                                            $idrf= $res4['id_RegiaoFranquiacol'];
                                            $nomerf = $res4['nome'];
                                            echo "<option value ='.$idrf.'>".$nomerf."</option>";
                                        }
                                        ?>                    
                                    </select>
                                </div>
                            </div>

                            <div class="doisfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Endereço:</label>
                                    <input id="nome" name="endereco" class="w-100" type="text" placeholder="Informe o endereço">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Número:</label>
                                    <input id="nome" name="numero" class="w-100" type="text" placeholder="Informe o número do endereço">
                                </div>
                            </div>

                            <div class="tresfr">
                                <div class="form-area  form-col">
                                    <label for="nome">Telefone:</label>
                                    <input id="nome" name="tel_franquia" class="w-100" type="text" placeholder="Informe o telefone da franquia">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">Telefone:</label>
                                    <input id="nome" name="tel_responsavel" class="w-100" type="text" placeholder="Informe o telefone do responsável">
                                </div>
                                <div class="form-area  form-col">
                                    <label for="nome">CEP:</label>
                                    <input id="nome" name="cep" class="w-100" type="text" placeholder="Informe o CEP">
                                </div>
                            </div>
                        </section>
                        
                        <div>  
                            <button class="btn-form btn-outilne" type="reset" etapa_numero="2">Limpar</button>
                            <button class="btn-clean btn-submit" type="submit" name="submit">Enviar</button>
                        </div>
                    </form>
                    <div class="link-inc">
                        <a href='./viewMasterFranqueado.php'><!--javascript:self.history.back();-->
                            <button class="btn-clean btn-submit" type="submit" >Voltar</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>