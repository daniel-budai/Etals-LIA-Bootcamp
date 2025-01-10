<?php

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

describe('editing chirps', function() {
    beforeEach(function() {
        $this->user = User::factory()->create();
    });

    it('can update own chirp as authenticated user', function() {
        $chirp = Chirp::factory()->create([
            'user_id' => $this->user->id,
            'message' => 'Original Message'
        ]);

        $response = $this
            ->actingAs($this->user)
            ->put("/{$chirp->id}", [
                'message' => 'Updated Message'
            ]);

        $response->assertRedirect('/');
        expect(Chirp::first()->message)->toBe('Updated Message');
    });

    it('cannot update chirp owned by other user', function() {
        $otherUser = User::factory()->create();
        $chirp = Chirp::factory()->create([
            'user_id' => $otherUser->id,
            'message' => 'Original Message'
        ]);

        $response = $this
            ->actingAs($this->user)
            ->put("/{$chirp->id}", [
                'message' => 'Updated Message'
            ]);

        $response->assertForbidden();
        expect(Chirp::first()->message)->toBe('Original Message');
    });
});
