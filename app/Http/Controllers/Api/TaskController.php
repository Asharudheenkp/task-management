<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Service\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    public function index(Request $request)
    {
        $tasks = $this->taskService->getTask($request);
        return response()->json($tasks);
    }

    public function create(TaskCreateRequest $request)
    {
        $response = $this->taskService->create($request);
        return response()->json($response);
    }

    public function assignTask($id, Request $request)
    {
        $response = $this->taskService->assignTask($id, $request);
        return response()->json($response);
    }

    public function markAsCompleted($id)
    {
        $response = $this->taskService->markAsCompleted($id);
        return response()->json($response);
    }
}
