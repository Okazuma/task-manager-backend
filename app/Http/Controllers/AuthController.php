<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Invalid login details'],401);
        }

        $user = Auth::user();
        $token = $user->createToken('TaskManager')->plainTextToken;

            return response()->json(['message' => 'Login successful']);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }
}
