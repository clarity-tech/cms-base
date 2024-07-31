<?php

namespace ClarityTech\Cms\DataTransferObjects;

class ContentData
{
    public string $title;
    public string $slug;
    public string $excerpt;
    public string $content;
    public ?array $meta_tags;
    public ?array $custom_properties;
    public int $order_column;
    public string $type;
    public string $layout;
    public ?int $created_by;
    public ?int $updated_by;
    public ?int $deleted_by;
    public ?string $published_at;

    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->excerpt = $data['excerpt'] ?? null;
        $this->content = $data['content'] ?? null;
        $this->meta_tags = $data['meta_tags'] ?? null;
        $this->custom_properties = $data['custom_properties'] ?? null;
        $this->order_column = $data['order_column'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->layout = $data['layout'] ?? null;
        $this->created_by = $data['created_by'] ?? null;
        $this->updated_by = $data['updated_by'] ?? null;
        $this->deleted_by = $data['deleted_by'] ?? null;
        $this->published_at = $data['published_at'] ?? null;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'meta_tags' => $this->meta_tags,
            'custom_properties' => $this->custom_properties,
            'order_column' => $this->order_column,
            'type' => $this->type,
            'layout' => $this->layout,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'published_at' => $this->published_at,
        ];
    }
}
