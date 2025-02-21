<?php

namespace App\Http\Controllers;

use App\Requests\AuthRequest;
use App\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller {
    protected $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    /**
     * Registers a new user and returns a JSON Web Token.
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $request) {
        $token = $this->authService->register($request->validated());
        return response()->json(['token' => $token], 200);
    }
    
    /**
     * Authenticates a user and returns a JSON Web Token.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request) {
        $token = $this->authService->login($request->validated());
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json(['token' => $token], 200);
    }
    
    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $this->authService->logout($request->user());
        return response()->json(['message' => 'Successfully logged out']);
    }
}