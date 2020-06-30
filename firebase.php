<?php
	/*
    * This function will make the actuall curl request to firebase server
    * and then the message is sent 
    */
    require_once 'config.php';
     
function sendFCM($mess,$id) {
$url = 'https://fcm.googleapis.com/fcm/send';
$fields = array (
        'to' => $id,
        'notification' => array (
                "body" => $mess,
                "title" => "Title",
                "icon" => "myicon"
        )
);
$fields = json_encode ( $fields );
$headers = array (
        'Authorization: key=' . FIREBASE_API_KEY,
        'Content-Type: application/json'
);

$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, true );
curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

$result = curl_exec ( $ch );
//var_dump($result);
curl_close ( $ch );
}

sendFCM("HELLO WORLD!", "e160Zo_89Vc:APA91bH5Q23eeukX0pwuD2FKgQOVb8z7g7MX4OHjKOKnAu8tg5YXOzoRbCeLZ5WKtKq9_UyvWrDsNwiJpAa5EGnLG8uHE2dKorUbcKFOEWPhGFhtG2aL_RHRrK3lI-2XU1B1ZslxJYfS");

?>

