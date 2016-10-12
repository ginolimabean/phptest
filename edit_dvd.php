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
			$posted_category_id 	= $_POST["category_id"];
			$posted_name 			= $_POST["name"];
			$posted_description 	= $_POST["description"];
			$posted_release_date 	= $_POST["release_date"];
			// $message;

			//Escape all strings
			$posted_category_id 	= mysqli_real_escape_string($conn->conn, $posted_category_id);
			$posted_name 			= mysqli_real_escape_string($conn->conn, $posted_name);
			$posted_description 	= mysqli_real_escape_string($conn->conn, $posted_description);
			$posted_release_date 	= mysqli_real_escape_string($conn->conn, $posted_release_date);

			$category_id			= "";
			$name 					= "";
			$descripion 			= "";
			$release_date 			= "";

			//Validation of non blank values (presence validation)
			$fields_required = array("id","category_id","name","description","release_date");
			foreach ($fields_required as $field)
			{
				$value = trim($_POST[$field]);
				if(!has_presence($value))
				{
					$errors[$field] = ucfirst($field) . " can't be blank.<br>";
				}
				if(!empty($errors))
				{
					// redirect_to_with_get('edit_dvd.php','errors',count($errors));
				}
			}

			//Try update if no errors
			if(empty($errors))
			{
				$update_dvd_query 	= "UPDATE dvds SET ";
				$update_dvd_query .= "category_id ='$posted_category_id', ";
				$update_dvd_query .= "name ='$posted_name', ";
				$update_dvd_query .= "description ='$posted_description', ";
				$update_dvd_query .= "release_date ='$posted_release_date' ";
				$update_dvd_query .= "WHERE id = $posted_id;";

				echo $update_dvd_query;
				var_dump($_POST);

				if($conn->update_dvd($update_dvd_query)===TRUE){
					redirect_to_with_get("dvd.php","message","1");
					// echo "Record Updated Successfully";
				}
				else
				{
					echo "Error Updating record: " . $conn->conn->error;
				}													
			}							//	if(empty($errors))
		}	//	if(isset($_POST["submit"]))
		else 
		{
			$id 					= $_GET["id"];
			$posted_id 				= "";
			$posted_category_id 	= "";
			$posted_name 			= "";
			$posted_description 	= "";
			$posted_release_date 	= "";
			


		//DATABASE QUERY - SELECT dvd using $_GET
			//Build SQL Query
			//$id = $_GET["id"];			Set when checking if POST isset or url link in dvd.php
			$select_dvd  = "SELECT * ";
			$select_dvd .= "from dvds ";
			$select_dvd .= 'WHERE id = ' . $id;
			// echo $select_dvd;		//echo to view sql query string for debugging

			//Catch SQL Query Result
			$get_dvd_results = $conn->fetch_dvd($select_dvd);

			// if($get_dvd_result->num_rows>0)					//	Test if any rows returned. DONE in fetch()
		//	{
			//	while($row = $get_dvd_result->fetch_assoc())	//	Loop through returned row. DONE in fetch()
			//	{
			foreach($get_dvd_results as $result)
				{
					$category_id = $result["category_id"];
					$name = $result["name"];
					$description = $result["description"];
					$release_date = $result["release_date"];
				}
			//	}													//	Loop through returned row. DONE in fetch()
		//	}														//	Test if any rows returned. DONE in fetch()
		}															// 	else close
	}																//	if(isset($_GET['submit'])||isset($_GET['id'])) close
	if(!isset($_GET['id']))
	{
		//	echo "Edit details not selected from dvd.php";
		$id 			= "";
		$category_id 	= "";
		$name 			= "";
		$description 	= "";
		$release_date 	= "";

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


	<form action="edit_dvd.php?submit=1" method="post">

		<table>
			<tr>
				<td>id: </td>
				<td><input type="text" name="id" value="<?php echo $id ;?>" readonly></td>
			</tr>
			<tr>
				<td>category_id: </td>
				<td>
					<input type="text" name="category_id" value="<?php echo $category_id ;?>">
				</td>
			</tr>
			<tr>
				<td>name: </td>
				<td>
					<input type="text" name="name" value="<?php echo $name ;?>">
				</td>
			</tr>
			<tr>
				<td>description: </td>
				<td>
					<input type="text" name="description" value="<?php echo $description ;?>">
				</td>
			</tr>
			<tr>
				<td>release_date: </td>
				<td>
					<input type="text" name="release_date" value="<?php echo $release_date ;?>">
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