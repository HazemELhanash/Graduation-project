<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class baseController extends Controller
{
    //Message responses to user by result
    public function sendResponse($result , $message){
        $response=[
            "success"=> true,
            "data" => $result,
            "message" => $message
        ];

        return response()->json($response , 200) ;

    }

    //Message responses to user by errors

    public function sendError($error , $errorMessage=[], $code= 404 ){
        $response=[
            "success"=> false,
            "data" => $error
        ];

        if(!empty($errorMessage)){
            $response["data"]= $errorMessage;
        }

        return response()->json($response , $code) ;

    }


}
