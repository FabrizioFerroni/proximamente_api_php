<?php
require_once('models/get.model.php');

class GetController
{
    static public function getData($table)
    {

        $response = GetModel::getData($table);

        $return =  new GetController;
        $return->fncResponse($response);
    }

    public function fncResponse($response)
    {
        if (!empty($response)) {
            $json = array(
                'data' => $response
            );
            echo json_encode($json, http_response_code(200));
        } else {
            $json = array(
                'result' => 'Not Found'
            );

            echo json_encode($json, http_response_code(404));
        }
    }
}
