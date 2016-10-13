<?php
	require('database.php');
	require_once("functions.php");
	require_once("validation_functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');
?>
<?php

	if(isset($_POST["submit"]))
	{
		$category_id 	= $_POST["category_id"];
		$name 			= $_POST["name"];
		$description 	= $_POST["description"];
		$release_date 	= $_POST["release_date"];

		//Escape all strings
		$category_id 	= mysqli_real_escape_string($conn->conn, $category_id);
		$name 			= mysqli_real_escape_string($conn->conn, $name);
		$description 	= mysqli_real_escape_string($conn->conn, $description);
		$release_date 	= mysqli_real_escape_string($conn->conn, $release_date);

		//Inserting records (CREATE) in the form of values in $_POST
		//	2. Perform database query
		$add_dvd_query  = "INSERT INTO dvds (";							
		$add_dvd_query .= "	category_id, name, description, release_date";
		$add_dvd_query .= ") VALUES (";
		$add_dvd_query .= "'" 
						. $category_id 	."','"
						. $name 		."','" 
						. $description 	. "','" 
						. $release_date 
						. "'";
		$add_dvd_query .= ");";
		
		if($conn->conn->query($add_dvd_query)===TRUE)
		{
			redirect_to_with_get("dvd.php","message","2");
			// echo "Record Updated Successfully";
		}
		else
		{
			echo "Error Creating record: " . $conn->conn->error;
		}
	}

?>

<?php require('header.php'); ?>


<form action="add_dvd.php" method="post">

	<table>
		<tr>
			<td>id: </td> 
			<td><input type="text" name="id" value="" readonly></td>
		</tr>
		<tr>
			<td>category_id: </td>
			<td><input type="text" name="category_id" value=""></td>
		</tr>
		<tr>
			<td>name: </td>
			<td><input type="text" name="name" value=""></td>
		</tr>
		<tr>
			<td>description: </td>
			<td><input type="text" name="description" value=""></td>
		</tr>
		<tr>
			<td>release_date: </td>
			<td><input type="date" name="release_date" value=""></td>
		</tr>
		<tr>
			<td><input type="Submit" name="submit" value="Submit"></td>
		</tr>
	</table>
	
</form>


<?php 
	require('footer.php');
	require('database_close.php'); 
?>