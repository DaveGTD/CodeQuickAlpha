<?php
require_once('test_auth.php');
require_once('include_functions.php');

$username = $_SESSION['username'];

$user_email = get_user_email($username);

if($user_email != ERROR)
	{
		echo $user_email;
	}

// azure batch_id
$batch_id = time();

// upload cq file name=> user_email:batch_id:file_name

if(isset($_POST['submit']))
	{
		if(count($_FILES['upload']['name']) > 0)
			{
      	//Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++)
					{
          	//Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != "")
							{

                //save the filename
                $user_file_name = $_FILES['upload']['name'][$i];
								$cq_file_name = $user_email . ":" . $batch_id . ":" . $user_file_name;

                //save the url and the file
                $filePath = "/uploads/" . $cq_file_name;


                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath))
									{
                  	$files[] = $user_file_name;
                	}
						  }
					// closing loop for each file
					}
			}



	//show success message
	echo "<h1>Uploaded:</h1>";
	if(is_array($files))
		{
	      echo "<ul>";
	      foreach($files as $file)
					{
	        	echo "<li>$file</li>";
	        }
	      echo "</ul>";
	  }

	//closing if $_POST['submit']
	}

?>
