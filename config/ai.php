<?php

return [
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
    'max_tokens' => 100,
    'system_prompt' => 'You are a helpful assistant that generates engaging social media posts.',
    
    'prompts' => [
        'chirps' => [
            'serious' => [
                'prompt' => 'Generate a serious tech-related post about programming',
                'parameters' => [
                    'max_length' => 255,
                    'temperature' => 0.7,
                ]
            ],
            'casual' => [
                'prompt' => 'Generate a casual, funny tech-related post',
                'parameters' => [
                    'max_length' => 255,
                    'temperature' => 0.9,
                ]
            ],
            'sarcastic' => [
                'prompt' => 'Generate a sarcastic tech-related post',
                'parameters' => [
                    'max_length' => 255,
                    'temperature' => 1.0,
                ]
            ],
        ]
    ]
]; 