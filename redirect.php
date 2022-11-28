<?php
require("connect-db.php");
require 'recipe-db.php';
require_once 'vendor/autoload.php';
  
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
  
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  print_r($email);
  $name =  $google_account_info->name;
  $password = 'test';

  #global $db;
  $username = $email;
  addUser($username, $password, $name);

  // $email = "gloriasun@gmail.com";
  // $name = "Gloria";
  // $password = "urmom";
//   $query = "INSERT INTO User VALUES ($email, $password, $name)"; 
  // echo "I'm here! I've made the query";
  // $query = "INSERT INTO User VALUES ($email, $password, $name)"; 
//   try {
//   $statement = $db->prepare($query);  
//   // $statement->bindValue(':email', $email);
//   // $statement->bindValue(':password', $password);
//   // $statement->bindValue(':name', $name); 
  
//   $statement->execute(); 
//   $statement->closeCursor(); 
//   }
//   catch (PDOException $e)
//   {
//       if ($statement->rowCount() == 0)
//           echo "Failed to add user <br/"; 
//   }
//   catch (Exception $e)
//   {
//       echo $e->getMessage(); 
//   }
  
  // now you can use this profile info to create account in your website and make user logged in. 
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}


?>