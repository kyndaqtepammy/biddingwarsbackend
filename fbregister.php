<?php

	
 if($_SERVER['REQUEST_METHOD']=='POST'){
	 //Getting values 

 	$name	  = $_POST['name'];
 	$facebkid = $_POST['facebkid'];
 	$email	  = $_POST['email'];
 	$picurl	  = $_POST['picurl'];	
	$username = $_POST['username'];
	$password = $_POST['password'];


	require_once 'config.php';



$checkExisting 	= "SELECT * FROM users WHERE email LIKE'".$email."'  OR username LIKE  '".$username."'  ";
$checkResult 	= mysqli_query($con, $checkExisting);
 

if( mysqli_num_rows($checkResult) >0 ){
		echo json_encode((object)[
			"error" => true

		]); 
 }else{
	 $checkExisting = "INSERT INTO  users (name, username, password, email, propic)  VALUES ('$name', '$username', '$password', '$email', '$picurl')  ";
     $checkResult = mysqli_query($con,$checkExisting);





 $sql = "INSERT INTO facebook_users (full_name, email_phone, facebook_id, username, password, pic_url, first_login)  VALUES ('$name', '$email', '$facebkid', '$username', '$password', '$picurl', '1')  ";


	    $result = mysqli_query($con,$sql);


			if ($result) {

				$last_id    = mysqli_insert_id($con);
				$getUserData= "SELECT * FROM facebook_users WHERE id = '".$last_id."' ";
				$inserted   = mysqli_query($con, $getUserData);



				while ($obj = mysqli_fetch_object($inserted)) {
		            $id   = $obj->facebook_id;
		            $name = $obj->full_name;
					$uname= $obj->username;
					$pic  = $obj->pic_url;

				}	

			 	echo json_encode((object)[
			 			"error"=>false,
			 			"username" => $username,
			 			"pic"  => $picurl
			 		]);


			 	
			 	 }else{
			 	 	echo json_encode((object)[
			 			"error"=>true
			 		]);
			 	 	
			 	 }
	 //echo "success";
 }

}