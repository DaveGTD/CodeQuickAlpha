<?php

require_once('test_auth.php');
require_once('include_functions.php');



$blob_name = $_REQUEST['file'];


$username = $_SESSION['username'];
//Note: usering username as container
$container = $username;

if(update_as_downloaded($username, $blob_name))
	{
		downloadBlob($container, $blob_name);
		$server_file_path = "/tmp_downloads/$blob_name";
		download_file_to_client($server_file_path);
	}
else
	{
		error_log("Could not download file for $username => $blob_name");
	}

?>
