<?php

namespace App\Service;

use App\Http\Resources\TaskResource;
use App\Jobs\TaskAssignedMail;
use App\Models\Task;

class TaskService
{
    public function getTask($request)
    {
        $tasks = Task::select('id', 'title', 'description', 'assigned_to', 'status', 'due_date')
        ->with(['assigendUser'])
        ->when($request->title, function($q) use($request) {
            $q->where('title', 'like', '%' . $request->title . '%');
        })
        ->when($request->status, function($q) use($request) {
            $q->where('status', $request->status);
        })
        ->when($request->assigned_to, function($q) use($request) {
            $q->where('assigned_to', $request->assigned_to);
        })->paginate(10);

        return ['status' => true , 'tasks' => TaskResource::collection($tasks)];
        
    }

    public function create($request)
    {
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'assigned_to' => $request->assigned_to,
                'status' => $request->status,
                'due_date' => $request->due_date
            ]);
            return ['status' => true, 'message' => 'Task create successfully'];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => 'Task create failed'];
        }
    }

    public function assignTask($id, $request)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        try {
            $task = Task::find($id);
            $task->update([
                'assigned_to' => $request->assigned_to
            ]);
            TaskAssignedMail::dispatch(['userId' => $request->assigned_to, 'task' => $task]);
            return ['status' => true, 'message' => 'Task assigend successfully'];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => 'Task not assigend'];
        }
    }

    public function markAsCompleted($id)
    {
        try {
            Task::find($id)->update([
                'status' => 'completed'
            ]);
            return ['status' => true, 'message' => 'Task Marked as completed'];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => 'Task not Marked as completed'];
        }
    }
}
