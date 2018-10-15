<?php
require_once(realpath(dirname(__FILE__).'/google-api-php-client/vendor/autoload.php'));

session_start();

$redirectEndPoint = 'http://'.$_SERVER['HTTP_HOST'].'/OAuth-2.0-framework/authenticate.php';
$uploadEndPoint = 'http://'.$_SERVER['HTTP_HOST'].'/OAuth-2.0-framework/upload.php';

//Create a New google client object
$googleClient = new Google_Client();

//Config data
$googleClient->setAuthConfigFile('secret_data.json');

//redirect URL
$googleClient->setRedirectUri($redirectEndPoint);

$googleClient->addScope(Google_Service_Drive::DRIVE_FILE);

if (!isset($_GET['code'])) {

  //Create the URI to get auth code
  $auth_url = $googleClient->createAuthUrl();

  //Redirect to auth code url
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

} else {

  //Open the authentication page
  $googleClient->authenticate($_GET['code']);

  //Get Access token for the session after authentication
  $_SESSION['Access_Token'] = $googleClient->getAccessToken();

  //Redirect to the file upload page
  $redirect_uri = $uploadEndPoint;
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

}