<?php

namespace Tests\Mocks\OpenAI;

use OpenAI\Responses\Chat\CreateResponse;

class ChirpResponses
{
    public static function serious(): array
    {
        return [
            CreateResponse::fake([
                'choices' => [
                    [
                        'message' => [
                            'content' => 'A serious post about clean code principles.'
                        ]
                    ]
                ]
            ])
        ];
    }

    public static function casual(): array
    {
        return [
            CreateResponse::fake([
                'choices' => [
                    [
                        'message' => [
                            'content' => 'Just spent 3 hours debugging. It was a semicolon 😅'
                        ]
                    ]
                ]
            ])
        ];
    }

    public static function sarcastic(): array
    {
        return [
            CreateResponse::fake([
                'choices' => [
                    [
                        'message' => [
                            'content' => 'Oh great, another JavaScript framework to learn!'
                        ]
                    ]
                ]
            ])
        ];
    }

    public static function all(): array
    {
        return array_merge(
            self::serious(),
            self::casual(),
            self::sarcastic()
        );
    }
} 