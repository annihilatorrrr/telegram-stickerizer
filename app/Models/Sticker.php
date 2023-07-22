<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sticker extends Model
{
    protected static $unguarded = true;
    protected $casts = [
        'layers' => 'array',
    ];

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
}
