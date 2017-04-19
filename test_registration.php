<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>

</head>
<body>
<?php
require_once('include_functions.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['username']))
	{
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$user_create_time= date('Y-m-d H:i:s');
  $query = "INSERT into `users` (username, password, email, user_create_time) VALUES ('$username', '".md5($password)."', '$email', NOW())";
  $result = mysqli_query($con,$query);



		if($result)
		{
	            echo "<div class='form'>
							<h3>You are registered successfully.</h3>
							<br/>Click here to <a href='test_login.php'>Login</a></div>";
	  }
		else {
			 			echo "MYSQL ERROR: " . mysqli_error($con);
		}


	}
	else
	{
		?>
			<div class="form">
			<h1>Registration</h1>
			<form name="registration" action="test_registration.php" method="post">
			<input type="text" name="username" placeholder="Username" required />
			<input type="email" name="email" placeholder="Email" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="submit" name="submit" value="Register" />
			</form>
			</div>
		<?php
	}
?>
	</body>
	</html>
