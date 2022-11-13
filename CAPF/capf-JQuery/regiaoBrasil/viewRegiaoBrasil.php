<?php session_start(); ?>

<?php
//including the database connection file
include_once("../conexao.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM regiaobrasil ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<link href="../estilos/menu.css" type="text/css" rel="stylesheet">
    <link href="../estilos/form.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões do Brasil</title>
    <script src="../js/valid-form.js"></script>
    <!-- <script src="./js/form-etapas.js"></script> -->
<head> 

<body>
    <!-- Sessão Listar Regiões do Brasil-->
    <section id="servicos" class="section-content-row">
        <div class="content">
            <!-- Titulo da sessão -->
            <div class="title-section">
                <span class="sub-title">
                    Lista de <span>regiões</span> do Brasil
                </span>
                <table id="formAero">
                    <div class="doisfr">
                        <div class="form-area  form-col">
                            <tr>
                                <td>Id</td>
                                <td>Nome</td>
                                <td>Alterar</td>
                                <td>Excluir</td>
                            </tr>
                            <?php
                                while($res = mysqli_fetch_array($result)) {		
                                    echo "<tr>";
                                    echo "<td>".$res['id_RegiaoBrasil']."</td>";
                                    echo "<td>".$res['nome']."</td>";
                                    echo "<td><a href=\"editRegiaoBrasil.php?id=$res[id_RegiaoBrasil]\">Edit</a> | <a href=\"delete.php?id=$res[id_RegiaoBrasil]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
                                }
                            ?>
                        </div>
                    </div>
                    
                </table>
            </div>
            <a href="./incRegiaoBrasil.php">
                <button class="btn-clean btn-submit" type="submit">Incluir</button>
            </a>
            <a href='javascript:self.history.back();'>
                <button class="btn-clean btn-submit" type="submit">Voltar</button>
            </a>
            </div>  
    </section>
</body>
</html>