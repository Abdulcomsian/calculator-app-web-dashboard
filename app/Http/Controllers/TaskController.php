<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getTask(Request $request)
    {
        try {
            $userId = Auth::id();

            $date = $request->input('date');

            $tasks = Task::where('user_id', $userId)
                ->whereDate('date', $date)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $tasks,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function storeOrUpdateTask(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'task' => 'required|string|max:255',
                'date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'description' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            if ($request->has('id')) {
                $task = Task::find($request->input('id'));

                if (!$task) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Task not found.',
                    ], 404);
                }

                $task->update([
                    "task" => $request->input("task"),
                    "date" => $request->input("date"),
                    "start_time" => $request->input("start_time"),
                    "end_time" => $request->input("end_time"),
                    "description" => $request->input("description"),
                ]);

                $message = "Task updated successfully!";
            } else {
                // Create new task
                $task = Task::create([
                    "user_id" => auth()->id(),
                    "task" => $request->input("task"),
                    "date" => $request->input("date"),
                    "start_time" => $request->input("start_time"),
                    "end_time" => $request->input("end_time"),
                    "description" => $request->input("description"),
                ]);

                $message = "Task saved successfully!";
            }

            return response()->json([
                "status" => "success",
                "message" => $message,
                "data" => $task
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteTask($id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json([
                    "status" => "error",
                    "message" => "Task not found.",
                ], 404);
            }

            if ($task->user_id !== auth()->id()) {
                return response()->json([
                    "status" => "error",
                    "message" => "You do not have permission to delete this task.",
                ], 403);
            }

            $task->delete();

            return response()->json([
                "status" => "success",
                "message" => "Task deleted successfully!",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }
}
