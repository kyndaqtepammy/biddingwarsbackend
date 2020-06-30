<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "bids");
	define("FIREBASE_API_KEY", "AAAAdMeqpfU:APA91bHYVhriSzlUg-OybsT7qP_mVhu1OmD3rTE3146h4nsOwuqsawRfQq6hUWKu52ZuP0U6BF-7OQu9fL9ao4Cya4hfX6Vk26DNvzMX9p90DhJ9fTsvOOBTO2d6D24ycrRS0_mVbifp");
	
	$con		= mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("unable to connect");
	

