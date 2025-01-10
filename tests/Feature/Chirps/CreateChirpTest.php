<?php

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class);

//i want to create a new chirp
describe('creating chirps', function() {
    beforeEach(function() {
        $this->user = User::factory()->create();
    });
    //i want to create a new chirps only when logged in
    it('can store new chirp as authenticated user', function() {
        $response = $this
            ->actingAs($this->user)
            ->post('/', [
                'message' => 'Test Chirp'
            ]);

        $response->assertRedirect('/');
        
        expect(Chirp::count())->toBe(1)
            ->and(Chirp::first()->message)->toBe('Test Chirp');
    });
    //i want to create a new chirp only when logged in and be redirected to login page if not logged in
    it('cannot store chirp as guest', function() {
        $response = $this->post('/', [
            'message' => 'Test Chirp'
        ]);

        $response->assertRedirect('/login');  
        expect(Chirp::count())->toBe(0);      // no chirp created
    });
});
