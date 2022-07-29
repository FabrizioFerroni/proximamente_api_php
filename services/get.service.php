<?php
require_once('models/get.model.php');

class GetService
{
    static public function getData($select, $table, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getData($select, $table, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getDataFilter($select, $table, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getDataFilter($select, $table, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getRelData($select, $rel, $type, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getRelData($select, $rel, $type, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getRelDataFilter($select, $rel, $type, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getRelDataFilter($select, $rel, $type, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getDataSearch($select, $table, $filter, $search, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getDataSearch($select, $table, $filter, $search, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getRelDataSearch($select, $rel, $type, $filter, $search, $orderBy, $orderMode, $startAt, $endAt)
    {
        $response = GetModel::getRelDataSearch($select, $rel, $type, $filter, $search, $orderBy, $orderMode, $startAt, $endAt);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getRange($select, $table, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR)
    {
        $response = GetModel::getRange($select, $table, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    static public function getRangeRel($select, $rel, $type, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR)
    {
        $response = GetModel::getRangeRel($select, $rel, $type, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR);
        $return =  new GetService;
        $return->fncResponse($response);
    }

    public function fncResponse($response)
    {
        $header =  header('Content-Type: application/json; charset=utf-8');;
        if (!empty($response)) {
            $json = array(
                'data' => $response
            );

            $header;
            echo json_encode($json, http_response_code(200));
        } else {
            $json = array(
                'result' => 'Not Found'
            );

            $header;
            echo json_encode($json, http_response_code(404));
        }
    }
}
