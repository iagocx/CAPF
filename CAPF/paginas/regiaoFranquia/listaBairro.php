<?php session_start(); ?>

<?php
//including the database connection file
include_once("../../conexao.php");

//fetching data in descending order (lastest entry first)
//$result2 = mysqli_query($mysqli, "SELECT * FROM masterfranquia ORDER BY Franqueado_id_franqueado");
$id = $_GET['id'];
$nom = $_GET['nom'];
$result = mysqli_query($mysqli, "SELECT * FROM bairro WHERE RegiaoFranquia_id_RegiaoFranquiacol='$id' ORDER BY nome");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="../../estilos/form.css" type="text/css" rel="stylesheet">
    <link href="../../estilos/table.css" type="text/css" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Manter Regiões franquiadas</title>
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
                        Listar Bairros
                    </span>
                </div> 
            <div class="conteudo">
                <div class="title-section">
                    <span class="sub-title">
                        Dados referentes:
                        <br>-Região:  
                        <?php echo "<span>".$nom."</span>"; ?>
                    </span>
                </div>
                <div class="tb-scrol">
                    <table>
                        <tr>
                            <th>Bairros</th>       
                        </tr>
                        <?php
                            while($res = mysqli_fetch_array($result)) {	

                                echo "<tr>";
                                echo "<td>".$res['nome']."</td>";
                                echo "</tr>";
                            }
                        ?>   
                    </table>
                </div>
                <div class="btn-sv">
                    
                    <a href='./viewRegiaoFranquia.php'>
                        <button class="btn-clean btn-submit" type="submit">Voltar</button>
                    </a>
                </div>  
            </div>
    </section>
</body>
</html>