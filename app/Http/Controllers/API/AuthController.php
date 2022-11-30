<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function user(): User
    {
        return Auth::user();
    }

    public function login(Request $request): JsonResponse
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
