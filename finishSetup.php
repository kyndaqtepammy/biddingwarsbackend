<?php
	if( $_SERVER['REQUEST_METHOD']== 'POST' ){
			$image   = $_POST['image'];
			$username= $_POST['username'];
			$email   = $_POST['email'];
			
			require_once 'config.php';
			
			$sql	= "SELECT id FROM users WHERE email =  '$email' ";
			$res    = mysqli_query($con, $sql);
			$id     = 0; 
			
			
			while( $row = mysqli_fetch_array($res) ){
			   $id		= $row['id'];
			}
			//echo $id;
			
		    $path		= "propics/$id.png";
			$actualpath	= "http://172.16.3.21:8080/bids/$path";
			$sql        = "UPDATE users SET propic = '$actualpath', username = '$username'  WHERE email = '$email'   ";
		
			if( mysqli_query($con, $sql) ){
				file_put_contents($path, base64_decode($image) );
			//	echo "Your image was uploaded successfully";
				echo $actualpath;
			}else{
			    echo "An error occured!";
			} 
	
	}