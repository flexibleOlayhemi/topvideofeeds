<?php 

class createDB{

	public $db_name;
	public $table_name;
	public $server ;
	public $user ;
	public $password ;

	public  $con;

	public function __construct(
		$db_name = "heroku_5d19199cafc2f7b",
		$table_name = "content",
	$server = "us-cdbr-east-02.cleardb.com",
	$user = "b0663bdc53b071",
	$password = "28495110"

	){

			$this->db_name = $db_name;
			$this->server = $server;
			$this->table_name = $table_name;
			$this->user = $user;
			$this->password = $password;

			//create connection 
			$this->con = mysqli_connect($server,$user,$password);

			//check connection 

			if (!$this->con){
				die("Connection failed".mysqli_connect_error());
			}

			//create querry

			$sql = "CREATE DATABASE IF NOT EXISTS $db_name";

			//execute query 

			if(mysqli_query($this->con,$sql)){

				$this->con = mysqli_connect($server,$user,$password,$db_name);

				//sql to create table

				$sql =  "CREATE TABLE IF NOT EXISTS $table_name

					(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					title VARCHAR(255),
					body VARCHAR(255),
					tm DATETIME DEFAULT CURRENT_TIMESTAMP)
					";

				//execute query

				if (!mysqli_query($this->con, $sql)){

					
					echo "Unable to create table ".$table_name.": ".mysqli_error($this->con);
				}

					


			}else 
			{
				return false;
			}




	}  //constructor ends here


	public function insertToDb($t_name,$title,$body){


		//query
		$sql = "INSERT INTO $t_name(title,body) VALUES('$title','$body')" ;

		//execute query

		if(!mysqli_query($this->con, $sql)){
			echo "Failed to upload post". mysqli_error($this->con);
		}else{
			return true;
		}

	}

	public function login($email,$password){

		$sql = "SELECT * FROM adminlogin WHERE email='$email' and password='$password' ";
		//execute query

		$result = mysqli_query($this->con, $sql);
			if (mysqli_num_rows($result)>0){
		        		return true;
		        	}else 
		        	{
		        		//echo "Failed to Retrieve data : ". mysqli_error($this->con);
		        		return false;
		        	}
		        
	}
	public function getData($t_name){

		//query 
		$sql = "SELECT * FROM $t_name ORDER BY tm DESC";
		//execute qery
		$result = mysqli_query($this->con,$sql);
		        	if (mysqli_num_rows($result)>0){
		        		return $result;
		        	}else 
		        	{
		        		//echo "Failed to Retrieve data : ". mysqli_error($this->con);
		        		return false;
		        	}

	}


	

	public function deletePost($table,$id){

		//query
		$sql = "DELETE FROM $table where id=$id";
		//execute
		if (! mysqli_query($this->con,$sql)){

			echo "Unable to delete : ". mysqli_error($this->con);
		}else{
			
			return true;
		}
	}


	
	
}

 ?>