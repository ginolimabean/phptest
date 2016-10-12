<?php
	require('database.php');
	require_once("functions.php");
	require_once("validation_functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');
?>
<?php

	if(isset($_POST["submit"]))
	{
		$name 			= $_POST["name"];
		$surname 		= $_POST["surname"];
		$contact_number = $_POST["contact_number"];
		$email 			= $_POST["email"];
		$sa_id_number 	= $_POST["sa_id_number"];
		$address 		= $_POST["address"];

		//Escape all strings
		$name 			= mysqli_real_escape_string($conn, $name);
		$surname 		= mysqli_real_escape_string($conn, $surname);
		$contact_number = mysqli_real_escape_string($conn, $contact_number);
		$email 			= mysqli_real_escape_string($conn, $email);
		$sa_id_number 	= mysqli_real_escape_string($conn, $sa_id_number);
		$address 		= mysqli_real_escape_string($conn, $address);

		//Inserting records (CREATE) in the form of values in $_POST
		//	2. Perform database query
		$add_customer_query  = "INSERT INTO customers (";							
		$add_customer_query .= "	name, surname, contact_number, email, sa_id_number, address";
		$add_customer_query .= ") VALUES (";
		$add_customer_query .= "'" 	. $name ."','"
						. $surname ."','" 
						. $contact_number . "','" 
						. $email . "','" 
						. $sa_id_number ."','" 
						. $address 
				. "'";
		$add_customer_query .= ");";
		
		if($conn->query($add_customer_query)===TRUE)
		{
			redirect_to_with_get("customer.php","message","2");
			// echo "Record Updated Successfully";
		}
		else
		{
			echo "Error Creating record: " . $conn->error;
		}
	}

?>

<?php require('header.php'); ?>


<form action="add_customer.php" method="post">

	<table>
		<tr>
			<td>id: </td> 
			<td><input type="text" name="id" value="" readonly></td>
		</tr>
		<tr>
			<td>name: </td>
			<td><input type="text" name="name" value=""></td>
		</tr>
		<tr>
			<td>surname: </td>
			<td><input type="text" name="surname" value=""></td>
		</tr>
		<tr>
			<td>contact_number: </td>
			<td><input type="text" name="contact_number" value=""></td>
		</tr>
		<tr>
			<td>email: </td>
			<td><input type="text" name="email" value=""></td>
		</tr>
		<tr>
			<td>sa_id_number: </td>
			<td><input type="text" name="sa_id_number" value=""></td>
		</tr>
		<tr>
			<td>address: </td>
			<td><input type="text" name="address" value=""></td>
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