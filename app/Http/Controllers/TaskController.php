<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return response()->json($task);
    }


    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'detail' => $request->detail,
            'status' => $request->status,
            'user_id' => $request->user_id,
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
