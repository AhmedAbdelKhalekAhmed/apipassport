<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class RegisterController extends BaseController
{
    
    public function register(Request $request){
        $validator= Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('error validation',$vaidator->errors());
        }

        $input=$request->all();
        $input['password']=bcrypt($input['password']);


        $user=User::create($input);
        $success['token']=$user->createToken('MyApp')->accessToken;
        $success['name']=$user->name;
        return $this->sendResponse($success,'User created succesfully');



    }
}
