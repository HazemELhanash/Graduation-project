<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\baseController as baseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class authController extends baseController
{

    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors());
        }
        $input=$request->all();
        $input['password']=Hash::make($input['password']);
        $user=User::create($input);//لخلق مستخدم
        $success['token']=$user->createToken('maro')->accessToken;
        $success['name']=$user->name;
        return $this->sendResponse($success,'User registed successufully');

    }


    public function login(Request $request){

        if(Auth::attempt(['email' =>  $request->email, 'password' => $request->password])){

            if($request->email == "zenab@gmail.com"){
            $user=User::find(Auth::id());
            $success['token']=$user->createToken('maro')->accessToken;
            $success['name']=$user->name;
            return $this->sendResponse($success,'Welcom admin');

            }elseif($request->email == "maro@gmail.com"){

                    $user=User::find(Auth::id());
                    $success['token']=$user->createToken('maro')->accessToken;
                    $success['name']=$user->name;
                    return $this->sendResponse($success,'Welcom superVisor');

            }else{

                $user=User::find(Auth::id());
                $success['token']=$user->createToken('maro')->accessToken;
                $success['name']=$user->name;
                return $this->sendResponse($success,'مش ويلكم');
            }
        }
        else{
            return $this->sendError('Please check your auth',['error'=>'Unauthorised']);
        }
    }


}
