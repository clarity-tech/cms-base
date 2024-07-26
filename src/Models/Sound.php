<?php

namespace ClarityTech\Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sound extends Model
{
    use HasFactory;

    protected $table = 'sounds';

    public function getTable()
    {
        return config('cms.table_names.sounds', parent::getTable());
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
