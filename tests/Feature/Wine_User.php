<?php

use App\Models\User;
use App\Models\Wine;

use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

beforeEach(function () {
    $this->userWithwines = User::factory()
    ->has(Wine::factory()->count(9), 'wines')
    ->has(Wine::factory()->state(['name' => 'Merlot','color' => 'red'])->count(1), 'wines')
    ->create();

    $this->userwithoutWines = User::factory()->create();
});

it('User has wines', function () {
    expect(count($this->userWithwines->wines))->toBeGreaterThan(0);
});

it('User has 10 wines', function () {
    expect($this->userWithwines->wines)->toHaveCount(10);
});

it('User has no wines, sorry !', function() {
    expect(count($this->userwithoutWines->wines))->toBe(0);
});

it('Wine Name is Merlot', function() {
    $merlotWine = $this->userWithwines->wines->firstWhere('name', 'Merlot');
    expect($merlotWine)->not->toBeNull();
});

it('Wine Color is Red', function() {
    $redWine = $this->userWithwines->wines->firstWhere('color', 'red');
    expect($redWine)->not->toBeNull();
});

it('Wine Color is White', function() {
    $whiteWine = $this->userWithwines->wines->firstWhere('color', 'white');
    expect($whiteWine)->not->toBeNull();
});

it('Wine user_id = User.id',function() {
    expect($this->userWithwines->wines->first()->user_id)->toBe($this->userWithwines->id);
});

it('User Name = Stephan', function() {
    expect($this->userWithwines->first()->name)->toBe('Stephan');
});
