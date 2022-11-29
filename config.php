<?php

require_once 'vendor/autoload.php';

session_start();
  
// init configuration
$clientID = '864136502349-ea60pa7tm08blelkkpihumj0osvd7nl5.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/dinterest/redirect.php';
   
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

?>