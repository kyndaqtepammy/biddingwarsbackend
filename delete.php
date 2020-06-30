<?php

	
 if($_SERVER['REQUEST_METHOD']=='POST'){
	//Getting values 
 	$postid	  = $_POST['postID'];
 	
	require_once 'config.php';

	$sql = "DELETE FROM mult WHERE id = '".$postid."' ";

	if (mysqli_query($con, $sql) ) {
		# code...
		echo $postid;
	}else{
		mysqli_error($con);
	}



}