<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Invalid login details'],401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
        ])->withCookie(cookie('token',$token,120,null,null,env('COOKIE_SECURE', false),true));
    }



    public function logout()
    {
        $user = Auth::user();

        if($user){
            $user->tokens()->delete();
        }

        Auth::logout();
        Session::flush();
        Session::regenerateToken();

        return response()->json(['message' => 'Logged out'])->withCookie(cookie()->forget('token'))->withCookie(cookie()->forget('XSRF-TOKEN'));
    }
}
