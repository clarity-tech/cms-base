<?php

namespace ClarityTech\Cms\Models;

use App\Models\User;
use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Traits\InteractsByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use InteractsByUser;

    protected $fillable = [
        'user_id',
        'ip',
        'is_approved',
        'comment',
        'commentable_type',
        'commentable_id',
    ];

    protected function casts() : array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function commentable(): BelongsTo
    {
        return $this->morphTo();
    }
}
