<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ProductFactory;

class Product extends Model
{
    /**
     * @use HasFactory<ProductFactory>
     */
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return ProductFactory
     */

    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
