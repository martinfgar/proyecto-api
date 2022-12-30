<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login(Request $req){
        $credenciales = $req->only('email','password');
        if (!Auth::attempt($credenciales)){
            return response(['message' => 'Usuario y/o contraseña incorrecta'],401);
        }
        
        $accessToken = Auth::user()->createToken('apiAuthTkn')->accessToken;
        return response(["user" => Auth::user(), "access_token" => $accessToken],200);
    }

    public function register(Request $req){
        if (User::where('email',$req->email)->count() > 0){
            return response(['message' => 'Este email ya está en uso'],409);
        }
        if (!isset($req->name) || !isset($req->email) || !isset($req->password)){
            return response(['Bad request'],400);
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        $accessToken = $user->createToken('apiAuthTkn')->accessToken;
        return response(["user" => $user, "access_token" => $accessToken],201);
    }
}
