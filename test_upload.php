<?php

require_once('test_auth.php');
require_once('include_functions.php');








?>

<html>
<head></head>

<body>
	<form action="test_upload_submit.php" class="dropzone" id="file_uplaod" enctype="multipart/form-data" method="post">

				<div>
						<label for='upload'>Add Attachments:</label>
						<input id='upload' name="upload[]" type="file" multiple="multiple" />
				</div>

				<p><input type="submit" name="submit" value="Submit"></p>


	</form>

</body>

</html>
