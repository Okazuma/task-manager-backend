<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        $user = $request->user();
        $tasks = Task::where('user_id',$user->id)->get();

        return response()->json($tasks);
    }



    public function store(Request $request)
    {
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
