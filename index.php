<?php

/*=========================================
MOSTRAR ERRORES
=========================================*/
$root = $_SERVER['DOCUMENT_ROOT'];
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_logs', $root . '/php_error_log');

/*=========================================
REQUERIMENTOS
=========================================*/
require_once ('controllers/routes.controller.php');

$index = new RoutesController();
$index->index();

return;
