<?php

namespace App\Http\Controllers;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum',['except'=>['register','login']]);
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required|confirmed'
        ]);

        $user  = new User();
        $user->name = $request->name;
        $user->password =bcrypt($request->password);
        $user->save();

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response($token,201);

    }

    public function login(Request $request){
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('name','like',$request->name)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response(null,401);
        };

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response($token,200);
    }
    
}
