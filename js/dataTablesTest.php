<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/include/fs.php');
//$tablelist = apianswer('get.inventorynamelist={}')["data"];
$tablelist = file_get_contents_edddx('get.inventorynamelist={}', 1);
//session_start();
//var_dump(session_name() . '=' . session_id());
eecho($tablelist);
//exit();



function file_get_contents_edddx($link)
	{	

		$server_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
	$api_location = $server_link . "/mapi/?";



		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
			'http'=>array(
				'method'=>"GET",
				'header'=>"Accept-language: ru\r\n" .
				"Cookie: " . $_SERVER['HTTP_COOKIE'] . "\r\n"
				
			)
		); 

		eecho($arrContextOptions);

		//"Cookie: " . $_SERVER['HTTP_COOKIE'] . "\r\n"
		//"Cookie: u_login=" . get_cookie('u_login') ."; u_pass=" . get_cookie('u_pass') . "; u_sum=" . get_cookie('u_sum') . "\r\n" 

		//"Cookie: u_login=" . get_cookie('u_login') ."; u_pass=" . get_cookie('u_pass') . "; u_sum=" . get_cookie('u_sum') . "\r\n" 

		$response = file_get_contents($api_location . $link, false, stream_context_create($arrContextOptions));
		return $response;
	}


	function eecho($text)
	{	
		var_dump($text);
		echo "<br>";
	}


?>