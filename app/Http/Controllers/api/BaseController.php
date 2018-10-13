<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    // in case of success
    public function sendResponse($result , $message){
        $response = [
            'success'=>true,
            'data'=>$result,
            'message'=>$message
        ];

        return response()->json($response,200);
    }
    // in case of faliure
    public function sendError($error , $errormessage=[] , $code=404){
        $response = [
            'success'=>false,
            'data'=>$result,
            'message'=>$error
        ];
        
    if(!empty($errormessage)){
        $response['data']=$errormessage;
    }

    return response()->json($response , $code);
    }
    
}
