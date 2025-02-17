<?php

namespace ClarityTech\Cms\Models;

use ClarityTech\Cms\Cms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends Model
{
    use HasFactory;

    public function content(): BelongsTo
    {
        return $this->belongsTo(Cms::contentModel());
    }
}
