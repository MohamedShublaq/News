<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    public function register(Request $request){
        $validator = Validator($request->all(),[
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        if(! $validator->fails()){
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved){
                return response()->json([
                    'status' => true ,
                    'message' => 'Created Account is Successfully',
                ] , 200);
            }
            else{
                return response()->json([
                    'status' => false ,
                    'message' => 'Created Account is Failed',
                ] , 400);
            }
        }
        else{
            return response()->json([
                'status' => false ,
                'message' => $validator->getMessageBag()->first(),
            ] , 400);
        }
    }

    public function login(Request $request){
        $validator = Validator($request->all(),[
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6',
        ]);

        if(! $validator->fails()){
            $admins = Admin::where('email' , $request->get('email'))->first();
            if(Hash::check($request->get('password') , $admins->password)){
                $token = $admins->createToken('admin_api');
                $admins->setAttribute('token' , $token->accessToken);
                return $token;
                return response()->json([
                    'status' => true ,
                    'message' => 'Login is Successfully',
                ] , 200);
            }
            else{
                return response()->json([
                    'status' => false ,
                    'message' => 'Login is Failed',
                ] , 400);
            }
        }

        else{
            return response()->json([
                'status' => false ,
                'message' => $validator->getMessageBag()->first(),
            ] , 400);
        }
    }

    public function logout(Request $request){

    }

    public function forgetPassword(Request $request){

    }


   public function resetPassword(Request $request){

    }
}