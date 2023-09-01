<?php

namespace App\Models;

use App\Casts\StickerLayers;
use App\Stickerizer\StickerGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

class Sticker extends Model
{
    use HasTags;

    protected static $unguarded = true;
    protected $casts = [
        'layers' => StickerLayers::class,
    ];

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }

    public function getGenerator(): StickerGenerator
    {
        $generator = StickerGenerator::make($this->width, $this->height);
        $generator->addLayers($this->layers);
        return $generator;
    }

    public function stats(): HasMany
    {
        return $this->hasMany(Statistic::class, 'payload->sticker_id', 'id');
    }
}
