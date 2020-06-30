<?php
require_once 'core/init.php';
 if (Session::exists('home')) {
 	echo Session::flash('home');
 }

$user   = new User();

if($user->isLoggedIn() ){
	?>	
	<h1>Admin Dashboard</h1>


	<p><a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?> </a></p>
	<ul>
		<li>
			<a href="logout.php">Log out</a>	
		</li>
		<li>
			<a href="update.php">Update profile</a>	
		</li>
		<li>
			<a href="changepassword.php">Change Password</a>	
		</li>
	</ul>
<?php
if (!$user->hasPermission('admin')) {
	//redirect to index page
	Redirect::to('index.php');
}


	}else{
		echo '<p><a href="login.php">Login</a> or <a href="register.php">Register</a>';
	}