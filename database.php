<?php
	
	class mysql_database
	{
		public $conn;


		public function __construct($servername, $username, $password, $dbname)
		{
			$conn = new mysqli($servername, $username, $password, $dbname);

			//Test Connection
			if($conn->connect_error)
			{
				die ("Connection Failed: " . $conn->connect_error);
			}
			//echo "db connected";
			$this->conn = $conn;
		}

		public function fetch($query)
		{
			

			$result=$this->conn->query($query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$all_row_data = array();
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
							"id"			=>$row["id"],
							"name"			=>$row["name"],
							"surname"		=>$row["surname"],
							"contact_number"=>$row["contact_number"],
							"email"			=>$row["email"],
							"sa_id_number"	=>$row["sa_id_number"],
							"address"		=>$row["address"]
							);
					 	$all_row_data[] = $row_data;
					}
					return $all_row_data;
				}
			}
			else
			{
				echo "Error Fetching query: " . $this->conn->error;
			}
		}


		public function update($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				return true;
			}
		}


		public function fetch_dvd($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$all_row_data = array();
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
							"id"			=>$row["id"],
							"category_id"	=>$row["category_id"],
							"name"			=>$row["name"],
							"description"	=>$row["description"],
							"release_date"	=>$row["release_date"],
							);
					 	$all_row_data[] = $row_data;
					}
					return $all_row_data;
				}
			}
			else
			{
				echo "Error Fetching query: " . $this->conn->error;
			}
		}



		public function fetch_dvd_join($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$all_row_data = array();
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
							"id"			=>$row["id"],
							"category_id"	=>$row["category_id"],
							"name"			=>$row["name"],
							"description"	=>$row["description"],
							"release_date"	=>$row["release_date"],
							"category_name"	=>$row["category_name"]
							);
					 	$all_row_data[] = $row_data;
					}
					return $all_row_data;
				}
			}
			else
			{
				echo "Error Fetching query: " . $this->conn->error;
			}
		}

		public function update_dvd($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				return true;
			}
		}


		public function fetch_max_id($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				if($result->num_rows===1)
				{
					$all_row_data = array();
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
							"id"			=>$row["id"]
							);
					 	$all_row_data[] = $row_data;
					}
					return $all_row_data;
				}
			}
			else
			{
				echo "Error Fetching query: " . $this->conn->error;
			}
		}

		public function fetch_orders($query)
		{
			$result=$this->conn->query($query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$all_row_data = array();
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
					 		//customers table
					 		"customer_id"			=>$row["customer_id"],
					 		"customer_name"			=>$row["customer_name"],
					 		"customer_surname"		=>$row["customer_surname"],
					 		//orders table
							"order_id"				=>$row["order_id"],
							"rent_date"				=>$row["rent_date"],
							"due_date"				=>$row["due_date"],
							"actual_return_date"	=>$row["actual_return_date"],
							//dvds table
							"dvd_id"				=>$row["dvd_id"],
							"dvd_name"				=>$row["dvd_name"]
							);
					 	$all_row_data[] = $row_data;
					}
					return $all_row_data;
				}
			}
			else
			{
				echo "Error Fetching query: " . $this->conn->error;
			}
		}

		public function close()
		{
			$this->conn->close();
		}
		
	}


	// $conn = new mysql_database('localhost','root','','dvd_shop');
	// $query1 = "SELECT * FROM customers;";
	// $query = "SELECT * FROM customers";
	// $query2 = "UPDATE customers SET surname='Starke' where id=2;";
	// var_dump($db->fetch($query1));
	// var_dump($db->update($query2));

?>