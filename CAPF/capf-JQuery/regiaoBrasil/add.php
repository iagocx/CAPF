<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: ../index.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("conexao.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
		
	// checking empty fields
	if(empty($name) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO products(name, qty, price, login_id) VALUES('$name','$qty','$price', '$loginId')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='view.php'>View Result</a>";
	}
}
?>
</body>
</html>