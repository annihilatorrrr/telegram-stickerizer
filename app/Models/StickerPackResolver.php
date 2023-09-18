<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StickerPackResolver extends Model
{
    protected static $unguarded = true;

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
}
