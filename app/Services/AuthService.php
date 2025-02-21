<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService {
    /**
     * Register a new user.
     *
     * @param  array  $data
     * @return string
     */
    public function register($data) {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * Login a user.
     *
     * @param  array  $credentials
     * @return string|null
     */
    public function login($credentials) {
        if (!Auth::attempt($credentials)) {
            return null;
        }
        return Auth::user()->createToken('auth_token')->plainTextToken;
    }
    
    /**
     * Logout a user.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function logout($user) {
        $user->tokens()->delete();
        return true;
    }
}