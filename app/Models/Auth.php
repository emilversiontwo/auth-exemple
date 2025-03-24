<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auth extends Model
{
    protected $table = "access_tokens";
    protected $fillable = [
        'token',
        'user_id',
        'active',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
