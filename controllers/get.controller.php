<?php
require_once('services/get.service.php');

$table = explode('?', $routesArray[1])[0];

// Variables
$select = $_GET['select'] ??  "*";
$filter = $_GET['filter'] ?? null;
$filterTo = $_GET['filterTo'] ?? null;
$linkTo = $_GET['linkTo'] ?? null;
$filtertoR = $_GET['filtertoR'] ?? null;
$intoR = $_GET['intoR'] ?? null;
$orderBy = $_GET['orderBy'] ?? null;
$orderMode = $_GET['orderMode'] ?? null;
$startAt = $_GET['startAt'] ?? null;
$endAt = $_GET['endAt'] ?? null;
$rel = $_GET['rel'] ?? null;
$type = $_GET['type'] ?? null;
$search = $_GET['search'] ?? null;
$between1 = $_GET['between1'] ?? null;
$between2 = $_GET['between2'] ?? null;

$response = new GetService();

// Peticiones GET con filtros
if (isset($filter) && isset($filterTo) && !isset($rel) && !isset($type)) {
    $response->getDataFilter($select, $table, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt);
} else if (isset($rel) && isset($type) && $table == 'relations' && !isset($filter) && !isset($filterTo)) {
    $response->getRelData($select, $rel, $type, $orderBy, $orderMode, $startAt, $endAt);
} else if (isset($rel) && isset($type) && $table == 'relations' && isset($filter) && isset($filterTo)) {
    $response->getRelDataFilter($select, $rel, $type, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt);
} else if (!isset($rel) && !isset($type) && isset($filter) && isset($search)) {
    $response->getDataSearch($select, $table, $filter, $search, $orderBy, $orderMode, $startAt, $endAt);
} else if (isset($rel) && isset($type) && $table == 'relations' && isset($filter) && isset($search)) {
    $response->getRelDataSearch($select, $rel, $type, $filter, $search, $orderBy, $orderMode, $startAt, $endAt);
} else if (!isset($rel) && !isset($type) && isset($filter) && isset($between1) && isset($between2)) {
    $response->getRange($select, $table, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR);
} else if (isset($rel) && isset($type) && $table == 'relations' && isset($filter) && isset($between1) && isset($between2)) {
    $response->getRangeRel($select, $rel, $type, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR);
} else {
    $response->getData($select, $table, $orderBy, $orderMode, $startAt, $endAt);
}
