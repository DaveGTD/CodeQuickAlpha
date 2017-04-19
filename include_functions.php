<?php

require_once("azure_php/azure_functions.php");

define("ERROR", -1);

$con = mysqli_connect("104.154.28.180", "remote", "remoteroot", "code_quick");

// check database connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "\n";
}

function display_error($error_message)
{
	header("Location: test_error_page.php?message=$error_message");
	exit();
}


function upload_file($specialty, $file_name, $user_email, $batch_id)
{
	 $blob_name = $specialty . "_" . $user_email . "_" . $batch_id . "_" . $file_name;

	 $azure_upload_status = uploadToAzure($specialty, $file_name, $blob_name);

	 if($azure_upload_status == true)
	 {
		 	return "Successfully uploaded $file_name";
	 }
	 else
	 {
	 		return "Failed to upload $file_name";
	 }

}

function get_user_email($username)
{
	global $con;
	// assumes email is the primary key in the database
	$query = "SELECT email FROM users WHERE username='$username'";
	$result = mysqli_query($con,$query);

	if(!$result)
		{
			$error_message =  "MYSQL ERROR: " . mysqli_error($con);
			display_error($error_message);
		}

	if (mysqli_num_rows($result) > 0)
		{
  		while($row = mysqli_fetch_assoc($result))
				{
					$email = $row['email'];
					return $email;
  			}
		}
	else
		{
    	return ERROR;
		}

}

function download_file_to_client_stream($file)
{
	$local_file = '';
	$download_file = '';

	// set the download rate limit (=> 20,5 kb/s)
	$download_rate = 20.5;
	if(file_exists($local_file) && is_file($local_file))
	{
	    header('Cache-control: private');
	    header('Content-Type: application/octet-stream');
	    header('Content-Length: '.filesize($local_file));
	    header('Content-Disposition: filename='.$download_file);

	    flush();
	    $file = fopen($local_file, "r");
	    while(!feof($file))
	    {
	        // send the current file part to the browser
	        print fread($file, round($download_rate * 1024));
	        // flush the content to the browser
	        flush();
	        // sleep one second
	        sleep(1);
	    }
	    fclose($file);}
	else {
	    die('Error: The file '.$local_file.' does not exist!');
	}

}


function download_file_to_client($file)
{
	if(file_exists($file)) {
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.basename($file));
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					ob_clean();
					flush();
					readfile($file);
					unlink($file);
					exit;
			}
}

function create_container_for_user($username)
{
	return create_container($username);
}


function get_coded_files_list($username)
{
	//Note: usering username as container
	return list_blobs_in_container($username);
}

function get_archived_files_list($username)
{
	global $con;
	$files = array();
	$sql = "SELECT * FROM customer_files WHERE username='$username' AND downloaded=1";
	$result = mysqli_query($con,$sql);

	if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
				{
					$full_upload_name = $row['full_upload_name'];
					array_push($files, $full_upload_name);
				}
		}

	return $files;
}

function new_file_uploaded($full_upload_name, $username, $file_name, $batch_id)
{
	global $con;
	$sql = "INSERT INTO customer_files (full_upload_name, username, file_name, batch_id) VALUES ('$full_upload_name', '$username', '$file_name', $batch_id)";
	if (!mysqli_query($con, $sql))
		{
    	$error_message = "Error: " . $sql . "<br>" . mysqli_error($con);
			error_log($error_message, 0);
			// TODO: dispaly error won't work here (because it's called via AJAX POST) so implement better error handling
			// display_error($error_message);
		}
}



function update_as_downloaded($username, $file)
{
	global $con;
	// change this to full_download_name at some point
	$sql = "UPDATE customer_files SET downloaded=1, time_of_download=NOW() WHERE full_upload_name='$file'";
	if ($con->query($sql) === TRUE)
		{
			return true;
		}
	else
		{
    	$error_message = "Error updating downloaded=1 record $file " . $con->error . "\n";
			error_log($error_message, 0);
			return false;
		}
}


function populate_file_details($full_upload_name, &$time_of_upload, &$file_id, &$batch_id, &$file_name)
{
	global $con;
	$sql = "SELECT * FROM customer_files WHERE full_upload_name='$full_upload_name'";
	$result = mysqli_query($con,$sql);

	if(!$result)
		{
			$error_message =  "MYSQL ERROR: " . mysqli_error($con);
			error_log($error_message);
			display_error($error_message);
			return false;
		}

	if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
				{
					$time_of_upload = $row['time_of_upload'];
					$file_id = $row['file_id'];
					$batch_id = $row['batch_id'];
					$file_name = $row['file_name'];
				}
		}
	else
		{
			return false;
		}

}


function populate_user_details($email, &$practice, &$address, &$city, &$state, &$zip, &$patients, &$insurance, &$insurance_custom, &$ehr, &$ehr_custom, &$specialties)
{
	global $con;
	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($con,$sql);

	if(!$result)
		{
			$error_message =  "MYSQL ERROR: " . mysqli_error($con);
			error_log($error_message);
			display_error($error_message);
			return false;
		}

	if (mysqli_num_rows($result) > 0)
		{
				while($row = mysqli_fetch_assoc($result))
					{
						 $practice = $row['practice'];
						 $address = $row['address'];
						 $city = $row['city'];
						 $state = $row['state'];
						 $zip = $row['zip'];
						 $patients = $row['patients'];
						 $insurance = $row['insurance'];
						 $insurance_custom = $row['insurance_custom'];
						 $ehr = $row['ehr'];
						 $ehr_custom = $row['ehr_custom'];
						 $specialties = $row['specialties'];

					}
		}
	else
		{
				return false;
		}

}

function check_if_user_exits($email, $username)
{
	global $con;
	$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);
 	if($num_rows > 0)
		 {
			 	return true;
		 }
 return false;
}


function strip($string)
{
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
	 $string = str_replace('.', '', $string);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

?>
