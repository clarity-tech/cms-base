<?php

namespace ClarityTech\Cms\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'layout' => $this->layout,
            'title' => $this->title,
            'slug' => $this->slug,
            'type' => $this->type,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'meta_tags' => $this->meta_tags,
            'custom_properties' => $this->custom_properties,
            'order_column' => $this->order_column,
            'created_by' => $this->whenLoaded('createdBy', function () {
                return [
                    'name' => $this->createdBy->name,
                    'profile_photo_url' => $this->createdBy->profile_photo_url
                ];
            }),
            'updated_by' => $this->whenLoaded('updatedBy', function () {
                return [
                    'name' => $this->updatedBy->name,
                    'profile_photo_url' => $this->updatedBy->profile_photo_url
                ];
            }),
            'published_at' => $this->published_at?->timestamp,
            'created_at' => $this->created_at?->timestamp,
            'updated_at' => $this->updated_at?->timestamp,
        ];
    }
}
