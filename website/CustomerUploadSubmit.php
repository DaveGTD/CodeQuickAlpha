<?php

include("auth.php");
require_once("../include_functions.php");

echo "<br> Hello: " . $_SESSION['username'] . "<br>";

if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){

                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = "/uploads/" . date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];


                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;

										//azure upload
										$file_name = $tmpFilePath;
										$specialty = 'radiology';
										$user_email = 'abc@abc.com';
										$batch_id = time();
										upload_file($specialty, $file_name, $user_email, $batch_id);

                    //insert into db
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                }
              }
        }
    }

    //show success message
    echo "<h1>Uploaded:</h1>";
    if(is_array($files)){
        echo "<ul>";
        foreach($files as $file){
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
}
?>
