<?php
require_once 'core/init.php';


	if (Input::exists()) {
		//if (Token::check(Input::get('token'))) {
			$validate   = new Validate();
			$validation = $validate->check($_POST, array(
					'username' => array('required' => true),
					'password' => array('required' => true)
				));

			if ($validation->passed()) {
				$user    = new User();
				$remember= (Input::get('remember') === 'on' ? true : false);
				$login   = $user->login(Input::get('username'), Input::get('password'), $remember);

				if ($login) {
					if ($user->find( Input::get('username') ) ) {
			  			$userdata = $user->data();
			  		}
					echo json_encode((object)[
			 			"error" => false,
			 			"username" => $userdata->username,
			 			"pic" => $userdata->propic,
			 			"message"  => "Success"
			 		]);
				}else{
					echo json_encode((object)[
						"error" => true,
						"message" => "Login failed! Please check your username and/or password!"
					]);
				}
			}else{
				foreach ($validation->errors() as $error) {
					echo json_encode((object)[
						"message" => $error
					]);
				}
			}
		//}
	}

?>
