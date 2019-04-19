<?php
header('X-XSS-Protection:0');
set_time_limit(3000);
error_reporting(E_ALL);
include("class.grammar.php");
?>
<html>
  <head>
    <style>
      body {
        margin-left:2em;
        margin-top:1.2em;
      }
      h1 {
        margin-top:0px;
        padding-top:0px;
      }
    </style>
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <h1>Natural Grammar</h1>
      <em>automatic natural language correction.</em>
      <p>Paste text or choose a file from your computer. The result will be shown in the same box.</p>
      <hr>
      <input type="file" name="uploadedfile"> 
      <br>
      <hr>
      <textarea name="thetext" cols="120" rows="30"><?php 
		if($_FILES['uploadedfile']['error'] == UPLOAD_ERR_OK   && is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) { 
				// a file to process.
				$text 		= file_get_contents($_FILES['uploadedfile']['tmp_name']);
				$run 		= new grammar();
				$gram 		= $run->grammary($text);
				echo htmlspecialchars($run->tabs($gram),ENT_QUOTES,'UTF-8');
			} else {
				$run 		= new grammar();
				$gram 		= $run->grammary($_POST['thetext']);
				echo htmlspecialchars($run->tabs($gram),ENT_QUOTES,'UTF-8');
			}
		?></textarea>
      <br>
      <br>
      <input type="submit" name="Submit" value="Submit">
      <br>
      <br>
    </form>
	</body>
</html>
