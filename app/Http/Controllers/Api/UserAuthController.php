<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Service\UserAuthService;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function __construct(protected UserAuthService $userAuthService)
    {
    }
    public function register(UserCreateRequest $request)
    {
        $response = $this->userAuthService->register($request);
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $response = $this->userAuthService->login($request);
        return response()->json($response);
    }
}
