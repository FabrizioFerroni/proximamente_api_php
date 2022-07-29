<?php
require_once('utils/dotenv.php');
date_default_timezone_set($_ENV['TZ']);

/*=========================================
MOSTRAR ERRORES
=========================================*/
$root = $_SERVER['DOCUMENT_ROOT'];
$error_log = $root.'/errors/php_error.log';
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL);
// ini_set('error_log', 'C:/xampp/htdocs/prox_api/errors/php_error.log');
ini_set('error_log', $error_log);

/*=========================================
REQUERIMENTOS
=========================================*/
require_once('controllers/routes.controller.php');

$index = new RoutesController();
$index->index();

return;
