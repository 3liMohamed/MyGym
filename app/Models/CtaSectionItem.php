<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CtaSectionItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'cta_section_id',
        'text',
        'sort_order',
    ];

    public array $translatable = [
        'text',
    ];

    public function ctaSection(): BelongsTo
    {
        return $this->belongsTo(CtaSection::class);
    }
}
