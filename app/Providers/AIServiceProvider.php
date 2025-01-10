<?php

namespace App\Providers;

use App\Services\AI\OpenAIService;
use App\Services\AI\Contracts\AIServiceInterface;
use Illuminate\Support\ServiceProvider;

class AIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AIServiceInterface::class, OpenAIService::class);
    }
} 