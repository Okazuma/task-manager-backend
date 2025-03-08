<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            return response()->json(['message' => '認証が必要です'],401);
        }

        $tasks = Task::where('user_id',$user->id)->get();

        return response()->json([
            'message' => 'タスクの取得成功',
            'tasks' => $tasks,
            ]);
    }



    public function store(TaskRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $task = Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'deadline' => $request->deadline,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => ' Task created successfully',
            'task' => [
                'name' => $task->name,
                'detail' => $task->detail,
                'deadline' => $task->deadline,
                'user_id' => $task->user_id,
            ],
        ],201);
    }



    public function update(TaskRequest $request,$taskId)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $task = Task::findOrFail($taskId);
        $task->update($validated);

        return response()->json([
            "task" => [
                "id" => $task->id,
                "name" => $task->name,
                "detail" => $task->detail,
                "deadline" => $task->deadline,
                "user_id" => $user->id,
            ]
        ],200);
    }



    public function destroy(Request $request,$taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        return response()->json([
            'message' => 'User destroy successfully'
        ],200);
    }
}
