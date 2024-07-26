<?php

namespace ClarityTech\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends Model
{
    use HasFactory;

    protected $table = 'translations';

    public function getTable()
    {
        return config('cms.table_names.translations', parent::getTable());
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
