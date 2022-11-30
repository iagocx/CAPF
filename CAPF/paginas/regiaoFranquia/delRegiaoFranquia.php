<?php session_start(); ?>



<?php
//including the database connection file
include("../../conexao.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result=mysqli_query($mysqli, "DELETE FROM usuario WHERE cpf=$id");
$result2=mysqli_query($mysqli, "DELETE FROM usuariomasterfranqueado WHERE Usuario_cpf=$id");
//redirecting to the display page (view.php in our case)
header("Location:viewMasterFranqueado.php");
?>

