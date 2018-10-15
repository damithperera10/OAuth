<?php
//Import the google api php client library
require_once(realpath(dirname(__FILE__) .'/google-api-php-client/vendor/autoload.php'));

session_start();

$redirectEndPoint = 'http://'.$_SERVER['HTTP_HOST'].'/OAuth-2.0-framework/authenticate.php';

$client = new Google_Client();

// Config data
$client->setAuthConfig('secret_data.json');

$client->addScope(Google_Service_Drive::DRIVE_FILE);

if (isset($_SESSION['Access_Token']) && $_SESSION['Access_Token']) {

	if (is_uploaded_file($_FILES['fileName']['tmp_name'])) {

		//gaccess token
		$client->setAccessToken($_SESSION['Access_Token']);

		//Create a new object to access Google Drive service
  		$drive = new Google_Service_Drive($client);

  		//Get the file name
  		$file_name = $_FILES['fileName']['name'];
		  
		//Set the file name to be stored
		$fileData = array(
			'name' => $file_name
		);

		//Get the Drive file name
  		$fileMetadata = new Google_Service_Drive_DriveFile($fileData);

		//Get the file data
		$content = file_get_contents(realpath($_FILES['fileName']['tmp_name']));

		try {

			//Set the file content
			$uploadFile = array(
				'data' => $content,
				'uploadType' => 'multipart',
				'fields' => 'id'
			);

			//Upload the file to the drive
			$file = $drive->files->create($fileMetadata, $uploadFile);
			  
			//Redirect when the file upload is success
  			header('Location:success.php');

		} catch (Exception $error) {
        	throw new Exception("Error: " . $error->getMessage());
    	}
		
	}
	else {
		//Redirect to upload page if the file is not set
		header('Location:upload.php');
	}
  
} else {
	//Redirect to home page if the token is missing
	$redirect_uri = $redirectEndPoint;
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

?>