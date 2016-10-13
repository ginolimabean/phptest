<?php
	require('database.php');
	require_once("functions.php");
	require_once("validation_functions.php");

	$conn = new mysql_database('localhost','root','','dvd_shop');
?>


<?php
	
	// GET ORDER ID FOR dvd_order 
	// $order_id = $conn->conn->insert_id;		//$conn->insert_id not used, last insert after adding order correct, but not dvd_order
	$last_id_order_query 	= "SELECT MAX(id) as id FROM orders";
	$result 				= $conn->fetch_max_id($last_id_order_query);
	// var_dump($result);
	// exit;

	$order_id = $result[0]['id'];
	// var_dump($order_id);

	//String to int casting
	$order_id = (int)($order_id);
	// var_dump($order_id);
	// exit;


	// FORM PROCESSING - ADDING DVDs TO dvd_order
	if(isset($_POST['submit']))
	{
		$dvd_id 				= $_POST['dvd_id'];
		$add_dvd_order_query 	= "INSERT INTO dvd_order (dvd_id, order_id) VALUES (" . $dvd_id . ", " . $order_id . ");";

		if($conn->conn->query($add_dvd_order_query)===TRUE)
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


<form action="add_dvd_order.php" method="post">

	<table>
		<tr>
			<td>id: </td> 
			<td><input type="text" name="id" value="" readonly></td>
		</tr>
		<tr>
			<td>order_id: </td>
			<td><input type="text" name="order_id" value="<?php echo $order_id;?>" readonly></td>
		</tr>
		<tr>
			<td>dvd_id: </td>
			<td><input type="text" name="dvd_id" value=""></td>
		</tr>
		<tr>
			<td><input type="Submit" name="submit" value="Add DVD"></td>
		</tr>
		<tr>
			<td><a href="order.php"><input type="button" name="" value="Order Complete"></a></td>
		</tr>
	</table>
	
</form>


<?php 
	require('footer.php');
	require('database_close.php'); 
?>