<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function user()
    {
        return auth()->user();
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        
        if (Auth::attempt($credentials)) {
            return response()->json(['user' => Auth::user()->hasRole('manager'), 'token' => Auth::user()->createToken('authToken')->plainTextToken]);
        }
        
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
