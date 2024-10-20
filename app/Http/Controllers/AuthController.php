<?php

namespace App\Http\Controllers;

use App\Services\TelegramAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @param TelegramAuthService $telegramService
     * @return JsonResponse
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function start(Request $request, TelegramAuthService $telegramService): JsonResponse
    {
        $data = $request->validate([
            //TODO: add all telegram api fields if the real auth is implemented
            'username' => ['required', 'string', 'min:3', 'max:60'],
        ]);

        $user = $telegramService->getOrCreateUser($data);
        $user->tokens()->delete();
        $token = $user->createToken('main', expiresAt: now()->addDay())->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }
}
