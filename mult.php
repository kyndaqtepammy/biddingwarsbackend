<?php
require_once 'core/init.php';
require_once 'config.php';

if(isset($_POST['imgarr'])    ) {

    $title = $_POST['title'];
    $desc  = $_POST['desc'];
    $sb    = $_POST['sb'];
    $be    = $_POST['be'];
    $millis= $_POST['millisecs'];
    $coll  = $_POST['coll'];
    $posted= $_POST['postedBy'];
    $uid   = uniqid();

    $data = explode(",", $_POST['imgarr']);
    $insertArray = array();

  
    foreach ($data as $img) {
        $t=time()."_".uniqid();
        $path = "uploads/$t.png";
        file_put_contents($path, (base64_decode($img)) );
        $actualpath = BASE_URL.$path;
        echo $actualpath.",";
        array_push($insertArray, $actualpath);

    }
    //print_r($insertArray);
    $images = implode(",", $insertArray);
    //echo $images;

    $sql2 = "SELECT propic from users WHERE username = '".$posted."'  ";
    $result = mysqli_query($con,$sql2);

    
   if($result){
         while ($obj = mysqli_fetch_object($result)) {
            $posterPic  = $obj->propic;
        }

   }else{
     printf("Error: %s\n", mysqli_error($con));
     $posterPic = "";
   }

//var_dump($posterPic);
//die();


    $sql = "INSERT INTO mult(imgs, title, sb, be, millisecs, coll, descr, postedby, time_posted, uid, status, posterPic) VALUES ('$images', '$title', '$sb', '$be', '$millis', '$coll', '$desc',  '$posted', NOW(), '$uid', 'active', '$posterPic')";

    if( mysqli_query($con, $sql) ){
        echo "success";

    }else{
       printf("Error: %s\n", mysqli_error($con));

    }

   }
    else {
       die('no post data to process');
    }








