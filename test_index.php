<?php
//include auth.php file on all secure pages
require_once("test_auth.php");
require_once('include_functions.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>

</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>
<p><a href="test_app_one.php">App</a></p>
<a href="test_logout.php">Logout</a>
</div>
</body>
</html>
