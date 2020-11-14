<?php

//if (isset($_POST["inventory_number"]) && isset($_POST["inner_number"]) ) { 

	// Формируем массив для JSON ответа
    $result = array(
    	'inventory_number' => $_POST["inventory_number"],
    	'inner_number' => $_POST["inner_number"]
    ); 

    // Переводим массив в JSON
    //echo json_encode($result); 
    echo json_encode(count($_POST)); 
   // echo $result; 
//}

?>