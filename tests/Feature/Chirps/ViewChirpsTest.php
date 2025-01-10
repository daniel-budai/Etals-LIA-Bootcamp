<?php

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;

// uses(RefreshDatabase::class); återställ databasen till ursprungsläget

it('can view chirps as guest', function () {
    $chirp = Chirp::factory()->create([
        'message' => 'Test Chirp'
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test Chirp');
});

it('can view chirps as authenticated user', function () {
    $user = User::factory()->create();
    $chirp = Chirp::factory()->create([
        'message' => 'Test Chirp'
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/');

    $response->assertStatus(200);
    $response->assertSee('Test Chirp');
});

it('shows chirps in chronological order with newest first', function () {
    // Skapa chirps med olika tidsstämplar
    $oldChirp = Chirp::factory()->create([
        'message' => 'Old Chirp',
        'created_at' => now()->subHour() // En timme gammal
    ]);

    $newChirp = Chirp::factory()->create([
        'message' => 'New Chirp',
        'created_at' => now() // Nyss skapad
    ]);

    $response = $this->get('/');

    // Kontrollera att de visas i rätt ordning
    $response->assertSeeInOrder([
        'New Chirp',
        'Old Chirp'
    ]);
});