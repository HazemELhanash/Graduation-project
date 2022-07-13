<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\baseController as baseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;



class authController extends baseController
{

/*

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

           /* if($request->email == "zenab@gmail.com"){
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

            $user=User::find(Auth::id());
                $success['token']=$user->createToken('maro')->accessToken;
                $success['name']=$user->name;
                return $this->sendResponse($success,'مش ويلكم');
        }
        else{
            return $this->sendError('Please check your auth',['error'=>'Unauthorised']);
        }
    }
    */

    public function login(){
        return view("join");
    }

    public function postlogin(Request $request){
       $request->validate([
           "email" =>"required",
           "password" => "required"
       ]);

       if(Auth::attempt(['email' =>  $request->email, 'password' => $request->password])){

        $user=User::find(Auth::id());

            if($user->role == 1){
                return view("admin.index");
            }else if($user->role == 2){
                return view("assistant.index");
            }else if($user->role == 3){
                return view("supervisor.index");
            }else{
                return view("driverpage.index");
            }


       }else{
        session()->flash('Error', "username or password is invalid" );
        return redirect()->route("login");
       }


    }

    public function index(){



         $user=User::find(Auth::id());

             if($user->role == 1){
                 return view("admin.index");
             }else if($user->role == 2){
                 return view("assistant.index");
             }else if($user->role == 3){
                 return view("supervisor.index");
             }else{
                 return view("driverpage.index");
             }




     }



    public function register(){
        return view("join");
     }


     public function postregister(Request $request){

        $request->validate([
             "username" => "required",
             "email"   => "required",
             "password"=> "required_with:password_confirmation|same:password_confirmation",
             "password_confirmation" => "required"
         ]);

       //  $user_data= $request->only("username", "email" , "password");

         $user= new user();
         $user->name = $request->username;
         $user->email= $request->email;
         $user->password = Hash::make($request->password);  //for decryption of password

         if($user->save()){
            Alert::success('success','You have been registed successfully');
            return redirect()->route('index');

         }else{
            Alert::error('Failed', 'Please, check your connection please try again');
            return back();
         }

     }


    public function logout(){
        Auth::logout();
        return redirect()->route("index");
    }


}
