<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $token = Auth::attempt(
            $request->validate([
                "email" => "required|email|exists:users",
                "password" => "required",
            ])
        );

        if (!$token) {
            return response()->json(
                ["message" => "Incorrect login or password"],
                401
            );
        }

        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" =>
                auth()
                    ->factory()
                    ->getTTL() * 60,
        ]);
    }
}
