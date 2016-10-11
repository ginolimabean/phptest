<?php

	//DATABASE CONNECTION - OPEN
	//DB connection variables
	$servername = "localhost";
	$username 	= "root";
	$password	= "";
	$dbname		= "dvd_shop";

	//DB connection
	$conn = new mysqli($servername, $username, $password, $dbname); 

	//Check connection
	if($conn->connect_error){
		die ("Connection Failed:" . $conn->connect_error . "<br>");
		}
	// echo "Connected Successfully <br>";

?>

<?php
	//DATABASE QUERY - SELECT

	//Build SQL Query
	$select_all_customers  = "SELECT * ";
	$select_all_customers .= "from customers ";
	// $select_all_customers .= "WHERE name = 'Steven' ";
	// $select_all_customers .= "ORDER BY surname;";
	// echo $select_all_customers;		//echo to view sql query string for debugging

	//Catch SQL Query Result
	$result = $conn->query($select_all_customers);
	var_dump($_POST);

?>
<?php //Use Result, test if any by using $result->num_rows>0, and loop through to output data ?>
	<!-- Create table for output -->
	<table width="100%" border="1">
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
			<?php if($result->num_rows>0){									//Test if any rows returned
				while($row = $result->fetch_assoc()){						//Loop through returned row and use as table data
					?>
					<tr>
						<td><?php echo $row["id"]; ?></td>					
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["surname"]; ?></td>
						<td><?php echo $row["contact_number"]; ?></td>
						<td><?php echo $row["email"]; ?></td>
						<td><?php echo $row["sa_id_number"]; ?></td>
						<td><?php echo $row["address"]; ?></td>
						<td><a href="edit_customer.php?id=<?php echo $row["id"] ;?>">edit</a></td>	<!-- edit pass id to prepopulate and edit in form -->
					</tr>
				<?php 
				}															// Close loop
			}																// Close If statement
			?>
		</tbody>
	</table>



<?php
	//DATABASE CONNECTION - CLOSE
	$conn->close();
?>