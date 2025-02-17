<?php

namespace ClarityTech\Cms\Models;

use ClarityTech\Cms\Traits\InteractsByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Content extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsByUser, HasSlug, InteractsWithMedia, HasTags;

    public string $state;

    protected $fillable = [
        'taxonomy_id',
        'layout',
        'title',
        'slug',
        'type',
        'content',
        'excerpt',
        'author_id',
        'published_at',
        'meta_tags',
        'custom_properties',
        'order_column',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'meta_tags' => 'array',
            'custom_properties' => 'array',
            'published_at' => 'datetime',
        ];
    }

    public function isPublished(): bool 
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/jpeg' || $file->mimeType === 'image/png';
            });
    }

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id');
    }

    // FIXME: disabled author_id in content table temporarily
    // public function author(): BelongsTo
    // {
    //     return $this->belongsTo(Taxonomy::class, 'author_id');
    // }

    // /**
    //  * Get the author's creator (user who created the taxonomy).
    //  */
    // public function authorCreatedBy(): BelongsTo
    // {
    //     return $this->author->belongsTo(User::class, 'created_by');
    // }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
