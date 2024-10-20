<?php

namespace App\Http\Controllers;

use App\Services\UserLevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class XpController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function progress(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    /**
     * @param Request $request
     * @param UserLevelService $userLevelService
     * @return JsonResponse
     */
    public function earn(Request $request, UserLevelService $userLevelService): JsonResponse
    {
        $user = $userLevelService->updateXp($request->user());

        return response()->json($user);
    }
}
