<?php require('database.php'); ?>

<?php // OBJECT ORIENTED INSTANTIATED CONNECTION from __CONSTRUCT of implemented mysql_database class ?>
<?php $conn = new mysql_database('localhost','root','','dvd_shop'); ?>

<?php
	//DATABASE QUERY - SELECT

	//Build SQL Query
	$select_all_customers  = "SELECT * ";
	$select_all_customers .= "from customers ";
	// echo $select_all_customers;		//echo to view sql query string for debugging
	//Catch SQL Query Result
	$results = $conn->fetch($select_all_customers);
	// var_dump($results);
	// exit;
?>

<?php 
	//Display message from edit_customer or add_customer
	
	if(isset($_GET["message"])){
		if($_GET["message"]==1)
		{
			echo "Customer successfully updated.";
		}
		else if($_GET["message"]==2)
		{
			echo "Customer successfully added to database.";
		}
		else if($_GET["message"]==3)
			echo "Customer successfully deleted from database.";
	}
	else
	{
		// echo "";
	}


	//Use Result, test if any by using $result->num_rows>0, and loop through to output data ?>
	<?php require('header.php'); ?>
	<!-- Create table for output -->
	<table width="100%" border="1" style="border-style: solid;">
		<thead>
			<tr>
				<td>id</td>
				<td>name</td>
				<td>surname</td>
				<td>contact_number</td>
				<td>email</td>
				<td>sa_id_number</td>
				<td>address</td>
				<td>Actions</td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
				// if($result->num_rows>0){						//Test if any rows returned. DONE in fetch()
					// while($row = $result->fetch_assoc()){	//Loop through returned row. DONE in fetch()
				foreach($results as $result){					// Loop through results returned from fetch()
			?>
					<tr>
						<td><?php echo $result["id"]; ?></td>					
						<td><?php echo $result["name"]; ?></td>
						<td><?php echo $result["surname"]; ?></td>
						<td><?php echo $result["contact_number"]; ?></td>
						<td><?php echo $result["email"]; ?></td>
						<td><?php echo $result["sa_id_number"]; ?></td>
						<td><?php echo $result["address"]; ?></td>
						<td>
							<a href="edit_customer.php?id=<?php echo $result["id"] ;?>">edit</a>
							<a href="delete_customer.php?id=<?php echo $result["id"] ;?>">delete</a>
						</td>	<!-- edit pass id to prepopulate and edit in form -->
					</tr>
			<?php
					// }										// Close loop not needed DONE with fetch()
				// }											// Close If statement needed DONE with fetch()
				}												//foreach($results as $result)
			?>
		</tbody>
	</table>
	<br>
	<form action="add_customer.php">
	    <a href=add_customer.php><input type="button" value="Add customer"></a>
	</form>

	
	<?php 
	require('footer.php');
	require('database_close.php'); 
	?>

