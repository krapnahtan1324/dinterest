<?php
require 'base.php';
require 'connect-db.php';
require 'recipe-db.php';
require_once 'config.php';
//require_once 'vendor/autoload.php';
  
// init configuration
// $clientID = '864136502349-ea60pa7tm08blelkkpihumj0osvd7nl5.apps.googleusercontent.com';
// $clientSecret = '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';
// $redirectUri = 'http://localhost/dinterest/redirect.php';
   
// // create Client Request to access Google API
// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setClientSecret($clientSecret);
// $client->setRedirectUri($redirectUri);
// $client->addScope("email");
// $client->addScope("profile");
  
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $_SESSION['name'] = $name;

  $username = $email;
  $_SESSION['user'] = $username;
  addUser($username, $name);
  header("Location: user-recipe.php");

} else {
  //echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
  $authurl = $client->createAuthUrl();
  header('Location: ' . $authurl);
}


?>