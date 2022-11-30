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
mysqli_query($mysqli, "DELETE FROM franquia WHERE Franqueado_id_franqueado='$id'");
mysqli_query($mysqli, "DELETE FROM franqueado WHERE id_franqueado='$id'");
//redirecting to the display page (view.php in our case)
header("Location:viewFranquias.php");
?>

