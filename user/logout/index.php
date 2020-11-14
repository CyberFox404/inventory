<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/users.php'); 
$user = new users();




//var_dump($user->authorized());

if($user->authorized())
{
	$user->logout();

}

	$user->loginpage();


/*
if($user->authorized())
{
	$user->logout();
} else {
	$user->loginpage();
}
*/
?>