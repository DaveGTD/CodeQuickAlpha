<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
<?php
require_once('include_functions.php');
session_start();
// If form submitted, then insert values into the database.
if (isset($_POST['email']))
{
  // removes backslashes
	$email = stripslashes($_REQUEST['email']);
	$email = trim($email);
  //escapes special characters in a string
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = trim($password);
	$password = mysqli_real_escape_string($con,$password);
	//Checking if user exists

        $query = "SELECT * FROM `users` WHERE email='$email'
				and password='".md5($password)."'";
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
        if($rows==1)
				{
						while($row = mysqli_fetch_assoc($result))
						{
							$username = $row['username'];
							$email = $row['email'];

							$_SESSION['username'] = $username;
							$_SESSION['email'] = $email;
							// Redirect user to index.php
							header("Location: index.php");
						}

				}
				else
				{
					echo "<div class='form'>
								<h3>Username/password is incorrect.</h3>
								<br/>Click here to <a href='login.php'>Login</a></div>";
				}

}
else
{

?>
	<div class="form">
	<h1>Log In</h1>
	<form action="" method="post" name="login">
	<input type="text" name="email" placeholder="Email" required />
	<input type="password" name="password" placeholder="Password" required />
	<input name="submit" type="submit" value="Login" />
	</form>
	<p>Not registered yet? <a href='form.php'>Register Here</a></p>
	</div>

<?php } ?>

	</body>
	</html>
