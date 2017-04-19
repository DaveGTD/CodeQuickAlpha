<?php

	require_once("auth.php");
	require_once('include_functions.php');

	$username = $_SESSION['username'];
	$email = $_SESSION['email'];

?>

<!doctype html>
<html>
<head>
<title>Code Quick</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta charset="utf-8" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css" type="text/css">
<script src="/js/jquery.min.js"></script>
<script src="/js/practice-info.js"></script>
</head>
<body>

<div id="header">
  <div id="logo">
    <svg id="codequick-logo" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 302 340">
    	<path d="M287.8,182.5h-37.5c-7.3,0-13.2,6-13.2,13.2v18.6v8.8c0,7.3-6,13.2-13.2,13.2H217l18.6,64.5h0c36,0,65.3-29.3,65.3-65.3 v-21.3v-18.6C301,188.5,295,182.5,287.8,182.5z"/>
    	<path d="M185.5,338.4c-7.4,0-11.3-2.9-13.4-10.1l-32.3-113c-1.1-3.9-0.3-8.3,2.1-11.5c2-2.6,4.9-4.2,7.9-4.2h39 c7.4,0,12.4,3.9,14.5,11.2l32.3,111.9c1,3.6,0.2,7.6-2.2,10.9c-2.3,3.1-5.5,4.8-8.9,4.8H185.5z"/>
    	<path d="M235.7,1H66.3C30.3,1,1,30.3,1,66.3v169.4c0,36,29.3,65.3,65.3,65.3H158l-18.5-64.5H79.3c-7.3,0-13.2-6-13.2-13.2V78.8 c0-7.3,6-13.2,13.2-13.2h144.5c7.3,0,13.2,6,13.2,13.2v9.9v17.6c0,7.3,6,13.2,13.2,13.2h37.5c7.3,0,13.2-6,13.2-13.2V88.7V66.3 C301,30.3,271.7,1,235.7,1z"/>
    </svg>
  </div>
  <ul id="nav">
    <li><a href="/" <?php if($page == 'upload') { echo 'class="active"'; } ?>>Upload</a></li>
    <li><a href="/my-charts.php" <?php if($page == 'charts') { echo 'class="active"'; } ?>>My Charts <span class="noti-num">2</span></a></li>
    <li><a href="/help.php" <?php if($page == 'help') { echo 'class="active"'; } ?>>Help</a></li>
  </ul>
  <div id="nav-right">
    <div class="wrap">
      <div class="drop-target">
        <a><?php echo $email; ?> <span class="arrow-down"></span></a>
        <div class="dropdown">
          <ul>
            <li><a href="/practice.php">Practice Info</a></li>
            <li><a href="/account.php">My Account</a></li>
            <li><a href="#">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
