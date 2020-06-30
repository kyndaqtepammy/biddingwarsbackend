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
<?php
	$postID  = $_POST['postID'];
    $posttitle = $_POST['postname'];
    $amount    = $_POST['amount'];
    $winnername= $_POST['winnername'];
?>
<script type="text/javascript">
	var likesByPost = firebase.database().ref("likesByPost").child("<?php echo $postID  ?>");
	likesByPost.once('value', function(snapshot){
		snapshot.forEach(function(child){
			console.log(child.key);

		});
		
	});
</script>


<?PHP
	function sendMessage(){
       
		
		$content = array(
			"en" => "A post that you liked, ".$posttitle." has a new high bid at $".$amount
			);
		$filters = array(array("field" => "tag", "key" => "username", "relation" => "=", "value" => $receiver));

		//var_dump($filters); die();
		
		$fields = array(
			'app_id' => "6ce0e1b4-1839-4b6d-b4b2-05c06127953e",
			'filters' => $filters, 
			//'include_player_ids' => array('3b66c906-9510-4bf2-b36d-f8540a3bf8e4'),
      		'data' => array(
      			"foo" => "bar", 
      			"activityToBeOpened" => "NewPostActivity"
      			),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic NGFmM2FiNzctNmMwMy00NWI1LWFmNzAtNDFlNDUxMDlkYzFl'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
		}
	
	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
  print("\n\nJSON received:\n");
	print($return);
  print("\n");
?>