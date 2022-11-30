<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
//$result2 = mysqli_query($mysqli, "SELECT * FROM masterfranquia ORDER BY Franqueado_id_franqueado");

$result = mysqli_query($mysqli, 
"SELECT * FROM franqueado
WHERE id_franqueado IN 
    (SELECT Franqueado_id_franqueado   
     FROM masterfranquia)");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Master Franquias do Brasil</title>
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
                    Master Franqueados
                </span>
            </div> 
            <div class="conteudo">
                <!-- Titulo da sessão -->
                <div class="title-section">
                    <span class="sub-title">
                        Lista de <span>Master Franqueados:</span> 
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Usuário Master Franqueado</th>
                            <th>Região Master franqueada</th>
                            <th>Nome Master Franquia</th>
                            <th>Nome do Responsável</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>Telefone Franquia</th>
                            <th>Telefone Responsável</th>
                            <th>CEP</th>
                            <th>Editar</th>  
                            <th>Excluir</th>        
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {	
                                $idfran = $res['id_franqueado'];
                                $result1 = mysqli_query($mysqli, "SELECT * FROM masterfranquia WHERE Franqueado_id_franqueado ='$idfran'");
                                $res1 = mysqli_fetch_array($result1);
                                $aux1 = $res1['UsuarioMasterFranqueado_Usuario_cpf'];
                                
                                $result2 = mysqli_query($mysqli, "SELECT * FROM usuario WHERE cpf='$aux1'");
                                $res2 = mysqli_fetch_array($result2);

                                $aux2 = $res1['RegiaoFranquia_id_RegiaoFranquiacol'];
                                $result3 = mysqli_query($mysqli, 
                                "SELECT * FROM regiaofranquia 
                                WHERE id_RegiaoFranquiacol='$aux2'");
                                $res3 = mysqli_fetch_array($result3);

                                echo "<tr>";
                                echo "<td>".$res2['nome']."</td>";
                                echo "<td>".$res3['nome']."</td>";
                                echo "<td>".$res['nome_franquia']."</td>";
                                echo "<td>".$res['nome_responsavel']."</td>";
                                echo "<td>".$res['endereco']."</td>";
                                echo "<td>".$res['numero']."</td>";
                                echo "<td>".$res['tel_franquia']."</td>";
                                echo "<td>".$res['tel_responsavel']."</td>";
                                echo "<td>".$res['cep']."</td>";
                                echo "<td><a href=\"editMasterFranqueado.php?id=$res[id_franqueado]&&nome1=$res[nome_franquia]&&idu=$res2[cpf]&&idr=$res3[id_RegiaoFranquiacol][nome_franquia]\">Edit</a></td>";
                                echo "<td><a href=\"delMasterFranqueado.php?id=$res[id_franqueado]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                <a href="./addMasterFranqueado.php">
                    <button class="btn-clean btn-submit" type="submit">Incluir</button>
                </a>
                <a href='../../menu.php'>
                    <button class="btn-clean btn-submit" type="submit">Voltar</button>
                </a>
                </div> 
            </div> 
        </div>
    </section>
</body>
</html>