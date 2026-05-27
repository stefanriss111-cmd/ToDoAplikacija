<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {

        return Task::all();

    }

    public function store(Request $request)
    {

        $task = Task::create([

            'title' => $request->title,
            'category' => $request->category,
            'due_date' => $request->due_date,
            'is_completed' => false

        ]);

        return response()->json($task);

    }

    public function update(Request $request, $id)
    {

        $task = Task::find($id);

        if (!$task) {

            return response()->json([
                'message' => 'Task not found'
            ], 404);

        }

        $task->title = $request->title;

        $task->is_completed = $request->is_completed;

        $task->save();

        return response()->json([
            'message' => 'Updated',
            'task' => $task
        ]);

    }

    public function destroy($id)
    {

        $task = Task::find($id);

        if (!$task) {

            return response()->json([
                'message' => 'Task not found'
            ], 404);

        }

        $task->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);

    }

}