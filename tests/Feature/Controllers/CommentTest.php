<?php

namespace ClarityTech\Cms\Tests\Feature\Controllers;

use App\Models\User;
use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Models\Comment;
use ClarityTech\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $content;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for our tests
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create a single content item
        $this->content = Cms::contentModel()::create([
            'title' => 'Sample Title',
            'slug' => 'sample-slug-x',
            'excerpt' => 'Sample Excerpt',
            'content' => 'Sample Content',
            'meta_tags' => ['tag1', 'tag2'],
            'custom_properties' => ['key' => 'value'],
            'order_column' => 1,
            'type' => 'article',
            'layout' => 'single',
            'created_by' => $this->user->id,
            'updated_by' => null,
            'deleted_by' => null,
            'published_at' => now(),
        ]);
    }

    public function create_comment()
    {
        return Comment::create([
            'user_id' => $this->user->id,
            'content_id' => $this->content->id,
            'ip' => '192.168.1.1',
            'is_approved' => true,
            'comment' => 'This is a demo comment',
            // 'commentable_type' => 'ClarityTech\Cms\Models\Content',
            // 'commentable_id' => $content->id,
        ]);
    }

    #[Test]
    public function it_can_list_comments()
    {
        $this->actingAs($this->user)
            ->getJson(config('cms.routes.api_prefix') . '/contents/{$this->content->slug}/comments')
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'content_id',
                        'user_id',
                        'ip',
                        'is_approved',
                        'comment',
                        'commentable_type',
                        'commentable_id',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    #[Test]
    public function it_can_store_a_comment()
    {   
        $this->actingAs($this->user)
            ->postJson(config('cms.routes.api_prefix') . "/contents/{$this->content->slug}/comments", [
                'user_id' => $this->user->id,
                'content_id' => $this->content->id,
                'ip' => '192.168.1.1',
                'is_approved' => true,
                'comment' => "This is a demo comment",
                // 'commentable_type' => 'ClarityTech\Cms\Models\Content',
                // 'commentable_id' => $content->id,
            ])
            ->assertStatus(JsonResponse::HTTP_CREATED);
            
        $this->assertDatabaseHas('comments', ['comment' => 'This is a demo comment']);
    }

    #[Test]
    public function it_can_show_a_comment()
    {
        // Create a comment
        $this->create_comment();

        $this->actingAs($this->user)->getJson(config('cms.routes.api_prefix') . "/contents/{$this->content->slug}/comments")
            ->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson([
                'data' => [
                    [
                        'comment' => "This is a demo comment",
                    ]
                ]
            ]);
    }

    #[Test]
    public function it_can_update_a_comment()
    {
        $comment = $this->create_comment();

        $this->actingAs($this->user)->putJson(config('cms.routes.api_prefix') . "/comments/{$comment->id}", [
            'comment' => 'This is an updated comment',
        ])->assertStatus(JsonResponse::HTTP_ACCEPTED);
    }

    #[Test]
    public function it_can_delete_a_comment()
    {
        $comment = $this->create_comment();

        $this->actingAs($this->user)
            ->deleteJson(config('cms.routes.api_prefix') . "/comments/{$comment->id}")
            ->assertStatus(JsonResponse::HTTP_NO_CONTENT);

        $this->assertDatabaseCount('comments', 1);
    }
}