<?php require('database.php'); ?>

<?php // OBJECT ORIENTED INSTANTIATED CONNECTION from __CONSTRUCT of implemented mysql_database class ?>
<?php $conn = new mysql_database('localhost','root','','dvd_shop'); ?>

<?php
	//DATABASE QUERY - SELECT

	//Build SQL Query
	$select_all_dvds  = "SELECT dvds.id, dvds.category_id, dvds.name, dvds.description, dvds.release_date, category.category_name ";
	$select_all_dvds .= "from dvds ";
	$select_all_dvds .= "LEFT JOIN category ";
	$select_all_dvds .= "on dvds.category_id = category.id ";

	// echo $select_all_customers;		//echo to view sql query string for debugging
	//Catch SQL Query Result
	$results = $conn->fetch_dvd_join($select_all_dvds);
	// var_dump($results);
	// exit;
?>

<?php 
	//Display message from edit_dvd or add_dvd
	
	if(isset($_GET["message"]))
	{
		if($_GET["message"]==1)
		{
			echo "DVD successfully updated.";
		}
		else if($_GET["message"]==2)
		{
			echo "DVD successfully added to database.";
		}
		else if($_GET["message"]==3)
			echo "DVD successfully deleted from database.";
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
				<td>category</td>
				<td>name</td>
				<td>descrption</td>
				<td>release_date</td>
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
						<td><?php echo $result["category_name"]; ?></td>
						<td><?php echo $result["name"]; ?></td>
						<td><?php echo $result["description"]; ?></td>
						<td><?php echo $result["release_date"]; ?></td>
						<td>
							<a href="edit_dvd.php?id=<?php echo $result["id"] ;?>">edit</a>
							<a href="delete_dvd.php?id=<?php echo $result["id"] ;?>">delete</a>
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
	<form action="add_dvd.php">
	    <a href=add_dvd.php><input type="button" value="Add dvd"></a>
	</form>

	
	<?php 
	require('footer.php');
	require('database_close.php'); 
	?>