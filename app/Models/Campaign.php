<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['images'];

    protected $dates = ['start_date', 'end_date'];

    public static function generateCode(): string
    {
        do {
            $code = Str::random(20);
        } while (self::query()->where('code', $code)->exists());

        return $code;
    }

    public function images(): HasMany
    {
        return $this->hasMany(CampaignImage::class);
    }
}
