<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AI\Contracts\AIServiceInterface;
use Illuminate\Http\JsonResponse;

class AIChirpController extends Controller
{
    public function __construct(
        private AIServiceInterface $aiService
    ) {}

    public function generate(): JsonResponse
    {
        try {
            $chirps = $this->aiService->generateChirps();
            return response()->json(['chirps' => $chirps]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate chirps: ' . $e->getMessage()
            ], 500);
        }
    }
} 