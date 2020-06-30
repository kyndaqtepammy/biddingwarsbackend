<?php
	if( $_SERVER['REQUEST_METHOD']== 'POST' ){
		
		//if( isset($_POST['image']) && isset($_POST['name'])  && isset($_POST['description']) && isset($_POST['start_amt']) && isset($_POST['end_date'])  && isset($_POST['uploded_by'])   ){
			$image  = $_POST['image'];
			$name	= ucfirst($_POST['title'] );
			$desc	= ucfirst($_POST['description'] );
			$sb		= $_POST['start_amount'];
			$be		= $_POST['end_date'];
			$uploadedBy=$_POST['uploaded_by'];
			
			
			require_once 'config.php';
			
			$sql	= "SELECT id FROM products ORDER BY id ASC";
			$res    = mysqli_query($con, $sql);
			$id     = 0; 
			$title  = "";
			$unique_post_id =  uniqid();
		
			
			while( $row = mysqli_fetch_array($res) ){
			$id		= $row['id'];
//$title  = $row['title'];
			}
			
			$path		= "uploads/$id.png";
			$actualpath	= "http://megamobilesystems.com/mega/bids/$path";
			$sql		= "INSERT INTO products (photo, name, description, start_amount, end_date, time_posted, posted_by, uid) VALUES ('$actualpath', '$name', '$desc', '$sb', '$be', NOW(), '$uploadedBy', '$unique_post_id' ) ";		
			//$last_id    = mysqli_insert_id($con);
			if( mysqli_query($con, $sql) ){
				file_put_contents($path, base64_decode($image) );
				
				$last_id    = mysqli_insert_id($con);
				echo $last_id;
			//die($sql);
			}
			
			//mysqli_close($con);
		else{
			//echo "Error!";
			printf("Error: %s\n", mysqli_error($con));
			die($sql);
			}
		
		
	//}
	}