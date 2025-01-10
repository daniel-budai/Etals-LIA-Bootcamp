<?php

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;

//i want to delete a chirp only if i am logged in
//i can only delete my own chirps 
//i want to be redirected to the / after deleting a chirp


uses(RefreshDatabase::class);

describe('deleting chirps', function() {
    beforeEach(function() {
        $this->user = User::factory()->create();
    });

    it('can delete own chirp as authenticated user', function() {
        $chirp = Chirp::factory()->create([
            'user_id' => $this->user->id,
            'message' => 'Test Chirp'
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete("/{$chirp->id}");

        $response->assertRedirect('/');
        expect(Chirp::count())->toBe(0);
    });

    it('cannot delete chirp owned by other user', function() {
        $otherUser = User::factory()->create();
        $chirp = Chirp::factory()->create([
            'user_id' => $otherUser->id,
            'message' => 'Test Chirp'
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete("/{$chirp->id}");

        $response->assertForbidden();
        expect(Chirp::count())->toBe(1);
    });
});
