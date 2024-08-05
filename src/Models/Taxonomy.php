<?php

namespace ClarityTech\Cms\Models;

use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Traits\InteractsByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Taxonomy extends Model
{
    use HasFactory, SoftDeletes, InteractsByUser;

    protected $fillable = [
        'name',
        'type_of',
        'custom_properties',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'custom_properties' => 'array',
        ];
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Cms::contentModel());
    }

    public function sounds(): HasMany
    {
        return $this->hasMany(Sound::class);
    }
}
