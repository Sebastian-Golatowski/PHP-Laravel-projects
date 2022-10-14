<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['register','login']]);
    }
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $respone =[
            'user'=>$user,
            'token'=>$token
        ];

        return response($respone, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        $user = User::where('email','like',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message'=>'Wrong Email or Password'
            ],401);
        };

        $token = $user->createToken('myapptoken')->plainTextToken;
        return response([
            'message'=>$user,
            'token'=>$token
        ],201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return[
            'message'=>'Logged out'
        ];
    }
}
