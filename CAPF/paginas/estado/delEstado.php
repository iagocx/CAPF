<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../../index.php');
}
?>

<?php
//including the database connection file
include("../../conexao.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result=mysqli_query($mysqli, "DELETE FROM estado WHERE id_estado=$id");

//redirecting to the display page (view.php in our case)
header("Location:viewEstado.php");
?>

