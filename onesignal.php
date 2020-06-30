<?php
	function sendMessage(){
		$content    = array("en"=> "English message");
		$fields		= array(
			'app_id'=> "6ce0e1b4-1839-4b6d-b4b2-05c06127953e",
			'included_segments' => array('All'),
			'data' => array("foo" => "bar"),
			'contents' => $content

			);

		$fields    = json_encode($fields);

		print("\nJSON sent: \n");
		print($fields);

		$ch    = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notificationsS"); //add url here please
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf8', 'Authorization: Basic NGFmM2FiNzctNmMwMy00NWI1LWFmNzAtNDFlNDUxMDlkYzFl') ); //add auth key here
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response   = curl_exec($ch);
		return $response;
	}


	$response = sendMessage();
	$return["allresponses"] = $response;
	$return = json_encode($return);


	print("\nJSON received: \n");
		print($return);
		print("\n");
