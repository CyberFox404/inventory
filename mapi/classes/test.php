<?php

class test extends apiBaseClass {

    //http://www.example.com/api/?apitest.helloAPI={}
    function helloAPI() {
        $retJSON = $this->createDefaultJson();
        $retJSON->answer = 'It\'s method called without parameters';
		//$retJSON->error = "Есть ошибки";
       // $retJSON->errno = 55;
        return $retJSON;
    }

    //http://www.example.com/api/?apitest.helloAPIWithParams={"TestParamOne":"Text of first parameter"}
    function helloAPIWithParams($apiMethodParams) {
        $retJSON = $this->createDefaultJson();
        if (isset($apiMethodParams->TestParamOne)){
            //Все ок параметры верные, их и вернем
            $retJSON->answer=$apiMethodParams->TestParamOne;
        }else{
            //$retJSON->errorno = APIConstants::$ERROR_PARAMS;
            $retJSON->error = APIConstants::$ERROR_PARAMS;
        }
        return $retJSON;
    }
    
    //http://www.example.com/api/?apitest.helloAPIResponseBinary={"responseBinary":1}
    function helloAPIResponseBinary($apiMethodParams){
        header('Content-type: image/png');
        echo file_get_contents("http://habrahabr.ru/i/error-404-monster.jpg");
    }

}

?>