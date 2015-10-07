<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel='shortcut icon' href='images/vtu-logo.png' /> 
    <title>Welcome To VTU Gathering</title>
 </head>

 <?php
session_start();
require_once ('dbconfig.php');
require_once ('libraries/Google/autoload.php');
$client_id = '778511505751-c3beb27l4el9rq5k4t56odm2suv9h0rf.apps.googleusercontent.com';
$client_secret = 'hinDPCyq2OVLZl-zdFAe0icC';
$redirect_uri = 'http://localhost/hackathon_challenge_3/index.php';

if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
}

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");


$service = new Google_Service_Oauth2($client);


if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} 
else
{
  $authUrl = $client->createAuthUrl();
}



echo '<div style="margin:20px">';
if (isset($authUrl) && !isset($_SESSION['FBID'])) 
{
  
} 
elseif(!isset($_SESSION['FBID'])) 
{
  
  $user = $service->userinfo->get(); //get user info 
  // connect to database

  //check if user exist in database using COUNT
  $result = mysql_query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
  $user_count = mysql_fetch_object($result); //will return 0 if user doesn't exist
  //show user picture
  $_SESSION['user_pic'] = $user->picture;
  echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
  
  if($user_count)
    {
      $_SESSION['user_n'] = $user->name; 
      echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
  else
  { 
    $_SESSION['user_n'] = $user->name;
    echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
}
echo '</div>';
?>
  <body style= "background-image:url('images/bg.png');">
  <?php if (isset($_SESSION['FBID']) and !isset($user->name)):
  $_SESSION['user_n'] = $_SESSION['FULLNAME'];
  $_SESSION['user_pic'] = "https://graph.facebook.com/".$_SESSION['FBID']."/picture";
    ?>
        <!--  After user login  -->
<div class="container">
<div class="hero-unit">
  <h1>Hello <?php echo $_SESSION['FULLNAME']; ?></h1>
  <p>Welcome to "facebook login" tutorial</p>
  </div>
<div class="span4">
 <ul class="nav nav-list">
  <button>Upload Article</button>
<li class="nav-header">Image</li>
	<li><img src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture"></li>
<li class="nav-header">Facebook ID</li>
<li><?php echo  $_SESSION['FBID']; ?></li>
<li class="nav-header">Facebook fullname</li>
<li><?php echo $_SESSION['FULLNAME']; ?></li>
<li class="nav-header">Facebook Email</li>
<li><?php echo $_SESSION['EMAIL']; ?></li>
<div><a href="logout.php">Logout</a></div>
</ul></div></div>
    <?php elseif(!isset($_SESSION['FBID']) and !isset($user->name)): ?>     <!-- Before login --> 
<div class="container">

	  </div>
      </div>
    <?php endif;
    if(!isset($_SESSION['FBID']) && !isset($user))
    {
      echo '<div style="margin-top:25%; margin-left:35%;">
            <a class="login" href="' . $authUrl . '">
            <img src="images/google-login-button.png" /></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="login" href="fbconfig.php"><img src="images/fb-login-button.png" /></a>
            <a href="moderator.php" class="button">Moderator Login </a>
            </div>';
    }
    elseif(isset($_SESSION['user_n']))
    {
      header("Location: articles.php");
    }
    ?>
  </body>
</html>
