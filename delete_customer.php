<?php
	require('database.php');
	require_once("functions.php");



	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];

		$delete_customer_query = "DELETE FROM customers WHERE id=" . $id;

		if($conn->query($delete_customer_query)===TRUE)
		{
			redirect_to_with_get("customer.php","message","3");
			// echo "Record Updated Successfully";
		}
		else
		{
			echo "Error Deleting Record: " . $conn->error;
		}

	}
	else
	{
		echo "Customer entry to be deleted not selected from customers page";
	}

?>

	<?php require('database_close.php'); ?>