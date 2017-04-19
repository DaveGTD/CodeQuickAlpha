<?php

require_once('test_auth.php');
require_once('include_functions.php');

$username = $_SESSION['username'];

// $user_email = get_user_email($username);
//
// if($user_email != ERROR)
// 	{
// 		echo $user_email;
// 	}

// azure batch_id
$batch_id = time();



if (!empty($_FILES)) {

		//Get the temp file path
		$tmpFilePath = $_FILES['file']['tmp_name'];


		//save the filename
		$user_file_name = $_FILES['file']['name'];
		$user_file_name = preg_replace('/\s+/', '', $user_file_name);
		$cq_file_name = $username . ":" . $batch_id . ":" . $user_file_name;

		//save the url and the file
		$filePath = "/uploads/" . $cq_file_name;


		//Upload the file into the temp dir
		if(move_uploaded_file($tmpFilePath, $filePath))
			{
				new_file_uploaded($cq_file_name, $username, $user_file_name, $batch_id);
			}


}



?>
