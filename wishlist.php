<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	 require_once('config.php');

 //Getting values 
 $username  = $_POST['username'];
 $cat 		= $_POST['cat'];
 $desc 		= $_POST['desc'];
 $price 	= $_POST['price'];

 
 $sql = "INSERT INTO wishlist(uname, category, products, price) VALUES( '".$username."', '".$cat."', '".$desc."', '".$price."' )";
 
 $result = mysqli_query($con,$sql);

 if ($result) {
 	echo "success";
 }else{
 	echo "non";
 }

 mysqli_close($con);
 }