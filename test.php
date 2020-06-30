<?php
	
			$image  = "img";
			$name	= "title";
			$desc	= "desc";
			$sb		= "sb";
			$be		= "be";
			$uploadedBy="user";
			
			require_once 'config.php';
			
			$sql	= "SELECT id FROM products ORDER BY id ASC";
			$res    = mysqli_query($con, $sql);
			$id     = 0; 
			
			while( $row = mysqli_fetch_array($res) ){
				$id		= $row['id'];
			}
			
			$path		= "uploads/$id.png";
			$actualpath	= "http://localhost:8080/bids/$path";
			$sql		= "INSERT INTO products (photo, name, description, start_amount, end_date, time_posted, posted_by) VALUES ('$actualpath', '$name', '$desc', '$sb', '$be', NOW(), '$uploadedBy' ) ";		
		
			if( mysqli_query($con, $sql) ){
				file_put_contents($path, base64_decode($image) );
				echo "successfully Uploaded row number ". $id;
			}
			
			//mysqli_close($con);
		else{
			//echo "Error!";
			printf("Error: %s\n", mysqli_error($con));
			}
		
		
