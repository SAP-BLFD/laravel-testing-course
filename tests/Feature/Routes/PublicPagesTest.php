<?php

use function Pest\Laravel\get;
use App\Models\User;

it ('shows the welcome page', function () {
    $response = visit('/');

    $response->assertSee('Laravel');
});

it('shows the login page', function () {
   visit('/login')
    ->assertSee('Log in')
    //->debug()
    ->assertDontSee('Dashboard');

    visit('/')
    ->click('Log in')
    ->assertSee('Log in')
    ->assertPathIs('/login');

});

it('tests that login works', function () {

    $user= User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
    ]);

    visit('/login')
        ->type('email', $user->email)
        ->type('password', 'password123')
        ->press('Log in')
        ->assertPathIs('/dashboard');

});

it ('tests that mobile menu works', function () {
    $user= User::factory()->create([
        'email' => 'test2@example.com',
        'password' => bcrypt('password123'),
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
    ]);

    visit('/login')
    ->on ()->mobile()
        ->type('email', $user->email)
        ->type('password', 'password123')
        ->press('Log in')
        ->assertPathIs('/dashboard')
        ->press('[data-slot=sidebar-trigger]')
        ->assertSee('Laravel');
});
