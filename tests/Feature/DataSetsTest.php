<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Product;

test('add numbers', function ($a , $b, $c) {
    expect($a + $b)->toBe($c);
})->with([
    [1,2,3],
    [5,7,12]
]);

it('has full_name accessor',function(){

  $user = User::factory()->make(['first' => 'John', 'last' => 'Doe']);
  expect($user->full_name)->toBe('John Doe');
});

it('user has posts', function () {
    $user = User::factory()->hasPosts(3)->create();
    expect($user->posts)->toHaveCount(3);
});

it('post belongs to user', function () {
    $post = Post::factory()->for(User::factory())->create();
    expect($post->user)->not->toBeNull();
});

it('posts has only published one', function () {
    Post::factory()->create(['published' => true]);
    Post::factory()->create(['published' => false]);

    $publishedPosts = Post::where('published', true)->get();
    expect($publishedPosts)->toHaveCount(1);
});

it('creates/updates/deletes a product', function () {

    // create
    $product = Product::factory()->make();
    $product = Product::create($product->toArray());
    expect(Product::count())->toBe(1);

    // update
    $product->update(['price' => 50]);
    expect($product->fresh()->price)->toBe(50);

    // delete
    $product->delete();
    expect(Product::count())->toBe(0);
});

it('soft deletes as Post', function () {
    $post = Post::factory()->create();
    $post->delete();

    $this->assertSoftDeleted('posts', ['id' => $post->id]);
    $post->restore();
    expect($post->fresh()->deleted_at)->toBeNull();

});
