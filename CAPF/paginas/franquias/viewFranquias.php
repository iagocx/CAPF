<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)	
    $result = mysqli_query($mysqli, 
    "SELECT * FROM franqueado
     WHERE id_franqueado IN 
        (SELECT franqueado_id_franqueado   
        FROM franquia)");



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Franqueados</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
             <div class="title-section2">
                <span class="sub-title2">
                     Franquias
                </span>
            </div> 
            <div class="conteudo">
                <!-- Titulo da sessão -->
                <div class="title-section">
                    <span class="sub-title">
                        Lista de <span>Franquias</span> 
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Master franquia associada</th>
                            <th>Usuário Franqueado</th>
                            <th>Região</th>
                            <th>Nome da Franquia</th>
                            <th>Franqueado Responsável</th>
                            <th>Responsável Técnico</th>
                            <th>CRECI do responsável técnico</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>tel_franquia</th>
                            <th>tel_responsável</th>
                            <th>CEP</th>
                            <th>CNPJ</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Início de operação</th>
                            <th>Inauguração</th>
                            <th>Inclusão Municipal</th>
                            <th>Alterar</th>
                            <th>Inscrição Municipal</th>
                        </tr>
                        <?php

                            while($res = mysqli_fetch_array($result)) {
                                $aux1 = $res['id_franqueado'];//id_franqueado da tabela franqueado
                                
                                $result1 = mysqli_query($mysqli, 
                                "SELECT * FROM franquia WHERE franqueado_id_franqueado='$aux1'");
                                $res1 = mysqli_fetch_array($result1);//tabela franquia
                                $aux2 = $res1['UsuarioFranqueado_Usuario_cpf'];
                                $aux3 = $res1['RegiaoFranquia_id_RegiaoFranquiacol'];
                                $aux4 = $res1['MasterFranquia_Franqueado_id_franqueado'];

                                $result5 = mysqli_query($mysqli, 
                                "SELECT * FROM masterfranquia 
                                WHERE Franqueado_id_franqueado='$aux4'");
                                $res5 = mysqli_fetch_array($result5);
                                $aux5 = $res5['Franqueado_id_franqueado'];

                                $result6 = mysqli_query($mysqli, 
                                "SELECT * FROM franqueado 
                                WHERE id_franqueado='$aux5'");
                                $res6 = mysqli_fetch_array($result6);

                                $result3 = mysqli_query($mysqli, 
                                "SELECT * FROM usuario
                                WHERE cpf='$aux2'");
                                $res3 = mysqli_fetch_array($result3);

                                $result4 = mysqli_query($mysqli, 
                                "SELECT * FROM regiaofranquia
                                WHERE id_RegiaoFranquiacol='$aux3'");
                                $res4 = mysqli_fetch_array($result4);

                                echo "<tr>";
                                echo "<td>".$res6['nome_franquia']."</td>";
                                echo "<td>".$res3['nome']."</td>";
                                echo "<td>".$res4['nome']."</td>";
                                echo "<td>".$res['nome_franquia']."</td>";
                                echo "<td>".$res['nome_responsavel']."</td>";
                                echo "<td>".$res1['nomeRespTec']."</td>";                           
                                echo "<td>".$res1['creciRespTec']."</td>";
                                echo "<td>".$res['endereco']."</td>";
                                echo "<td>".$res['numero']."</td>";             
                                echo "<td>".$res['tel_franquia']."</td>";
                                echo "<td>".$res['tel_responsavel']."</td>";
                                echo "<td>".$res['cep']."</td>";              
                                echo "<td>".$res1['cnpj']."</td>";
                                echo "<td>".$res1['email']."</td>";
                                echo "<td>".$res1['whatsapp']."</td>";
                                echo "<td>".$res1['data_operacao']."</td>";
                                echo "<td>".$res1['data_inauguracao']."</td>";
                                echo "<td>".$res1['incMunicipal']."</td>";
                                echo "<td><a href=\"editFranquias.php?id=$res[id_franqueado]&&nomeMF=$res6[nome_franquia]&&nomeF=$res[nome_franquia]&&nomeR=$res4[nome]\">Edit</a></td>";
                                echo "<td><a href=\"delFranquias.php?id=$res[id_franqueado]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href="./addFranquias.php">
                        <button class="btn-clean btn-submit" type="submit">Incluir</button>
                    </a>
                    <a href='../../menu.php'>
                        <button class="btn-clean btn-submit" type="submit">Salvar</button>
                    </a>
                </div>  
            </div>
    </section>
</body>
</html>