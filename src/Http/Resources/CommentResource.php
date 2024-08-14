<?php

namespace ClarityTech\Cms\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommentResource
 * @package ClarityTech\Cms\Http\Resources
 * @property int $id
 * @property int $content_id
 * @property int $user_id
 * @property string $ip
 * @property bool $is_approved
 * @property string $comment
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Database\Eloquent\Collection $children
 * @property \Illuminate\Database\Eloquent\Model $commentable
 * @property \Illuminate\Database\Eloquent\Model $user
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'content_id' => $this->content_id,
            'user_id' => $this->user_id,
            'ip' => $this->ip,
            'is_approved' => $this->is_approved,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            // 'children' => CommentResource::collection($this->whenLoaded('children')),
            // 'commentable' => $this->when($this->relationLoaded('commentable'), function () {
            //     return $this->commentable->toArray();
            // }),
            'user' => $this->when($this->relationLoaded('user'), function () {
                return $this->user->toArray();
            }),
        ];
    }
}
