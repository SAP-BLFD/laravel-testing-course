<?php

use App\Models\User;


uses()->beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => bcrypt('password123')
    ]);
});

it('shows the welcome page', function () {
    $response = visit('/');

    $response->assertSee('Laravel');
});

it('shows the login page', function () {
    visit('/login')
        ->assertSee('Log in')
        // ->debug()
        ->assertDontSee('Dashboard');

    visit('/')
        ->click('Log in')
        ->assertSee('Log in')
        ->assertPathIs('/login');

});

it('tests that login works', function () {



    visit('/login')
        ->type('email', $this->user->email)
        ->type('password', 'password123')
        ->press('Log in')
        ->assertPathIs('/dashboard');

});

it('tests that mobile menu works', function () {

    visit('/login')
        ->on()->mobile()
        ->type('email', $this->user->email)
        ->type('password', 'password123')
        ->press('Log in')
        ->assertPathIs('/dashboard')
        ->press('[data-slot=sidebar-trigger]')
        ->assertSee('Laravel')
        ->debug();
});


