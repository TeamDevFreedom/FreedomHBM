<?php
$AJAX_SUCCESS = 1;
$AJAX_FAILURE = 2;
$AJAX_ERROR = 3;

function build_response($arg_array, $status, $message){
    $arg_array['status'] = $status;
    $arg_array['message'] = $message;
    return json_encode($arg_array);
}