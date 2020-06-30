<?php
	
 if($_SERVER['REQUEST_METHOD']=='POST'){
	 //Getting values 

 	//$name	  = $_POST['name'];
 	$facebkid = $_POST['facebkid'];
 

	require_once 'config.php';
 
	 $sql 			= "SELECT * FROM facebook_users WHERE facebook_id = '".$facebkid."'  ";
	 $inserted 		= mysqli_query($con, $sql);
	 
	 
	  if( mysqli_num_rows($inserted) >0 ){
		 	//echo "Already Logged In!"; 	
		 	// echo json_encode((object)[
	 		// 	"loggedin"=>true
	 		// ]);	
//####### query to  fetch username and pic here,  return as object

		 	while ($obj = mysqli_fetch_object($inserted)) {
            $id   = $obj->facebook_id;
            $name = $obj->full_name;
			$uname= $obj->username;
			$pic  = $obj->pic_url;

			echo json_encode((object)[
				"loggedin"=>true,
	 			"name"=>$name,
	 			"username"=>$uname,
	 			"pic"=>$pic
	 		]);

    }



	   }else {
	   	echo json_encode((object)[
	 			"loggedin"=>false
	 				]);
	   	
	   }




 }
 