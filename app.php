<?
require('config.php');
require('auth9/auth.php');
$auth=new Auth9(clientID,app_secret);
$authURL = $auth->getAuthURL(callbackURL);

header('Location: '.$authURL);
?>
