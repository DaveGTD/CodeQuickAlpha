<?php
require_once('include_functions.php');
session_start();


// var_dump($_REQUEST);


// If form submitted, insert values into the database.
if (isset($_REQUEST['user']))
	{
        // removes backslashes
	$username = stripslashes($_REQUEST['user']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);

	$email = stripslashes($_REQUEST['userEmail']);
	$email = mysqli_real_escape_string($con,$email);

	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);

	$full_name = stripcslashes($_REQUEST['userName']);
	$full_name = mysqli_real_escape_string($con, $full_name);

	$user_create_time= date('Y-m-d H:i:s');

	$practice = stripcslashes($_REQUEST['userPractice']);
	$practice = mysqli_real_escape_string($con, $practice);

	$insurance = stripcslashes($_REQUEST['userInsurance']);
	$insurance = mysqli_real_escape_string($con, $insurance);

	$insurance_custom = stripcslashes($_REQUEST['userInsuranceCustom']);
	$insurance_custom = mysqli_real_escape_string($con, $insurance_custom);

	$address = stripcslashes($_REQUEST['userAddress']);
	$address = mysqli_real_escape_string($con, $address);

	$city = stripcslashes($_REQUEST['userCity']);
	$city = mysqli_real_escape_string($con, $city);

	$state = stripcslashes($_REQUEST['userState']);
	$sate = mysqli_real_escape_string($con, $state);

	$zip = stripcslashes($_REQUEST['userZip']);
	$zip = mysqli_real_escape_string($con, $zip);

	$patients = stripcslashes($_REQUEST['userPatients']);
	$patients = mysqli_real_escape_string($con, $patients);

	$specialties = stripcslashes($_REQUEST['userSpecialties']);
	$specialties = mysqli_real_escape_string($con, $specialties);

	$specialties_custom = stripcslashes($_REQUEST['userSpecialtiesCustom']);
	$specialties_custom = mysqli_real_escape_string($con, $specialties_custom);

	// = stripcslashes($REQUEST['']);
	// = mysqli_real_escape_string($con, $);
	//
	// = stripcslashes($REQUEST['']);
	// = mysqli_real_escape_string($con, $);


	// NOTE: generating username:
	$username = strip($email);


	if(check_if_user_exits($email, $username))
	{
		echo "<h3> User $email already exists, Please try again: <h3>";
		echo "<br><a href='form.php'>Register</a>";
		return;
	}

	$query = "INSERT into `users` (username, password, email, user_create_time, full_name, practice, insurance, insurance_custom, address, city, state, zip, patients, specialties, specialties_custom)" .
	         " VALUES ('$username', '".md5($password)."', '$email', NOW(), '$full_name',  '$practice', '$insurance', '$insurance_custom', '$address', '$city', '$state', '$zip', '$patients', '$specialties', '$specialties_custom')";

  $result = mysqli_query($con,$query);



		if($result)
			{
							create_container_for_user($username);
	            echo "<h3>You are registered successfully.</h3> <br/>Click here to <a href='login.php'>Login</a></div>";
	  	}
		else
			{
			 			echo "MYSQL ERROR: " . mysqli_error($con);
			}


	}
	else
	{
			// form POST variables not set:
			echo "<h3> Incomplete form, Please register at: <h3>";
			echo "<br><a href='form.php'>Register</a>";
	}


?>
