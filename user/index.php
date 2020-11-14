<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/user.php'); 
$user = new user();
if($user->authorized())
{
	$user->mainpage();
} else {
	$user->loginpage();
}
?>