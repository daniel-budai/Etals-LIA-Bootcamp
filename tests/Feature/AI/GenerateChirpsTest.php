<?php

use App\Services\AI\Contracts\AIServiceInterface;
use Illuminate\Support\Facades\Config;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Chat\CreateResponse;
use Tests\Mocks\OpenAI\ChirpResponses;

describe('AI Chirp Generation', function() {
    beforeEach(function() {
        $this->user = \App\Models\User::factory()->create();
        OpenAI::fake(ChirpResponses::all());
    });

    it('requires authentication', function() {
        $response = $this->postJson(route('chirps.ai.generate'));
        $response->assertUnauthorized();
    });

    it('generates chirps with different tones', function() {
        $response = $this
            ->actingAs($this->user)
            ->postJson(route('chirps.ai.generate'));

        $response
            ->assertSuccessful()
            ->assertJsonCount(3, 'chirps')
            ->assertJsonStructure([
                'chirps' => [
                    '*' => [
                        'type',
                        'message'
                    ]
                ]
            ]);

        $chirps = $response->json('chirps');
        
        expect($chirps)->toContain([
            'type' => 'serious',
            'message' => 'A serious post about clean code principles.'
        ])->toContain([
            'type' => 'casual',
            'message' => 'Just spent 3 hours debugging. It was a semicolon 😅'
        ])->toContain([
            'type' => 'sarcastic',
            'message' => 'Oh great, another JavaScript framework to learn!'
        ]);
    });
//happy case
    it('ensures chirps are within 255 character limit', function() { 
        $response = $this
            ->actingAs($this->user)
            ->postJson(route('chirps.ai.generate'));

        $response->assertSuccessful();
        
        $chirps = $response->json('chirps');
        foreach ($chirps as $chirp) {
            expect(strlen($chirp['message']))->toBeLessThanOrEqual(255);
        }
    }); 

});
