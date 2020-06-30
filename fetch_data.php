<?php 

function timeAgo($time_ago){
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
	
	require_once('config.php'); 
		$sql = "SELECT * from mult WHERE status = 'active' ORDER BY id DESC";

		//Getting result 
		$result = mysqli_query($con,$sql); 
		
		//Adding results to an array 
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			
			array_push($res, array(
                 "id"   =>$row['id'],
				 "images"=>$row['imgs'],
				 "title"=>$row['title'],
				 "description"=>$row['descr'], 
				 "sb"=>$row['sb'], 
				 "be"=>date_format(new DateTime($row['be']), 'l d M'),
				 "coll"=>$row['coll'],
				 "time"=>timeAgo($row['time_posted']),
				 "postedBy"=>$row['postedby'],
				 "timeLeft"=>$row['millisecs'], 
				 "posterPic"=>$row['posterPic']
				)
				);
		}
		
		if(!$result){
		printf("Error: %s\n", mysqli_error($con));
    exit();	
		}
		//Displaying the array in json format 
		echo json_encode($res);?>