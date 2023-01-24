<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\User;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    private $authService;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $credentials = ['login' => $data['login'], 'password' => $data['password'], 'system' => $data['system']];
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'failure'
            ], 401);
        }

        return response()->json([
                'status' => 'success',
                'token' => $token
            ]);
    }
}
