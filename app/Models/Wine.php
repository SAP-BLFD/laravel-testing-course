<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\WineFactory;

class Wine extends Model
{
    /**
    * @use HasFactory <WineFactory>
    */

    use HasFactory;

    /**
     * @return WineFactory
     */

    protected $fillable = [
        'name',
        'colour',
        'user_id',
    ];

    /**
     * Holt den User der dem Wein gehört
     *
     * @return BelongsTo<User, $this>
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
