<?php
	require('database.php');
	require_once("functions.php");
	require_once("validation_functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');
?>
<?php

	if(isset($_POST["submit"]))
	{
		$customer_id 	= $_POST["customer_id"];
		$rent_date 		= $_POST["rent_date"];
		$due_date 		= $_POST["due_date"];

		// var_dump($rent_date);
		// var_dump($due_date);

		// exit;

		//$_POST string to Date conversion of variables
		$rent_date		= 	date_create($rent_date);
		$due_date		=	date_create($due_date);

		// var_dump($rent_date);
		// var_dump($due_date);

		// exit;


		$rent_date		=	date_format($rent_date,"Y-m-d");
		$due_date		=	date_format($due_date,"Y-m-d");

		// var_dump($rent_date);
		// var_dump($due_date);
		// exit;



		//Escape all strings
		// $customer_id 	= mysqli_real_escape_string($conn->conn, $customer_id);
		// $rent_date 		= mysqli_real_escape_string($conn->conn, $rent_date);
		// $due_date 		= mysqli_real_escape_string($conn->conn, $due_date);

		//Inserting records (CREATE) in the form of values in $_POST
		//	2. Perform database query
		$add_order_query	= "INSERT INTO orders (";							
		$add_order_query 	.= "customer_id, rent_date, due_date";
		$add_order_query 	.= ") VALUES (";
		$add_order_query 	.= $customer_id .",'"
							. $rent_date 	."','" 
							. $due_date ;
		$add_order_query 	.= "');";

		// var_dump($add_order_query);
		// exit;

		
		if($conn->conn->query($add_order_query)===TRUE)
		{
			redirect_to("add_dvd_order.php");
			// echo "Record Updated Successfully";
		}
		else
		{
			echo "Error Creating Order: " . $conn->conn->error;
		}
	}

?>

<?php require('header.php'); ?>


<form action="add_order.php" method="post">

	<table>
		<tr>
			<td>id: </td> 
			<td><input type="text" name="id" value="" readonly></td>
		</tr>
		<tr>
			<td>customer_id: </td>
			<td><input type="text" name="customer_id" value=""></td>
		</tr>
		<tr>
			<td>rent_date: </td>
			<td><input type="date" name="rent_date" value=""></td>
		</tr>
		<tr>
			<td>due_date: </td>
			<td><input type="date" name="due_date" value=""></td>
		</tr>
		<tr>
			<td>actual_release_date: </td>
			<td><input type="date" name="actual_release_date" value="" readonly></td>
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