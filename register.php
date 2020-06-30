<?php
	require_once 'core/init.php'; 
	if ( Input::exists() ) {
			  //$image = Input::get('image');
			
		 	  $validate   = new Validate();
			  $validation = $validate->check($_POST, array(
			    'username' => array(
			       	'required'  => true,
			       	'min'		=> 5,
			       	'max'		=> 20,
			       	'unique'	=> 'users'
			      	),
			    'password'	=> array(
			    	'required'	=> true,
			    	'min'		=> 6
			    ), 
			    // 'password_again'=> array(
			    // 	'required'	=> true,  
			    // 	'matches'	=> 'password'
			    // 	),
			    'name'		=> array(
			    	'required'	=> true,
			    	'min'		=> 2,
			    	'max'		=> 50
			    ),
			    'email' => array(
			    	'required' => true,
			    	'unique' => 'users'
			    )	  	 

			  	) );


			  if ($validation->passed()) {
			  	// $path		= "propics/".Input::get('username').".png";
	  			// $actualpath	= BASE_URL."$path";
	  			// file_put_contents($path, base64_decode($image) );
			  	//register user
			  	$user = new User();
			    $salt = Hash::salt(32);

			  	try{
			  		
			  		$user->create(array(
			  			'username' => strtolower(Input::get('username')),
			  			'password' => Hash::make( Input::get('password'), $salt ),
			  			'email' => strtolower(Input::get('email')),
			  			'salt' => $salt,
			  			'name' => ucwords(Input::get('name')),
			  			'joined' => date('Y-m-d H:i:s'),
			  			'group' => 0,
			  			'uid' => uniqid(time()),
			  			'phone_number' => "",


			  		));
			  		$lastID = DB::getInstance()->getLastID();
			  		if ($user->find($lastID)) {
			  			$userdata = $user->data();
			  		}

			  		
			  		echo json_encode((object)[
						"error"   => false,
						"uid" 	  => $userdata->uid,
					 	"username"=> $userdata->username,
					 	"name" 	  => $userdata->name, 
					 	"email"   => $userdata->email,
					 	"message" => "Registration was successful"
					 	//"propic"  => $userdata->propic
					]);

			  	}catch(Exception $e){
			  		die($e->getMessage()); //can redirect user here
			  	}

			  }else{
			  	//outPut errors
			  	foreach ($validation->errors() as $error) {
			  		echo json_encode((object)[
			  			"error" => true,
						"message" => $error
					]);
			  	}
			  }


		 //}


	}


?>