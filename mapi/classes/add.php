<?php

class add extends apiBaseClass {



	/*
		http://www.example.com/api/?add.val={"name":"simple"}

		добавления элеманта списка
	*/
	function val($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();

		$query = "";



// INSERT INTO `".DB_NAME."`.`".$apiMethodParams->table."` (`name`) VALUES ($apiMethodParams->name);

				//INSERT INTO `inventory`.`type` (`name`) VALUES ('Роутер');


		
	
	//add.val={"table":"'+table+'", "name":"'+name+'"}';

		if (isset($apiMethodParams->table) && isset($apiMethodParams->name)){



$query = "
SELECT * 
		FROM `".DB_NAME."`.`".$apiMethodParams->table."`
		WHERE name = '".$apiMethodParams->name."'";

			

//$retJSON->answer = $query;
				//return $retJSON;


			
			$retJSON->answer = 0;
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;



			$result = $conn->connectLink->query($query);

$colich_results = $result->num_rows;
			if ($colich_results > 0) {
				




$retJSON->errno = APIConstants::$ERROR_RECORD_EXIST;
					$retJSON->error = 'Ошибка запись существует';


} else {


$query = "
				INSERT INTO `".DB_NAME."`.`".$apiMethodParams->table."` 
				(name) VALUES ('".$apiMethodParams->name."')";

			
			//$retJSON->query = stripslashes($query);


			//if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) {
			
	
			$result = $conn->connectLink->query($query);

//$retJSON->answer = $result;
//				return $result;
			//	if($result)
			//	{
			//$iid = $conn->connectLink->insert_id;
				if($iid = $conn->connectLink->insert_id) {
					$retJSON->answer = $apiMethodParams->name;
					$retJSON->id = $iid;
					$retJSON->table = $apiMethodParams->table;
				} else {
					//$retJSON->answer = $__mysqli_insert;
					$retJSON->errno = APIConstants::$ERROR_ADD_STRING;
					$retJSON->error = 'Ошибка добавления записи';
				}
			//} else {
					//$retJSON->answer = $__mysqli_insert;
			//		$retJSON->errno = APIConstants::$ERROR_RECORD_EXIST;
			//		$retJSON->error = 'Ошибка добавления записи';
			//	}
			}

		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error='Ошибка в переданных параметрах';
		}


		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}





	/*
		http://www.example.com/api/?add.val={"name":"simple"}

		добавления элеманта списка
	*/
	function inventory($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();
		$retJSON->answer = 0;
		$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
		$conn = $mySQL->mySQLWorker;
		$query = "SELECT * FROM `".DB_NAME."`.`".DB_LIST."` WHERE inventory_number = '".$apiMethodParams->inventory_number."'";
		$result = $conn->connectLink->query($query);
		$colich_results = $result->num_rows;

		if($colich_results)
		{
			$retJSON->errno = APIConstants::$ERROR_RECORD_EXIST;
			$retJSON->error = 'Ошибка запись существует';

		} else
		{
			$query = json_encode($apiMethodParams);

			foreach ($apiMethodParams as $key => $value)
			{
				if($key == "inner_number")
				{
					$colich_results = 1;
					$error_cycle = 0;

					while($colich_results > 0)
					{
						if(empty($value) || $error_cycle)
						{
							$inner_number = $this->shortID(rand(1, 999999999999999999), "PC-");
						} else {
							$inner_number = $apiMethodParams->inner_number;
						}

						$query = "
							SELECT * 
							FROM ".DB_LIST." 
							WHERE inner_number = '".$inner_number."'";

						$result = $conn->connectLink->query($query);
						$colich_results = $result->num_rows;
						//if ($colich_results > 0) $error_cycle++;
						$error_cycle++;
					}

					$apiMethodParams->$key = $inner_number;
				}
			}

			$query = "INSERT INTO `".DB_NAME."`.`".DB_LIST."` ";

			$p_key = "";
			$p_val = "";

			foreach ($apiMethodParams as $key => $value)
			{
				if($value != "")
				{
					$p_key .= $key.',';
					$p_val .= "'" . $value."',";
				}
			}

			$timestamp = date("Y-m-d H:i:s");
			$p_key .= 'time_create'.',';
			$p_val .= "'" . $timestamp."',";
			$query .= "(".$p_key.") VALUES (".$p_val.")";
			$query = str_replace(",)", ")", $query );
			$result = $conn->connectLink->query($query);
			$colich_results = $result->num_rows;
			$retJSON->answer = $colich_results;
		}

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}


	/*
		http://www.example.com/api/?add.inventoryupdate={"in":"PC-jSQPVw"}

		добавления элеманта списка
	*/
	function inventoryupdate($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();
		$retJSON->answer = 0;
		$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
		$conn = $mySQL->mySQLWorker;

		//UPDATE worker SET salary=5000, dept='Marketing'
		//$query = "INSERT INTO `".DB_NAME."`.`".DB_LIST."` ";











			$query = "UPDATE `".DB_NAME."`.`".DB_LIST."` SET ";

			//$p_key = "";
			$p_el = "";

			foreach ($apiMethodParams as $key => $value)
			{
				//if(($key == "in") || ($key == "inventory_number") || ($key == "inner_number") || ($value == ""))
				if(($key == "in") || ($key == "inventory_number") || ($key == "inner_number"))
							{
							} else {
					//$p_key .= $key.',';
					//$p_val .= "'" . $value."',";
					$p_el .= $key."='" . $value."',";
				}
			}

			$timestamp = date("Y-m-d H:i:s");
			$p_el .= "time_update='" . $timestamp."',";
			$query .= $p_el ;
			$query .= " WHERE inner_number='".$apiMethodParams->inner_number."'";
			$query = str_replace(", WHERE", " WHERE", $query );

			//echo($query);
			//return;


			$result = $conn->connectLink->query($query);
			$colich_results = $result->num_rows;
			$retJSON->answer = $colich_results;


		//}

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}












function shortID($num, $prefix){

 $p_prefix = isset( $prefix) ?  $prefix: 0;
    
$arrmap = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

$pieces = str_split($arrmap);


$id = $num;

$shortURL = "" ;


while ($id > 0) {

$shortURL .= $pieces[$id % 62];

//num = floor(num / 62);
$id = floor($id / 62);

	}

	if($shortURL) return $p_prefix . $shortURL;
//return $shortURL;

}



}



/*

  function shortID(num, prefix)
{


  //var p_prefix = prefix == null ? "" : prefix
  var p_prefix = prefix || 0;


  var arrmap = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
arrmap.split('') ;
//var arrmap = arrmap.split('') ;


  var id = num;
    var shortURL = "" 

      while(num > 0){ // делать пока i меньше 4
        //while(y > 0){ // делать пока i меньше 4


shortURL += arrmap[num % 62] 



num = Math.floor(num / 62);
//y--;
}


if(shortURL)

  return p_prefix + shortURL;
return shortURL;

}
*/






















?>