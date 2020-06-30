<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
	 //Getting values 
	 $username = $_POST['username'];
	 
	 //Creating sql query
	 $sql = "SELECT * FROM users WHERE username='$username' ";
	 
	 //importing dbConnect.php script 
	 require_once('config.php');
	 
	 //executing query
	 $result = mysqli_query($con,$sql);

	 	while ($obj = mysqli_fetch_object($result)) {
					$pic  = $obj->pic_url;
					echo $pic;

				}	
	 
 
 }