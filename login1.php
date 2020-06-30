<?php 
require_once 'jwt/src/BeforeValidException.php';
require_once 'jwt/src/ExpiredException.php';
require_once 'jwt/src/SignatureInvalidException.php';
require_once 'jwt/src/JWT.php';

use \Firebase\JWT\JWT;
 
 //if($_SERVER['REQUEST_METHOD']=='POST'){
	 $username =  $_POST['username'];
	 $password =  $_POST['password'];
	 $uname = "";


$password = hash('sha256', $password);
    //for the firebase jwt
	$tokenId    = base64_encode(mcrypt_create_iv(32));
    $issuedAt   = time();
    //$notBefore  = $issuedAt + 10;             //Adding 10 seconds
    $expire     = $issuedAt +(60*60);
    $serverName = "firebase-adminsdk-ngktb@bidding-wars-28e79.iam.gserviceaccount.com";
    //$secretKey = base64_decode("-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC9848f+pB79Co6\n2IqKiFG9tpY1kJcDVclkWiG5Twl2KvgbwuxctwDciPdMwF/uM7icXKojCEN2aMED\n+CNfoW0rWhP0RSdY/2CLAmom+B/1i2U1WX+VQTVO84RbBGaMiUzQyxkPGSC11UUw\nPu7lFwmTKiiyI59V9TGPm8w51t+YS6H7z3qsn+E9RQYixZ9ysB3jGAjOHFxnSkzb\nJ3XeHaTswNwl7A25W7IaNlSLQlJWYwuYE01Ss64VykuwW8EGKKs1ByOBTzsu5Spv\nsRW/GF5dMfPeJGz+JIPFPmFgzIfMf+k4jsB7Bbs9LwRSQyAeBgec9YY9b6S5Fhxi\nW/tIVPe3AgMBAAECggEAAPRZQLsv8D1fxnFuTByScigZncMT8ucUswYashvf3dpr\nIFadLW1GBAn1+/7BXKYqWXb2cVZFPm2s9dRkbFLFgsE8Vtd5EzFjzTQz0ydq63De\nr7J/prcIQpQcuPkfOuGDSlZmFNR15U0HA3ZPaQRRZmaGQxuvCk5Uw7oFoJZh7huV\n+2lqG8C9AoIsvq3i/xb0w3fO+wndmxWccEIaBSZt04G0xk3lNUd7BRzPMOaf7DkF\nM4mVJeCyK/R2PBMTcEcMywQEFzBLr+lwWgPOubaR2blokMCdlsUCydvCP+/NUR5L\nzrlOBGUlvn9PCOrEJGEC1JGzDiLvwvoOPHcWq2bJzQKBgQDlCf3k5kRcteVbac3v\ndNi0yHyYofIrPPL6HapsOAM9oaU0qVnvKpyukVghgfaIj1tmeQEzZI47R6SifmVL\n+e9F7SuQpcV3NA/Mt9slqpXXJHNqHD7Cj+yQVfSJLsn6rrzfEHJKwQbRdzzp0sxO\nSMFBs3gDYh34hRWCUi60qJyWgwKBgQDUT60BeWhohX1FzNuaoHq3iN22igGbhdYJ\nvfBgEFdA6yIBP3hY3eKqf2HR8sqp1+cIYeDzQcps38ZhEaFY5xmjcN4A+Z7zFEBx\nfqso+d3KvS68SBk4n+ip45akoK8rnl89EGx3mij1OmfWsQUaWtLlWBJ6L9hKg45n\nethd899zvQKBgGZKGRcic8OIBP/Xd/6Ki8HpjCPKp9IBrW5g01zzgxcCWzryq1Sy\nDjm0dcy5MzZ399UDE7M1JIR7EZ70nh7ZZ7AuJPe74T3EhY3jSr8+uR7Vi6oHJUxV\nZMxtZwHhYJlRcs6YlMKoBHiGLTEsUMxhl9XU5jN0nXgBT8LdGzjZ2N0rAoGAFfr9\nvVZVceTIGG7iGXsd2VyJH7nf+rr7ctzAQyHN9sGhLqHkksa+DcrMVNEfHEBnAd4o\nTOb1zxnHzwrlOnAKnnoz8cPmKeJh3Z4wmDhuNuwpJ4MLYWpkyxnt4bNlD04BLDBE\nGonSTbkzQO3oyla22NmqaA4GBYjjOGFmfyudab0CgYBcaUpJsf+KliQBdMANHqkI\ng7OVxmZlT4rbNsKZQ9tq9CdyXiMLjOycSjo4+nIMpkWtdJZvQvMkK6CtCCi7vkFF\nz5Vc+DD5Pi2d2cBUqUv4WAKCiS5AFHuqh77j0KBIgRBdGDYCsnC3zqpUUVPtGaJM\n/oEA/LL80OD+kvD+Hw3HKA==\n-----END PRIVATE KEY-----\n");
    $secretKey  = "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC9848f+pB79Co6\n2IqKiFG9tpY1kJcDVclkWiG5Twl2KvgbwuxctwDciPdMwF/uM7icXKojCEN2aMED\n+CNfoW0rWhP0RSdY/2CLAmom+B/1i2U1WX+VQTVO84RbBGaMiUzQyxkPGSC11UUw\nPu7lFwmTKiiyI59V9TGPm8w51t+YS6H7z3qsn+E9RQYixZ9ysB3jGAjOHFxnSkzb\nJ3XeHaTswNwl7A25W7IaNlSLQlJWYwuYE01Ss64VykuwW8EGKKs1ByOBTzsu5Spv\nsRW/GF5dMfPeJGz+JIPFPmFgzIfMf+k4jsB7Bbs9LwRSQyAeBgec9YY9b6S5Fhxi\nW/tIVPe3AgMBAAECggEAAPRZQLsv8D1fxnFuTByScigZncMT8ucUswYashvf3dpr\nIFadLW1GBAn1+/7BXKYqWXb2cVZFPm2s9dRkbFLFgsE8Vtd5EzFjzTQz0ydq63De\nr7J/prcIQpQcuPkfOuGDSlZmFNR15U0HA3ZPaQRRZmaGQxuvCk5Uw7oFoJZh7huV\n+2lqG8C9AoIsvq3i/xb0w3fO+wndmxWccEIaBSZt04G0xk3lNUd7BRzPMOaf7DkF\nM4mVJeCyK/R2PBMTcEcMywQEFzBLr+lwWgPOubaR2blokMCdlsUCydvCP+/NUR5L\nzrlOBGUlvn9PCOrEJGEC1JGzDiLvwvoOPHcWq2bJzQKBgQDlCf3k5kRcteVbac3v\ndNi0yHyYofIrPPL6HapsOAM9oaU0qVnvKpyukVghgfaIj1tmeQEzZI47R6SifmVL\n+e9F7SuQpcV3NA/Mt9slqpXXJHNqHD7Cj+yQVfSJLsn6rrzfEHJKwQbRdzzp0sxO\nSMFBs3gDYh34hRWCUi60qJyWgwKBgQDUT60BeWhohX1FzNuaoHq3iN22igGbhdYJ\nvfBgEFdA6yIBP3hY3eKqf2HR8sqp1+cIYeDzQcps38ZhEaFY5xmjcN4A+Z7zFEBx\nfqso+d3KvS68SBk4n+ip45akoK8rnl89EGx3mij1OmfWsQUaWtLlWBJ6L9hKg45n\nethd899zvQKBgGZKGRcic8OIBP/Xd/6Ki8HpjCPKp9IBrW5g01zzgxcCWzryq1Sy\nDjm0dcy5MzZ399UDE7M1JIR7EZ70nh7ZZ7AuJPe74T3EhY3jSr8+uR7Vi6oHJUxV\nZMxtZwHhYJlRcs6YlMKoBHiGLTEsUMxhl9XU5jN0nXgBT8LdGzjZ2N0rAoGAFfr9\nvVZVceTIGG7iGXsd2VyJH7nf+rr7ctzAQyHN9sGhLqHkksa+DcrMVNEfHEBnAd4o\nTOb1zxnHzwrlOnAKnnoz8cPmKeJh3Z4wmDhuNuwpJ4MLYWpkyxnt4bNlD04BLDBE\nGonSTbkzQO3oyla22NmqaA4GBYjjOGFmfyudab0CgYBcaUpJsf+KliQBdMANHqkI\ng7OVxmZlT4rbNsKZQ9tq9CdyXiMLjOycSjo4+nIMpkWtdJZvQvMkK6CtCCi7vkFF\nz5Vc+DD5Pi2d2cBUqUv4WAKCiS5AFHuqh77j0KBIgRBdGDYCsnC3zqpUUVPtGaJM\n/oEA/LL80OD+kvD+Hw3HKA==\n-----END PRIVATE KEY-----\n";

 
 $sql = "SELECT * FROM users WHERE username='$username'  AND password='$password'  ";
 
 require_once('config.php');
 
 $result = mysqli_query($con,$sql);
 
 $check = mysqli_fetch_array($result);
 
	 if(isset($check)){
	 	while ($obj = mysqli_fetch_object($result)) {
	    	$uname= $obj->username;
	    	//$= $obj->username;
	}
	 $data = [
		'iat' => $issuedAt,
		'iss' => $serverName,
		'sub' => $serverName,
		'aud' => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
		'exp' => $expire,
		'uid' => "pammy"   //todo: replaace with username variable
	];

	$jwt = JWT::encode($data, $secretKey, "RS256");
	$unencodedArray = ['jwt' =>$jwt];
	echo json_encode((object)[
	 			"error"=>false,
	 			"jwt"  => $jwt
	 		]);

	//echo json_encode($unencodedArray);

	 }else{
	 echo json_encode((object)["error"=>true]);
	 }
 mysqli_close($con);
 //}