<?php
require_once ('apiConstants.php');
require_once ('MySQLiWorker.php');

class APIEngine {

    private $apiFunctionName;
    private $apiFunctionParams;

    //Статичная функция для подключения API из других API при необходимости в методах
    static function getApiEngineByName($apiName) {
        require_once 'apiBaseClass.php';
        require_once 'classes/' . $apiName . '.php';
        $apiClass = new $apiName();
        return $apiClass;
    }
    
    //Конструктор
    //$apiFunctionName - название API и вызываемого метода в формате apitest_helloWorld
    //$apiFunctionParams - JSON параметры метода в строковом представлении
    function __construct($apiFunctionName, $apiFunctionParams) {
        $this->apiFunctionParams = stripcslashes($apiFunctionParams);
        //Парсим на массив из двух элементов [0] - название API, [1] - название метода в API
        $this->apiFunctionName = explode('_', $apiFunctionName);
    }

    //Создаем JSON ответа
    function createDefaultJson() {
        $retObject = json_decode('{}');
        $response = APIConstants::$RESPONSE;
        $retObject->$response = json_decode('{}');
        //$retObject->errno = APIConstants::$ERROR_NO_ERRORS;
        return $retObject;
    }
    
    //Вызов функции по переданным параметрам в конструкторе
    function callApiFunction() {
        $resultFunctionCall = $this->createDefaultJson();//Создаем JSON  ответа
        $apiName = strtolower($this->apiFunctionName[0]);//название API проиводим к нижнему регистру
        $response = APIConstants::$RESPONSE;
        if (file_exists('classes/' . $apiName . '.php')) {
            $apiClass = APIEngine::getApiEngineByName($apiName);//Получаем объект API
            $apiReflection = new ReflectionClass($apiName);//Через рефлексию получем информацию о классе объекта
            try {
                $functionName = $this->apiFunctionName[1];//Название метода для вызова
                $apiReflection->getMethod($functionName);//Провераем наличие метода
                $response = APIConstants::$RESPONSE;
                $jsonParams = json_decode($this->apiFunctionParams);//Декодируем параметры запроса в JSON объект
                if ($jsonParams) {
                    if (isset($jsonParams->responseBinary)){//Для возможности возврата не JSON, а бинарных данных таких как zip, png и др. контетнта 
                        return $apiClass->$functionName($jsonParams);//Вызываем метод в API
                    }else{
                        $resultFunctionCall->$response = $apiClass->$functionName($jsonParams);//Вызыаем метод в API который вернет JSON обект
                    }
                } else {
                    //Если ошибка декодирования JSON параметров запроса
                    $resultFunctionCall->$response->errno = APIConstants::$ERROR_ENGINE_PARAMS;
                    $resultFunctionCall->$response->error = 'Error given params';
                }
            } catch (Exception $ex) {
                //Непредвиденное исключение
                $resultFunctionCall->$response->errno = APIConstants::$ERROR_METHOD_NOT_FOUND;
                //$resultFunctionCall->$response->error = $functionName;
                $resultFunctionCall->$response->error = $ex->getMessage();
            }
        } else {
            //Если запрашиваемый API не найден
            $resultFunctionCall->$response->errno = APIConstants::$ERROR_ENGINE_PARAMS;
            $resultFunctionCall->$response->error = 'File not found';
            $resultFunctionCall->REQUEST = $_REQUEST;
        }
        return json_encode($resultFunctionCall);
    }
}

?>