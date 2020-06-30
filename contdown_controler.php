<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDfQz9CyhE4cKrOwi9CCWvPaxlSwzQHufo",
    authDomain: "bidding-wars-28e79.firebaseapp.com",
    databaseURL: "https://bidding-wars-28e79.firebaseio.com",
    projectId: "bidding-wars-28e79",
    storageBucket: "bidding-wars-28e79.appspot.com",
    messagingSenderId: "501566055925"
  };
  firebase.initializeApp(config);
</script>

<script type="text/javascript">
	//var myVar = setInterval(myTimer, 6000);
	var getWinnerRef = firebase.database().ref("highest");
  var winners      = firebase.database().ref("winners");

	// function myTimer() {
	//     location.reload();
	// }


	// function jsfunction(){
	// 	//console.log("im running");
	// }
</script>

 DATEDIFF(CONVERT_TZ( NOW() , '+00:00', '+06:00' ), 2018-03-27 17:30:00' )
<?php
 //Creating sql query
 $sql = "SELECT id FROM mult WHERE   DATEDIFF(NOW(), '2018-03-27 17:30:0' ) >= 0";
 
 require_once('config.php');
 $ended = array();
 if (mysqli_query($con, $sql)) {
	$result = mysqli_query($con,$sql); 

  while ( $row = mysqli_fetch_assoc($result) ) {
    	//print_r ( $row["id"]);
  		foreach ($row as $ids) {
  			# code...
           // $id=$ids['id'];
  			$updateRows = "UPDATE mult SET status ='ended' WHERE id='$ids' ";
  			//$ids = json_encode($ids
             
  		}
  		if (mysqli_query($con, $updateRows)) {
			    //echo "Record updated successfully";
			} 
       array_push($ended, $ids);
        //print_r($ended); 

		 }  

}

 ?>
 <script type="text/javascript">
  var dataValues;

  getWinnerRef.once("value")
  .then(function(snapshot) {
    snapshot.forEach(function(childSnapshot) {
        key = childSnapshot.key;
        // childData will be the actual contents of the child
        
       
        var childData = childSnapshot.val();
         dataValues = JSON.stringify(childData);
        alert(dataValues.winnerName);
         winners.child(key).set(childData);

       
       
   });
     
});


   
 </script>





