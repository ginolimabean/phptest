<?php require('database.php'); 

	 $conn = new mysql_database('localhost','root','','dvd_shop'); 

	 $select_all_orders_query = "SELECT c.id as customer_id, c.name as customer_name, c.surname as customer_surname, o.id as order_id, o.rent_date as rent_date, o.due_date as due_date, o.actual_return_date as actual_return_date, d.id as dvd_id, d.name as dvd_name FROM customers c INNER JOIN orders AS o ON c.id = o.customer_id
	 	INNER JOIN dvd_order AS d_o on  o.id = d_o.order_id
	 	INNER JOIN dvds AS d on d_o.dvd_id = d.id";

	 $orders = $conn->fetch_orders($select_all_orders_query);

	 // var_dump($orders);
	 // exit;



 ?>



<?php // CRUD APPLICATIONS on orders?>


<?php // READ order ?>
<form action="order.php">
	    <a href="order.php"><input type="button" value="View orders"></a>
</form>

<?php // CREATE order ?>
<form action="add_order.php">
	    <a href="add_order.php"><input type="button" value="New order"></a>
</form>

<?php // UPDATE order ?>
<form action="update_order.php">
	    <a href="update_order.php"><input type="button" value="Update order"></a>
</form>

<?php // DELETE order ?>
<form action="delete_order.php">
	    <a href="delete_order.php"><input type="button" value="Delete Order"></a>
</form>



<?php require('header.php'); ?>
	<!-- Create table for output -->
	<table width="100%" border="1" style="border-style: solid;">
		<thead>
			<tr>
				<td>customer_id</td>
				<td>customer_name</td>
				<td>customer_surname</td>
				<td>order_id</td>
				<td>rent_date</td>
				<td>due_date</td>
				<td>actual_return_date</td>
				<td>dvd_id</td>
				<td>dvd_name</td>
				<td>Actions</td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
				// if($result->num_rows>0){						//Test if any rows returned. DONE in fetch()
					// while($row = $result->fetch_assoc()){	//Loop through returned row. DONE in fetch()
				foreach($orders as $order){					// Loop through results returned from fetch()
			?>
					<tr>
						<td><?php echo $order['customer_id']		;?></td>
						<td><?php echo $order['customer_name']		;?></td>
						<td><?php echo $order['customer_surname']	;?></td>
						<td><?php echo $order['order_id']			;?></td>
						<td><?php echo $order['rent_date']			;?></td>
						<td><?php echo $order['due_date']			;?></td>
						<td><?php echo $order['actual_return_date'];?></td>
						<td><?php echo $order['dvd_id']			;?></td>
						<td><?php echo $order['dvd_name']			;?></td>
						<td>
							<a href="">edit</a>
							<a href="">delete</a>
						</td>	<!-- edit pass id to prepopulate and edit in form -->
					</tr>
			<?php
					// }										// Close loop not needed DONE with fetch()
				// }											// Close If statement needed DONE with fetch()
				}												//foreach($results as $result)
			?>
		</tbody>
	</table>


	
	<?php 
	require('footer.php');
	require('database_close.php'); 
	?>

