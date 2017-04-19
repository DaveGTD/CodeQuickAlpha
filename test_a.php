<?php

require_once('test_auth.php');
require_once('include_functions.php');

$username = $_SESSION['username'];

?>

<html>

<head>

<!-- 1 -->
<link href="resources/dropzone.css" type="text/css" rel="stylesheet" />

<!-- 2 -->
<script src="resources/dropzone.js"></script>>

</head>

<body>

<!-- 3 -->
<form action="test_a_submit.php" class="dropzone"></form>

</body>

</html>
