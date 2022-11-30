<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM usuario where tipo='2' ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões do Brasil</title>
    <script src="../../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
<?php include '../../menuSub.php';?>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
            <!-- Titulo da sessão -->
            <div class="title-section2">
                <span class="sub-title2">
                    Usuários Master Franqueados
                </span>
            </div>
            <div class="conteudo">
                <div class="title-section">
                    <span class="sub-title">
                        Lista de <span>Usuários</span> Master Franqueados:
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Cpf</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Creci</th>
                            <th>Email</th>
                            <th>Alterar</th>
                            <th>Excluir</th>    
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {	
                                echo "<tr>";
                                echo "<td>".$res['cpf']."</td>";
                                echo "<td>".$res['nome']."</td>";
                                echo "<td>".$res['usuario']."</td>";
                                echo "<td>".$res['creci']."</td>";
                                echo "<td>".$res['email']."</td>";
                                echo "<td><a href=\"editUserMasterFranqueado.php?id=$res[cpf]&&nom=$res[nome]\">Edit</a></td>";
                                echo "<td><a href=\"delUserMasterFranqueado.php?id=$res[cpf]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    <a href="./addUserMasterFranqueado.php">
                        <button class="btn-clean btn-submit" type="submit">Incluir</button>
                    </a>
                    <a href='../../menu.php'>
                        <button class="btn-clean btn-submit" type="submit">Voltar</button>
                    </a>
                </div> 
            </div>
    </section>
</body>
</html>