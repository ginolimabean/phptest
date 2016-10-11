<?php
	
	class mysql_database
	{
		private $conn;


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
					while($row = $result->fetch_assoc())
					{
					 	$row_data = array(
							"id"=>$row["id"],
							"name"			=>$row["name"],
							"surname"		=>$row["surname"],
							"contact_number"=>$row["contact_number"],
							"email"			=>$row["email"],
							"sa_id_number"	=>$row["sa_id_number"],
							"address"		=>$row["address"]
							);
						return $row_data;
					}
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
		
	}


	$db = new mysql_database('localhost','root','','dvd_shop');
	$query1 = "SELECT * FROM customers;";
	// $query = "SELECT * FROM customers";
	$query2 = "UPDATE customers SET surname='Starke' where id=2;";
	var_dump($db->update($query2));

?>