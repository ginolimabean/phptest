<?php
	require_once("functions.php");
	require('database.php');
	require_once("validation_functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');

?>


<?php 	//FORM PROCESSING
	$errors = array();
	$id;
	if(isset($_GET['submit'])||isset($_GET['id']))
	{
		if(isset($_POST["submit"]))
		{
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
			$posted_name 			= mysqli_real_escape_string($conn->conn, $posted_name);
			$posted_surname 		= mysqli_real_escape_string($conn->conn, $posted_surname);
			$posted_contact_number 	= mysqli_real_escape_string($conn->conn, $posted_contact_number);
			$posted_email 			= mysqli_real_escape_string($conn->conn, $posted_email);
			$posted_sa_id_number 	= mysqli_real_escape_string($conn->conn, $posted_sa_id_number);
			$posted_address 		= mysqli_real_escape_string($conn->conn, $posted_address);

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
				if(!empty($errors))
				{
					// redirect_to_with_get('edit_customer.php','errors',count($errors));
				}
			}

			//Try update if no errors
			if(empty($errors))
			{
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

				if($conn->update($update_customer_query)===TRUE){
					redirect_to_with_get("customer.php","message","1");
					// echo "Record Updated Successfully";
				}
				else
				{
					echo "Error Updating record: " . $conn->error;
				}													
			}							//	if(empty($errors))
		}	//	if(isset($_POST["submit"]))
		else 
		{
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
			//$id = $_GET["id"];			Set when checking if POST isset or url link in customer.php
			$select_customer  = "SELECT * ";
			$select_customer .= "from customers ";
			$select_customer .= 'WHERE id = ' . $id;
			// echo $select_customer;		//echo to view sql query string for debugging

			//Catch SQL Query Result
			$get_customer_results = $conn->fetch($select_customer);

			// if($get_customer_result->num_rows>0)					//	Test if any rows returned. DONE in fetch()
		//	{
			//	while($row = $get_customer_result->fetch_assoc())	//	Loop through returned row. DONE in fetch()
			//	{
			foreach($get_customer_results as $result)
				{
					$name = $result["name"];
					$surname = $result["surname"];
					$contact_number = $result["contact_number"];
					$email = $result["email"];
					$sa_id_number = $result["sa_id_number"];
					$address = $result["address"];
				}
			//	}													//	Loop through returned row. DONE in fetch()
		//	}														//	Test if any rows returned. DONE in fetch()
		}															// 	else close
	}																//	if(isset($_GET['submit'])||isset($_GET['id'])) close
	if(!isset($_GET['id']))
	{
		//	echo "Edit details not selected from customer.php";
		$id 			= "";
		$name 			= "";
		$surname 		= "";
		$contact_number = "";
		$email 			= "";
		$sa_id_number 	= "";
		$address 		= "";

	}


?>

<?php require('header.php'); ?>

<?php //echo $message; ?>	<!--//Display log in $message-->


<?php 	
	if(isset($_GET["id"])||isset($_GET['errors']))
	{	
	// var_dump(form_errors($errors));exit;
	 echo form_errors($errors);		//	<!--Display errors assoc_array-->
?>


	<form action="edit_customer.php?submit=1" method="post">

		<table>
			<tr>
				<td>id: </td>
				<td><input type="text" name="id" value="<?php echo $id ;?>" readonly></td>
			</tr>
			<tr>
				<td>name: </td>
				<td>
					<input type="text" name="name" value="<?php echo $name ;?>">
				</td>
			</tr>
			<tr>
				<td>surname: </td>
				<td>
					<input type="text" name="surname" value="<?php echo $surname ;?>">
				</td>
			</tr>
			<tr>
				<td>contact_number: </td>
				<td>
					<input type="text" name="contact_number" value="<?php echo $contact_number ;?>">
				</td>
			</tr>
			<tr>
				<td>email: </td>
				<td>
					<input type="text" name="email" value="<?php echo $email ;?>">
				</td>
			</tr>
			<tr>
				<td>sa_id_number: </td>
				<td>
					<input type="text" name="sa_id_number" value="<?php echo $sa_id_number ;?>">
				</td>
			</tr>
			<tr>
				<td>address: </td>
				<td>
					<input type="text" name="address" value="<?php echo $address ;?>">
				</td>
			</tr>
			<tr>
				<td>
					<input type="Submit" name="submit" value="Submit">
				</td>
			</tr>
		</table>

	</form>
<?php
	}
?>


<?php 
	require('footer.php');
	require('database_close.php'); 
?>