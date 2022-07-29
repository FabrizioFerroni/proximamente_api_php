<?php
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

// Si la ruta principal esta vacía
if (count($routesArray) == 0) {
    $header =  header('Content-Type: application/json; charset=utf-8');

    $json = array(
        'result' => 'Not Found'
    );
    
    $header;
    echo json_encode($json, http_response_code(404));

    return;
}

$rm = $_SERVER['REQUEST_METHOD'];

if (count($routesArray) == 1 && isset($rm)) {
    /*=========================================
        Peticiones GET
    =========================================*/
    if($rm == 'GET'){
       include ('controllers/get.controller.php');
    }

    /*=========================================
        Peticiones POST
    =========================================*/
    if($rm == 'POST'){
        $json = array(
            'result' => 'Solicitud POST'
        );
    
        echo json_encode($json, http_response_code(200));
    }

    /*=========================================
        Peticiones PUT
    =========================================*/
    if($rm == 'PUT'){
        $json = array(
            'result' => 'Solicitud PUT'
        );
    
        echo json_encode($json, http_response_code(200));
    }

    /*=========================================
        Peticiones DELETE
    =========================================*/
    if($rm == 'DELETE'){
        $json = array(
            'result' => 'Solicitud DELETE'
        );
    
        echo json_encode($json, http_response_code(200));
    }
}
