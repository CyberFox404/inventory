<?php

class set extends apiBaseClass {



	//http://www.example.com/api/?set.del={"0":"00000000000000000008"}
	function del($apiMethodParams) {
		$retJSON = $this->createDefaultJson();

		if (isset($apiMethodParams))
		{

			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;

			$retJSON->all = 0;
			$retJSON->delete = 0;
			$num = 1;

			foreach ($apiMethodParams as $key => $value)
			{

				$query = "DELETE FROM `".DB_NAME."`.`".DB_LIST."` WHERE id = '".$value."'";

				$result = $conn->connectLink->query($query);
				//$colich_results = $result->num_rows;
				if ($result) {
					//$data = $result->fetch_array(MYSQLI_ASSOC);
					//$data = $result->fetch_object();
					
					$retJSON->delete = $num;

					$num++;
				} else {
					$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
					$retJSON->error='Ошибка запись не найдена';
				}
				//$retJSON->all = $apiMethodParams->count();
				$retJSON->all = count(get_object_vars($apiMethodParams));;
				



			}
		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error='Ошибка в переданных параметрах';
		}

	

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}



	//http://www.example.com/api/?set.writeoff={"id":"00000000000000000008"}
	function writeoff($apiMethodParams) {
		$retJSON = $this->createDefaultJson();

		if (isset($apiMethodParams))
		{

			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;

			$retJSON->all = 0;
			$retJSON->delete = 0;
			$num = 1;

			

			//$query = "UPDATE `".DB_NAME."`.`".DB_LIST."` SET ";


			foreach ($apiMethodParams as $key => $value)
			{
				$timestamp = date("Y-m-d H:i:s");

				//$query = "DELETE FROM `".DB_NAME."`.`".DB_LIST."` WHERE id = '".$value."'";
				$query = "UPDATE `".DB_NAME."`.`".DB_LIST."` SET time_writeoff='" . $timestamp."'  WHERE id = '".$value."'";



				//echo $query;
				//echo "<br>";

				$result = $conn->connectLink->query($query);
				if ($result) {			
					$retJSON->writeoff = $num;
					$num++;
				//} else {
				//	$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
				//	$retJSON->error='Ошибка запись не найдена';
				}
				$retJSON->all = count(get_object_vars($apiMethodParams));;
				



			}














				//exit();




				



			//}
		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error='Ошибка в переданных параметрах';
		}

	

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}




	//http://www.example.com/api/?get.inventorynumberdata={"in":"123456789"}
	function inventorynumberdata($apiMethodParams) {
		$retJSON = $this->createDefaultJson();
		if (
			isset($apiMethodParams->in) && 
			isset($apiMethodParams->subject)
		)
		{
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			$result = $conn->connectLink->query("select * from `".DB_NAME."`.`".DB_LIST."` where `inventory_number` = '$apiMethodParams->in'");
			$colich_results = $result->num_rows;
			if ($colich_results > 0) {
				//$data = $result->fetch_array(MYSQLI_ASSOC);
				$data = $result->fetch_object();
				$retJSON->count = $colich_results;
				$retJSON->data = $data;
			} else {
				$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
				$retJSON->error='Ошибка запись не найдена';
			}
		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error='Ошибка в переданных параметрах';
		}
		return $retJSON;
	}


	//http://www.example.com/api/?get.inventorynumberlist={}
	function inventorynumberlist()
	{
		$retJSON = $this->createDefaultJson();
		$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
		$conn = $mySQL->mySQLWorker;
		$result = $conn->connectLink->query("select * from `".DB_LIST."`");
		$colich_results = $result->num_rows;
		if ($colich_results > 0)
		{
			$retJSON_data = $this->createDefaultJson(0);
			$mykey = 0;
			while($data = $result->fetch_object())
			{
				$mykey = $mykey+1;
				$retJSON_data->$mykey = $data;
			}
			$retJSON->count = $colich_results;
			$retJSON->data = $retJSON_data;
		} else {
			$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
			$retJSON->error='Ошибка запись не найдена';
		}
		return $retJSON;
	}


}

?>