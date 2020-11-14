<?
	//session_start();
	//$cryP = date('mdYdym');
	//$CdsDSx = base64_encode(pack('H*',md5(utf8_encode($cryP))));;
	//define("__enter__", $CdsDSx);

	//require_once('modal.php'); 

	//$DEBUG = 1;

	define('DEBUG', '1'); // Отображение MYSQL запроса в ответе


	$server_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
	$api_location = $server_link . "/inventory/mapi/?";

	$datefrom = date('d.m.Y');

	$pdfname = "qrsticker.pdf";

	$btnicon = array();
	$btnicon["сканировать"] = array('ico' => '<i class="fas fa-qrcode"></i>' );
	$btnicon["добавить"] = array('ico' => '<i class="fas fa-plus-square"></i>' );
	$btnicon["сбросить"] = array('ico' => '<i class="fas fa-eraser"></i>' );
	$btnicon["списать"] = array('ico' => '<i class="fas fa-archive"></i>' );
	$btnicon["удалить"] = array('ico' => '<i class="fas fa-trash-alt"></i>' );
	$btnicon["изменить"] = array('ico' => '<i class="fas fa-edit"></i>' );
	$btnicon["печатьстикеров"] = array('ico' => '<i class="fas fa-address-card"></i>' );
	$btnicon["выделитьвсе"] = array('ico' => '<i class="fas fa-list-ol"></i>' );
	$btnicon["выделить"] = array('ico' => '<i class="fas fa-tasks"></i>' );
	$btnicon["снятьвыделение"] = array('ico' => '<i class="fas fa-list"></i>' );
	$btnicon["обновить"] = array('ico' => '<i class="fas fa-sync-alt"></i>' );


	function apianswer($api_com, $raw=0)
	{	
		global $api_location;

		//$arrContextOptions=array(
		//	"ssl"=>array(
		//		"verify_peer"=>false,
		//		"verify_peer_name"=>false,
		//	),
		//);  


		$api_header = $api_location;
		//$response = file_get_contents( $api_header . $api_com, false, stream_context_create($arrContextOptions));
		$response = file_get_contents_ex( $api_header . $api_com);
		//$response = file_get_contents_ex_curl( $api_header . $api_com);
		//$response = file_get_contents($api_header . $api_com, false, $context);
		//return $response;
		$answer = json_decode($response, true);	
		if($raw != 0) return $answer;
		return $answer['response'];
	}

	function file_get_contents_ex($link)
	{	

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

		//"Cookie: u_login=" . get_cookie('u_login') ."; u_pass=" . get_cookie('u_pass') . "; u_sum=" . get_cookie('u_sum') . "\r\n" 

		//"Cookie: " . $_SERVER['HTTP_COOKIE'] . "\r\n"

		//"Cookie: u_login=" . get_cookie('u_login') ."; u_pass=" . get_cookie('u_pass') . "; u_sum=" . get_cookie('u_sum') . "\r\n" 

		$response = file_get_contents($link, false, stream_context_create($arrContextOptions));
		return $response;
	}


	function file_get_contents_ex_curl($link)
	{
		$ch = curl_init($link);
		//curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=61445603b6a0809b061080ed4bb93da3');
		curl_setopt($ch, CURLOPT_COOKIE, $_SESSION['session']['name'] . '=' . $_SESSION['session']['id']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_HEADER, false);
		$response = curl_exec($ch);
		curl_close($ch);
		 
		return $response;
	}


	function get_cookie($key)
	{
		if (isset($_COOKIE[$key])) return $_COOKIE[$key];
		return 0;
	}


	function _set_get($var)
	{
		return (isset($_GET[$var])) ? $_GET[$var] : 0;
	}


	if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
	{
	    /**
	     * mb_ucfirst - преобразует первый символ в верхний регистр
	     * @param string $str - строка
	     * @param string $encoding - кодировка, по-умолчанию UTF-8
	     * @return string
	     */
	    function mb_ucfirst($str, $encoding='UTF-8')
	    {
	        $str = mb_ereg_replace('^[\ ]+', '', $str);
	        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
	               mb_substr($str, 1, mb_strlen($str), $encoding);
	        return $str;
	    }
	}


	function str_clear($string)
	{
		return str_replace(array("\r\n", "\r", "\n", "\t", "  "), " ", trim($string));
	}



?>

