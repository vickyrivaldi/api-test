<?php
error_reporting(-1);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Jakarta");

require '.././include/helper.php';
require '.././libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

function getCurdate(){
    $headers = apache_request_headers();

    if(!isset($headers['Date'])){
        return gmdate('D, d M Y H:i:s \G\M\T', time());
    }else{
        return $headers['Date'];
    }
}

function echoResponse($status_code, $timestamp, $response)
{
    $app = \Slim\Slim::getInstance();
    $app->status($status_code);
    $app->contentType('application/json');
    // $app->date($timestamp);
    $app->response->headers->set('Date', $timestamp);
    echo json_encode($response);
    $app->stop();
}

//VERIFY PARAMETERS
function verifyRequiredParams($timestamp, $required_fields, $data)
{
    $error = false;
    $error_fields = "";
    $request_params = $data;

    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["error"] = true;
        $response["message"] = 'Required fields ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(400, $timestamp, $response);
        $app->stop();
    }
}

$app->post('/bintodec', function () use ($app){
    $hp = new helper();
    $timestamp = getCurdate();
    $arr_req = array(
        'input',
        'output'
    );

    $json = $app->request()->getBody();
    $data = json_decode($json, true);
    verifyRequiredParams($timestamp, $arr_req, $data);

    $number = $data['input'];
    $type = $data['output'];

    if(strtolower($type)=='binary'){
        $result = $hp->bintodec($number);
    }else if(strtolower($type)=='decimal'){
        $result = $hp->dectobin($number);
    }else{
        $response["error"] = true;
        $response["message"] = 'invalid output type';
        echoResponse(400, $timestamp, $response);
    }

    $arr_res = array(
        'result' => $result,
        'type' => $type
    );

    echoResponse(200, $timestamp, $arr_res);
});

$app->run();
