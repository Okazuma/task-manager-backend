<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        $user = Auth::user();

        return response()->json($user);
    }



    public function updateUser(ProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }



    public function destroyUser(Request $request)
    {
        $user = Auth::user();

        $user->delete();


        return response()->json([
            'message' => 'User destroy successfully'
        ],200);
    }
}