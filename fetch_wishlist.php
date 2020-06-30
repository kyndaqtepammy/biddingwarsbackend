<?php 
	require_once('config.php'); 
		//select all the titles from products(mult) table
		$sql = "SELECT descr from mult";


		$res = mysqli_query($con,$sql); 
		//all the titles looped through
            foreach($res as $r){
            	//$word =  $r['descr'];
            	$word = "farming things";
            	 //echo $word.'</br>';

            	//for each of all the words
            	$getw = "SELECT * FROM wishlist inner join mult on wishlist.category = mult.descr WHERE levenshtein('$word', category)< 7 ";//category like 'new chanel handbags'
            	$result= mysqli_query($con, $getw);
            	while( $row = mysqli_fetch_array($result) ){
					echo '<h2>'.$row['id'].$row['uname'].'</h2>';die();

				}
		
		
            }

           
		if(!$result){
		printf("Error: %s\n", mysqli_error($con));
    exit();	
		}
		//echo json_encode($res);?>