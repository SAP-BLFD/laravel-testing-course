<?php

use App\Models\User;
use App\Models\Wine;


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->wine = Wine::factory()->count(10)->create(['user_id' => $this->user->id]);
});

it('User has wines', function () {
    expect(count($this->user->wines))->toBeGreaterThan(0);
});

it('User has 10 wines', function () {
    expect($this->user->wines)->toHaveCount(10);
});
