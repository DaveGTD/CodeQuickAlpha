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


//Note: usering username as container

$user_coded_files = get_coded_files_list($username);






?>

<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>

<h3> List of downloadable files: </h3>

<br>
<?php
	foreach($user_coded_files as $f)
	{
		echo "<a href=\"test_download.php?file=$f\">Download: $f</a>";
		echo "<br>";
	}

?>

<br>

</body>
</html>
