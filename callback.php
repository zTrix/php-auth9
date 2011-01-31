<?
require('config.php');
require('auth9/auth.php');
$auth=new Auth9(clientID,app_secret);
$ret=$auth->getAccessToken($_GET['code'],callbackURL);
echo('accessToken is : '.$ret['access_token']);
?>
