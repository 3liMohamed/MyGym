<?php

namespace App\Models;

use App\Services\ChooseUsService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ChooseUsItems extends Model
{
    use HasTranslations;

    protected $fillable = [
        'choose_section_id',
        'text',
    ];

    public array $translatable = [
        'text',
    ];

    public function chooseSection(): BelongsTo
    {
        return $this->belongsTo(ChooseUs::class);
    }

    protected static function booted(): void
    {
        static::saved(fn () => app(ChooseUsService::class)->flush());
        static::deleted(fn () => app(ChooseUsService::class)->flush());
    }
}
