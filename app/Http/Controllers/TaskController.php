<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
// use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        // Log::debug('Authorization token:', ['token' => $token]);

        $user = $request->user();
        // Log::debug('User is null:', ['user' => $user]);  // ユーザー情報がnullの場合にログを出力

        $tasks = Task::where('user_id',$user->id)->get();
        // \Log::info('Tasks for user ' . $user->id, ['tasks' => $tasks]);
        return response()->json($tasks);
    }


    public function store(Request $request)
    {
        
         // 認証されたユーザーのIDを取得
        $user_id = auth()->user()->id;

        $task = Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'deadline' => $request->deadline,
            'user_id' => $user_id,
        ]);
        return response()->json($task,201);
    }


    public function update(Request $request,$id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null,204);
    }
}
