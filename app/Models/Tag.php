<?php

namespace App\Models;

class Tag extends \Spatie\Tags\Tag
{
    public static function findFromStringOfAnyType(string $name, string $locale = null)
    {
        $locale = $locale ?? static::getLocale();

        return static::query()
            ->orWhere(fn($q) => $q
                ->where("name->{$locale}", 'like', "%{$name}%")
                ->orWhere("slug->{$locale}", 'like', "%{$name}%")
            )
            ->distinct()
            ->get();
    }
}
