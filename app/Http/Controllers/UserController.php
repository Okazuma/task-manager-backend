<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    // 現在認証されているユーザーの情報を取得
    public function fetchUser(Request $request)
    {
        $user = Auth::user();  // 現在認証されたユーザーを取得

        return response()->json($user);  // ユーザー情報をJSONで返す
    }

    // ユーザー情報の更新
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        // パスワードが入力されていればハッシュ化して更新
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
}
