<?php
	require('database.php');
	require_once("functions.php");
	require_once("validation_functions.php");
?>


<?php 	//FORM PROCESSING
	$errors = array();


	if(isset($_POST["submit"])){
		$id 					= "";
		$posted_id 				= $_POST["id"];
		$posted_name 			= $_POST["name"];
		$posted_surname 		= $_POST["surname"];
		$posted_contact_number 	= $_POST["contact_number"];
		$posted_email 			= $_POST["email"];
		$posted_sa_id_number 	= $_POST["sa_id_number"];
		$posted_address 		= $_POST["address"];
		// $message;

		//Escape all strings
		$posted_name 			= mysqli_real_escape_string($conn, $posted_name);
		$posted_surname 		= mysqli_real_escape_string($conn, $posted_surname);
		$posted_contact_number 	= mysqli_real_escape_string($conn, $posted_contact_number);
		$posted_email 			= mysqli_real_escape_string($conn, $posted_email);
		$posted_sa_id_number 	= mysqli_real_escape_string($conn, $posted_sa_id_number);
		$posted_address 		= mysqli_real_escape_string($conn, $posted_address);

		$name 					= "";
		$surname 				= "";
		$contact_number 		= "";
		$email 					= "";
		$sa_id_number 			= "";
		$address 				= "";

		//Validation of non blank values (presence validation)
		

		$fields_required = array("id","name","surname","contact_number","email","sa_id_number","address");
		
		foreach ($fields_required as $field)
		{
			$value = trim($_POST[$field]);
			if(!has_presence($value))
			{
				$errors[$field] = ucfirst($field) . " can't be blank.<br>";
			}
		}

		//Try update if no errors
		if(empty($errors)){
			$update_customer_query 	= "UPDATE customers SET ";
			$update_customer_query .= "name ='$posted_name', ";
			$update_customer_query .= "surname ='$posted_surname', ";
			$update_customer_query .= "contact_number ='$posted_contact_number', ";
			$update_customer_query .= "email ='$posted_email', ";
			$update_customer_query .= "sa_id_number ='$posted_sa_id_number', ";
			$update_customer_query .= "address ='$posted_address' ";
			$update_customer_query .= "WHERE id = $posted_id;";

			echo $update_customer_query;
			var_dump($_POST);

			if($conn->query($update_customer_query)===TRUE){
				redirect_to_with_get("customer.php","message","1");
				// echo "Record Updated Successfully";
			}
			else
			{
				echo "Error Updating record: " . $conn->error;
			}
		}
	}
	else {
		$id 					= $_GET["id"];
		$posted_id 				= "";
		$posted_name 			= "";
		$posted_surname 		= "";
		$posted_contact_number 	= "";
		$posted_email 			= "";
		$posted_sa_id_number 	= "";
		$posted_address 		= "";
		


	//DATABASE QUERY - SELECT customer using $_GET

		//Build SQL Query
		//$id = $_GET["id"];					decalre and set when checking if POST isset or from edit url link in customer.php
		$select_customer  = "SELECT * ";
		$select_customer .= "from customers ";
		$select_customer .= 'WHERE id = ' . $id;
		// $select_customer .= "ORDER BY surname;";
		// echo $select_customer;		//echo to view sql query string for debugging

		//Catch SQL Query Result
		$get_customer_result = $conn->query($select_customer);

		if($get_customer_result->num_rows>0){
			while($row = $get_customer_result->fetch_assoc()){
				$name = $row["name"];
				$surname = $row["surname"];
				$contact_number = $row["contact_number"];
				$email = $row["email"];
				$sa_id_number = $row["sa_id_number"];
				$address = $row["address"];
			}
		}
	}
?>

<?php require('header.php'); ?>

<?php //echo $message; ?>	<!--//Display log in $message-->
<?php echo form_errors($errors); ?>	<!--//Display errors assoc_array-->


<form action="edit_customer.php" method="post">

	id: <br>
	<input type="text" name="id" value="<?php echo $id ;?>" readonly>
	<br>

	name: <br>
	<input type="text" name="name" value="<?php echo $name ;?>">
	<br>

	surname: <br>
	<input type="text" name="surname" value="<?php echo $surname ;?>">
	<br>

	contact_number: <br>
	<input type="text" name="contact_number" value="<?php echo $contact_number ;?>">
	<br>

	email: <br>
	<input type="text" name="email" value="<?php echo $email ;?>">
	<br>

	sa_id_number: <br>
	<input type="text" name="sa_id_number" value="<?php echo $sa_id_number ;?>">
	<br>

	address: <br>
	<input type="text" name="address" value="<?php echo $address ;?>">
	<br>

	<br>
	<input type="Submit" name="submit" value="Submit">
	

</form>


<?php 
	require('footer.php');
	require('database_close.php'); 
?>