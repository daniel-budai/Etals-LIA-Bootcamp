<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceInterface;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Config;

class OpenAIService implements AIServiceInterface
{
    public function generateChirps(): array
    {
        $prompts = Config::get('ai.prompts.chirps');
        
        if (!$prompts) {
            throw new \Exception('Prompts configuration not found');
        }
        
        return collect($prompts)
            ->map(fn ($config, $type) => [
                'type' => $type,
                'message' => $this->generateSingleChirp($config)
            ])
            ->values()
            ->all();
    }

    private function generateSingleChirp(array $config): string
    {
        $systemPrompt = config('ai.system_prompt') . 
            ' IMPORTANT: Response MUST be under ' . 
            $config['parameters']['max_length'] . 
            ' characters. No exceptions.';

        $result = OpenAI::chat()->create([
            'model' => config('ai.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt
                ],
                [
                    'role' => 'user',
                    'content' => $config['prompt'] . ' (Maximum ' . $config['parameters']['max_length'] . ' characters)'
                ]
            ],
            'temperature' => $config['parameters']['temperature'] ?? 0.7,
            'max_tokens' => config('ai.max_tokens'),
        ]);

        $content = $result->choices[0]->message->content;
        
        if (strlen($content) > $config['parameters']['max_length']) {
            $content = substr($content, 0, $config['parameters']['max_length']);
            $lastSpace = strrpos($content, ' ');
            if ($lastSpace !== false) {
                $content = substr($content, 0, $lastSpace);
            }
        }

        return $content;
    }
} 