<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/fs.php'); 

	$obj = apianswer('get.inventorynumberlist={}', 1);

	$myObj = (object)[];
	$myObj->draw = "1";
	$myObj->recordsTotal = $obj['response']['count'];
	$myObj->recordsFiltered = $obj['response']['count'];
	$myObj->data = $obj['response']['data'];
	$myJSON = json_encode($myObj);

	echo $myJSON;
	
?>