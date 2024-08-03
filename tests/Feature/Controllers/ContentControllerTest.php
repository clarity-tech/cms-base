<?php

namespace ClarityTech\Cms\Tests\Feature\Controllers;

use App\Models\User;
use ClarityTech\Cms\Models\Content;
use ClarityTech\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class ContentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for our tests
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
    }

    #[Test]
    public function it_can_list_contents()
    {
        // Create 3 content items manually
        for ($i = 1; $i <= 3; $i++) {
            Content::create([
                'title' => "Sample Title $i",
                'slug' => "sample-slug-$i",
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

        $response = $this->getJson(config('cms.routes.api_prefix') . '/contents');

        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_can_show_a_content()
    {
        // Create a single content item
        $content = Content::create([
            'title' => 'Sample Title',
            'slug' => 'sample-slug',
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

        // Debug: Print out all registered routes (might be helpful in future debugging)
        // $routes = Route::getRoutes()->getRoutesByMethod()['GET'];
        // foreach ($routes as $route) {
        //     echo $route->uri() . "\n";
        // }

        $response = $this->getJson(config('cms.routes.api_prefix') . "/contents/{$content->slug}");

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'Sample Title',
                    'slug' => 'sample-slug',
                ]
            ]);
    }
}
