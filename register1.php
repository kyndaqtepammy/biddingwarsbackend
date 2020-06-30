<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values 
 $name     = $_POST['name'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $email    = $_POST['email'];
 $image    = $_POST['image'];
 
 require_once 'config.php';

 
 $sql 			= "SELECT * FROM users WHERE email LIKE'".$email."'  OR username LIKE  '".$username."'  ";
 $result 		= mysqli_query($con, $sql);

 $id     = 0; 		
 // while( $row = mysqli_fetch_array($result) ){
 //   $id		 = $row['id'];
 // }
  $path		= "propics/$id.png";
  $actualpath	= "http://bids.co.zw/bids/$path";
 
 
 
 if( mysqli_num_rows($result) >0 ){
		echo "That username already exists!"; 
 }else{
	 $sql = "INSERT INTO  users (name, username, password, email, propic)  VALUES ('$name', '$username', '$password', '$email', '$actualpath')  ";
     $result = mysqli_query($con,$sql);
     if( $result ){
				file_put_contents($path, base64_decode($image) );
			//	echo "Your image was uploaded successfully";
				echo $actualpath;
			}else{
			    echo "An error occured!";
			} 
	
	 echo "success";
 }
 
 
}




