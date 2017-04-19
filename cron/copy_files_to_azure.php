<?php

$con = mysqli_connect("104.154.28.180", "remote", "remoteroot", "code_quick");

// check database connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error() . "\n";
	exit(-1);
}


// copy all uploaded files to azure blob
$directory = '/uploads';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));

foreach($scanned_directory as $file)
{
    if (!is_dir("$directory/$file"))
    {
			$cmd = "java -jar /root/copy_azure-1.0.0.jar $file";
      exec($cmd, $out_one, $ret);

			echo $out_one[0] . "\n";
      echo $out_one[1] . "\n";

			$db_entry_updated = update_status_to_azure_uploaded($file);

				if($ret == 0 && $db_entry_updated)
				{
					echo "Deleting $file \n";
					$del_cmd = "rm -f $directory/$file";
					exec($del_cmd, $out_two, $ret);

					// Output to this is empty
					//$out_two[0];

					if($ret != 0)
					{
						echo "Could not delete $file";
					}
				}

		// main if block
    }

}

// change status in DB
function update_status_to_azure_uploaded($file)
{
	global $con;
	$sql = "UPDATE customer_files SET uploaded_to_azure=1, time_of_upload=NOW() WHERE full_upload_name='$file'";
	if ($con->query($sql) === TRUE)
		{
    	echo "Record updated successfully $file \n";
			return true;
		}
	else
		{
    	echo "Error updating record $file " . $con->error . "\n";
			return false;
		}
}


?>
