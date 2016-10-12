<?php
	require('database.php');
	require_once("functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');



	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];

		$delete_dvd_query = "DELETE FROM dvds WHERE id=" . $id;

		if($conn->conn->query($delete_dvd_query)===TRUE)
		{
			redirect_to_with_get("dvd.php","message","3");
			// echo "Record Updated Successfully";
		}
		else
		{
			echo "Error Deleting Record: " . $conn->conn->error;
		}

	}
	else
	{
		echo "DVD entry to be deleted not selected from customers page";
	}

?>

	<?php require('database_close.php'); ?>