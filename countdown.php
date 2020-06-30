<?php
  require_once('config.php'); 

  $post_id = $_POST['post_id'];

  $sql  = "SELECT * FROM mult where id = '$post_id' ";
  $result = mysqli_query($con,$sql); 

  while($row = mysqli_fetch_array($result)){
    $be  = $row['be'];
    }

      if(!$result){
    printf("Error: %s\n", mysqli_error($con));
    exit(); 
    }else{
      //echo $be;
    }

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
</script>

<script>
var rootref   = firebase.database().ref().child("winners");
var bidsRef   = firebase.database().ref().child("bids");
// Set the date we're counting down to
var countDownDate = "<?php echo $be ?>";  //new Date("Sep 15, 2017 10:18:00").getTime();
alert(countDownDate);

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
    rootref.push().set("winn");
    document.getElementById("demo").innerHTML = "Ended";
    // $.ajax({
    // 	url:"contdown_controler.php",
    // 	type:GET,
    // 	data:{
    // 		postID:"9"
    // 	},
    // 	success:function(retData){
    // 		$('.demo').html(retData);
    // 		console.log("success");
    // 	},
    // 	error:function(xhr, ajaxOptions, thrownError){
    // 		console.log(xhr.status + " " thrownError);
    // 	}
    // });

  }
}, 1000);
</script>