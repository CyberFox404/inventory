<?php
//require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/users.php'); 
//$user = new users;
//var_dump($user->authorized());
//if(!$user->authorized()) $user->loginpage();
//if(!$user->authorized()) {
	//$user->loginpage();
//	echo "22";
//	exit();

//}
//var_dump($userdd->authorized());
//var_dump(isset($_COOKIE['user_authorized']));
//var_dump($_COOKIE['user_authorized']);
//if(!$user->authorized()) 
//{
//	echo "333";
//	$user->loginpage();

//}
//if(!$user->authorized()) echo "333";
//echo "22";
//exit();

//$cryP = date('mdYdym');
//$CdsDSx = base64_encode(pack('H*',md5(utf8_encode($cryP))));;
//if ((( defined( "__enter__" )) && ( constant( "__enter__" ) == $CdsDSx )) || (header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.')));



//header('Content-type: text/html; charset=UTF-8');
//header("Cache-Control: public");
//header("Expires: " . date("r", time() + 3600));

require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/fs.php');

require_once 'apiEngine.php';
$jsonError = APIEngine::createDefaultJson();//Создаем JSON  ответа

if (count($_REQUEST)>0){
    foreach ($_REQUEST as $apiFunctionName => $apiFunctionParams) {
        $APIEngine=new APIEngine($apiFunctionName,$apiFunctionParams);
        echo $APIEngine->callApiFunction(); 
        break;
    }
}else{
    $jsonError->errorno = APIConstants::$ERROR_PARAMS;
    $jsonError->error='No function called';
    echo json_encode($jsonError);
}
?>