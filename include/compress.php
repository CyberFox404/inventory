<?php

class compress
{

	// http://127.0.0.1/compress.php

	public $server_link;


	function __construct()
	{

		$this->$server_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];

	}

	function file_get_contents_ex($link)
	{	

		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  

		$response = file_get_contents($link, false, stream_context_create($arrContextOptions));
		return $response;
	}

	function min($file)
	{
		//global $server_link;
		$gurl = $this->$server_link . $file;
		$gfile = $_SERVER['DOCUMENT_ROOT'] . $file;
		$gfilemd5 = md5_file($gfile);
		$bname = basename($gfile);
		$bnamemin = "min/".$gfilemd5.".".$bname;
		$gfilemin = str_replace($bname, $bnamemin, $gfile);
		$gurlmin = str_replace($bname, $bnamemin, $gurl);





		if(file_exists($gfilemin))
		{
			// если есть, то перенаправляем


			//header('Location: '. $gurlmin ."?h=". md5_file($gurlmin));

//$content = $this->file_get_contents_ex($gfilemin);

			header('Location: '. $gurlmin);

			//fi

//echo $content;
			exit();








			//echo ('Location: '. $gurlmin ."?h=". md5_file($gurlmin));

/*	
echo $gfile;
echo "<br>";
echo $gfilemin;
echo "<br>";
echo $bname;
echo "<br>";
echo $bnamemin;
echo "<br>";
echo "file_exists";
		
*/

//$url = $_SERVER['DOCUMENT_ROOT'] . $file['url']."&h=". md5_file($_SERVER['DOCUMENT_ROOT'] . $file['url']);

			//return str_replace(array("\r\n", "\r", "\n", "\t", "  "), " ", trim($string));
			//return str_replace("", " ", trim($string));

			//echo basename($gfile);





		} else {
			// если нет, то создаем

				$content = $this->file_get_contents_ex($gfile);



// удаляем комментарии => //
$content = preg_replace('^[/]+(.?*)$', '', $content);
$content = str_replace(array( "{ ", " {"), '{', $content);
$content = str_replace(array( "} ", "} "), '}', $content);
$content = str_replace(array( ", ", " ,"), ',', $content);
$content = str_replace(array(": ", " :"), ':', $content);
$content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), ' ', $content);


//$content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);

//$content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), '', $content);




//$content = preg_replace('#//.*#','',$content);
// удаляем многострочные комментарии /* */
//$content = preg_replace('#/\*(?:[^*]*(?:\*(?!/))*)*\*/#','',$content);
//$content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
//$content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    ', '    '), ' ', $content);
//$content = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$content)))));
//$content = str_replace(array("{  ", "{ ", " {", "  {"), '{', $content);
//$content = str_replace(array("}  ", "} ", "  }", " }"), '}', $content);
//$content = str_replace(array(",  ", ", ", "  ,", " ,"), ',', $content);
//$content = str_replace(array(":  ", ": ", "  :", " :"), ':', $content);




$f = fopen($gfilemin, "w");
		fwrite($f, $content);
		//fwrite($f, "2223");
		fclose($f); 





echo $gfile;
echo "<br>";
echo $gfilemin;
echo "<br>";
echo $bname;
echo "<br>";
echo $bnamemin;
echo "<br>";
echo "file_not_exists";






		}
	}

	function css($file)
	{

	}

	function js($file)
	{

	}


}

?>