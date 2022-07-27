<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($root);
$dotenv->load();