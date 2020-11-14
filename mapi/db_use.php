<?php
	$cryP = date('mdYdym');
	$CdsDSx = base64_encode(pack('H*',md5(utf8_encode($cryP))));;
	if ((( defined( "__enter__" )) && ( constant( "__enter__" ) == $CdsDSx )) || (header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.')));
	
	
	if ($_SERVER['REMOTE_ADDR']=='127.0.0.1') {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'inventory');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    
    define('DB_LIST', 'inventory_data');
	} else {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'inventory');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    define('DB_LIST', 'inventory_data');
	}

?>