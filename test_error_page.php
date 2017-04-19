<?php

// use this page to display error messages

$error_message = $_GET['message'];

if(!$error_message)
	{
		echo "SOMETHING WENT WRONG! Please report this incident to code quick ";
	}

echo $error_message;


?>
