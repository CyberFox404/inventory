<?php

class get extends apiBaseClass {


	//http://www.example.com/api/?get.inventorynumberdata={"in":"123456789"}
	function inventorynumberdata($apiMethodParams) {
		$retJSON = $this->createDefaultJson();


		
		$query = "SELECT * 
		FROM `".DB_NAME."`.`".DB_LIST."`
		WHERE inventory_number = '".$apiMethodParams->in."'";

	if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);



		if (isset($apiMethodParams->in)){
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			$result = $conn->connectLink->query($query);
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


	//http://www.example.com/api/?get.inventoryiddata={"id:"123456789"}
	function inventoryiddata($apiMethodParams) {
		$retJSON = $this->createDefaultJson();


		
		$query = "SELECT * 
		FROM `".DB_NAME."`.`".DB_LIST."`
		WHERE id = '".$apiMethodParams->id."'";

	



		if (isset($apiMethodParams->id)){
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			$result = $conn->connectLink->query($query);
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

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}





	//http://www.example.com/api/?get.innernumberdata={"in":"PC-jSQPVw"}
	function innernumberdata($apiMethodParams) {
		$retJSON = $this->createDefaultJson();


		
		$query = "SELECT * 
		FROM `".DB_NAME."`.`".DB_LIST."` 
		WHERE inner_number = '".$apiMethodParams->in."'";
		//WHERE inner_number = '".$apiMethodParams->in."' AND time_writeoff IS NOT NULL";

	if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);



		if (isset($apiMethodParams->in)){
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			$result = $conn->connectLink->query($query);
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
	/*
		Получение данных инвентарной таблицы для datatables
	*/
	function inventorynumberlist()
	{
		$retJSON = $this->createDefaultJson();

		$query = "
			SELECT * 
			FROM `".DB_NAME."`.`".DB_LIST."` WHERE time_writeoff IS NULL";



		$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
		$conn = $mySQL->mySQLWorker;
		$result = $conn->connectLink->query($query);
		$colich_results = $result->num_rows;
		if ($colich_results > 0)
		{
			$retJSON_data = $this->createDefaultJson(0);
			$mykey = 0;
			while($data = $result->fetch_object())
			{
				//unset($data->id); // Удалить столбик с ID



//$dataddd = array();


foreach ($data as $key => $value) {

//$fdata = {"table":"123456789"}


$myObjx = (object)[];
$myObjx->table = $key;


	$jans = $this->tableexist($myObjx);

	//$ans = json_decode($jans, true);


	if($jans->answer == 1)
	{


//$query = "
	//	SELECT column_name,column_comment 
	//	FROM information_schema.columns 
	//	WHERE table_schema='".DB_NAME."' and table_name='".DB_LIST."'";



$myObjy = (object)[];
$myObjy->table = $key;
$myObjy->id = $value;

$tans = $this->findval($myObjy);
//findval={"table":"type", "id":"00000000000000000003"}

//get.val={"table":"type"}




$data->$key = $tans->data->name;

	}


	//$gp = $data->id;
	//$data->DT_RowId = $gp;
	//unset($gp);

	//$dataddd[$key] = $jans->answer;



}

	//return $dataddd;

	//var_dump($data);
	//return;




				$retJSON_data->$mykey = $data;
				$mykey = $mykey+1;
			}
			$retJSON->count = $colich_results;
			$retJSON->data = $retJSON_data;
		} else {
			$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
			$retJSON->error='Ошибка запись не найдена';
		}

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}


	/*
		http://www.example.com/api/?get.inventorynamelist={}

		получение массива из названия столбца и его коммент
	*/
	function inventorynamelist()
	{
		$retJSON = $this->createDefaultJson();


		$query = "
		SELECT column_name,column_comment 
		FROM information_schema.columns 
		WHERE table_schema='".DB_NAME."' and table_name='".DB_LIST."'";



			if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);


		$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
		$conn = $mySQL->mySQLWorker;
		$result = $conn->connectLink->query($query);
		$colich_results = $result->num_rows;
		if ($colich_results > 0)
		{
			$retJSON_data = $this->createDefaultJson(0);
			$mykey = 0;
			while($data = $result->fetch_object())
			{
				if($data->column_name != "id")
				{
					$retJSON_data->$mykey = $data;
					$mykey++;
				}
			}
			$retJSON->count = $mykey;
			$retJSON->data = $retJSON_data;
		} else {
			$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
			$retJSON->error='Ошибка запись не найдена';
		}
		return $retJSON;
	}


	/*
		http://www.example.com/api/?get.tableexist={"table":"123456789"}

		проверка существования таблицы
	*/
	function tableexist($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();

$query = "
				SELECT COUNT(*) 
				FROM information_schema.tables 
				WHERE table_schema='".DB_NAME."' AND table_name='".$apiMethodParams->table."'";


		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);


		if (isset($apiMethodParams->table)){
			
			$retJSON->answer = 0;
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			
			//$retJSON->query = stripslashes($query);


			//if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) {
			
	
			$result = $conn->connectLink->query($query);
			$colich_results = $result->num_rows;


			//$colich_results = 10;
			if ($colich_results > 0)
			{
			$data = $result->fetch_array();
				//$retJSON->answer = $data->count;
				$retJSON->answer = $data[0];
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




	/*
	
		http://www.example.com/api/?get.val={"table":"type"}

		получить значения таблицы
	*/
	function val($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();





		$query = "
			SELECT *
			FROM `".DB_NAME."`.`".$apiMethodParams->table."` 
			ORDER BY name";
			;

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);



		//if (isset($apiMethodParams->column) && isset($apiMethodParams->table)){
		if (isset($apiMethodParams->table)){
			//$retJSON->answer = 0;
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			

			



			//$retJSON->query = stripslashes($query);


			//if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) {
			
	
			$result = $conn->connectLink->query($query);
			$colich_results = $result->num_rows;
			if ($colich_results > 0) {
				//$data = $result->fetch_array(MYSQLI_ASSOC);
				//$data = $result->fetch_object();
				
				$dataA = [];


				while($data = $result->fetch_object())
				{
					//if($data->column_name != "id")
					//{
						//$retJSON_data->$mykey = $data;
						//$mykey++;

						$dataA[] = $data;
					//}
				}



				$retJSON->count = $colich_results;
				$retJSON->data = $dataA;

			} else {
				$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
				$retJSON->error = 'Ошибка запись не найдена';
			}
		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error = 'Ошибка в переданных параметрах';
		}
		return $retJSON;
	}







	/*
	
		http://www.example.com/api/?get.findval={"table":"type", "id":"00000000000000000003"}

		получить значения таблицы по id
	*/
	function findval($apiMethodParams)
	{
		//global $DEBUG;
		$retJSON = $this->createDefaultJson();



		if (isset($apiMethodParams->id) && isset($apiMethodParams->table)){

		$query = "
			SELECT *
			FROM `".DB_NAME."`.`".$apiMethodParams->table."` 
			WHERE id='".$apiMethodParams->id."'";
			;

		



		//if (isset($apiMethodParams->column) && isset($apiMethodParams->table)){
		//if (isset($apiMethodParams->table)){
			//$retJSON->answer = 0;
			$mySQL = new apiBaseClass(DB_NAME,DB_HOST,DB_USER,DB_PASS);
			$conn = $mySQL->mySQLWorker;
			

			



			//$retJSON->query = stripslashes($query);


			//if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) {
			
	
			$result = $conn->connectLink->query($query);
			$colich_results = $result->num_rows;
			if ($colich_results > 0) {
				//$data = $result->fetch_array(MYSQLI_ASSOC);
				$data = $result->fetch_object();
				
				//$dataA = [];


				//while($data = $result->fetch_object())
				//{
					//if($data->column_name != "id")
					//{
						//$retJSON_data->$mykey = $data;
						//$mykey++;

					//	$dataA[] = $data;
					//}
				//}



				$retJSON->count = $colich_results;
				$retJSON->data = $data;

			} else {
				$retJSON->errno = APIConstants::$ERROR_RECORD_NOT_FOUND;
				$retJSON->error = 'Ошибка запись не найдена';
			}
		} else {
			$retJSON->errno = APIConstants::$ERROR_PARAMS;
			$retJSON->error = 'Ошибка в переданных параметрах';
		}

		if ((( defined( "DEBUG" )) && ( constant( "DEBUG" ) == "1"))) $retJSON->query = str_clear($query);
		return $retJSON;
	}



}

?>