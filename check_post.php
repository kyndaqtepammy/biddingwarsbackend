<?php
	$postid = $_POST['postID'];

	require_once 'config.php';

	$sql = "SELECT id FROM mult WHERE id = '$postid'";

	$result = mysqli_query($con, $sql);

	//echo mysqli_num_rows($result);die();

	if( mysqli_num_rows($result)  > 0 ){
		echo json_encode((object)[
			"deleted" => false
			]);
	}else{
		echo json_encode((object)[
			"deleted" => true
			]);
	}