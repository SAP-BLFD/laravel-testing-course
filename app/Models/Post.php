<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    /**
     * @use HasFactory<PostFactory>
     */
    use HasFactory, SoftDeletes;

    /**
     * @return PostFactory
     */


    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];


    /**
     * Holt den Benutzer, dem der Post gehört
     *
     * @return BelongsTo<User, $this>
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
