<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CampaignImage extends Model
{
    use HasFactory;

    public const IMAGE_PATH = 'public/campaigns';

    protected $guarded = ['id'];
    protected $appends = ['path'];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getPathAttribute(): string
    {
        $path = self::IMAGE_PATH;

        return url(Storage::url("{$path}/{$this->attributes['title']}"));
    }
}
