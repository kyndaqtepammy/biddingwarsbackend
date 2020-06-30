<script type="text/javascript">
	var myVar = setInterval(myTimer, 1000);

	function myTimer() {
	    location.reload();
	}
</script>
<?php
	//if($_SERVER['REQUEST_METHOD']=='POST'){
	 $postId     = $_POST['post_id'];
	 $post_title = $_POST['post_title'];

		$sql = "SELECT * FROM mult WHERE id='$postId' "; //todp:  AND staus='active'
 		require_once('config.php');

 		$result = mysqli_query($con,$sql); 
		
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_array($result)) {
		        $be = $row["be"];
		        echo $be;
		    }
		} else {
		    echo "0 results";
		}

    //}		 
?>

<!-- Display the countdown timer in an element -->
<p id="demo"></p>

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
 //
 //
 //THERE WERE ONCE CLOSING TAGS HERE.
var highestRef= firebase.database().ref().child("highest");
var bidsRef   = firebase.database().ref().child("bids");
var notifyRef = firebase.database().ref().child("notifications");
var postID    = "<?php echo $postId ?>";
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $be ?>").getTime();  //new Date("Sep 15, 2017 10:18:00").getTime();
//alert(countDownDate);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);

   highestRef.on("child_added", function(data, prevChildKey) {
   var winner = data.val();
 

  var winnerName = winner.winnerName;
  var amount     = winner.winnerAmt;
  var postTitle  = winner.postTitle;
   
  console.log("post title: " + postTitle);
  console.log("wiining amout: " + amount);
  console.log("winner name: " + winnerName);

   notifyRef.push().set({
   	 winner: winnerName,
   	 postID: postID,
   	 postTitle: postTitle,
   	 amount: amount
   });
});




    document.getElementById("demo").innerHTML = "Ended";
  }
}, 1000);
</script>