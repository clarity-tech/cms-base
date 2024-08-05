<?php

namespace ClarityTech\Cms\Tests\Unit\Actions;

use App\Models\User;
use ClarityTech\Cms\Actions\CreateContent;
use ClarityTech\Cms\Cms;
use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CreateContentTest extends TestCase
{
    use RefreshDatabase;

    protected $users;

    protected function setUp(): void
    {
        parent::setUp();

        // Create three users
        $this->users = User::factory()->count(3)->create();
    }

    #[Test]
    public function it_can_create_content() 
    {
        $action = new CreateContent();

        $data = [
            'layout' => 'default',
            'title' => 'Sample Title',
            'slug' => 'sample-title',
            'type' => 'post',
            'content' => 'This is a sample content.',
            'excerpt' => 'This is a sample excerpt.',
            'meta_tags' => ['description' => 'A sample description', 'keywords' => 'sample, content'],
            'custom_properties' => ['property1' => 'value1', 'property2' => 'value2'],
            'order_column' => 1,
            'created_by' => $this->users[0]->id,
            'updated_by' => null,
            'deleted_by' => null,
            'published_at' => now(),
        ];

        $content = $action->create(new ContentData($data));

        $this->assertInstanceOf(Cms::contentModel(), $content);
        $this->assertEquals($data['title'], $content->title);
    }
}