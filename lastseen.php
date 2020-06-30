<?php

function timeAgo($time_ago)
{
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
  
  if($hours <=24){
    return "last seen @ ";
            //return "$hours hrs ago";
        
    }
    //Days
    else if($days <= 7){
       return "last seen @ friday";
        
    }
    //Weeks
    else if($weeks <= 4.3){
        
            return "last seen full date";
        
    }
    //Months
    else if ($months <=12){
        
            return "last seen full date";
        
    }
     else{
        
        return "last seen full date plus year";
        
    }
    
}

echo timeAgo("2017-10-26 02:43:54");
