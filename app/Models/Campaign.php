<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];

    public function images(): HasMany
    {
        return $this->hasMany(CampaignImage::class);
    }

    public static function generateCode(): string
    {
        do {
            $code = Str::random(20);
        } while (self::query()->where('code', $code)->exists());

        return $code;
    }
}
