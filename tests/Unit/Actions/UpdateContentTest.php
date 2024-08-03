<?php

namespace ClarityTech\Cms\Tests\Unit\Actions;

use App\Models\User;
use ClarityTech\Cms\Actions\UpdateContent;
use ClarityTech\Cms\DataTransferObjects\ContentData;
use ClarityTech\Cms\Models\Content;
use ClarityTech\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class UpdateContentTest extends TestCase
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
    public function it_can_update_content()
    {
        // first create a content
        $content = Content::create([
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
        ]);


        // now update the content
        $action = new UpdateContent();

        $data = [
            'layout' => 'default',
            'title' => 'Sample Title Updated',
            'slug' => 'sample-title-updated',
            'type' => 'post',
            'content' => 'This is a sample content.',
            'excerpt' => 'This is a sample excerpt.',
            'meta_tags' => ['description' => 'A sample description', 'keywords' => 'sample, content'],
            'custom_properties' => ['property1' => 'value1', 'property2' => 'value2'],
            'order_column' => 1,
            'updated_by' => $this->users[0]->id,
            'deleted_by' => null,
            'published_at' => now(),
        ];

        $updatedContent = $action->update($content->id, new ContentData($data));

        $this->assertInstanceOf(Content::class, $updatedContent);
        $this->assertEquals($data['title'], $updatedContent->title);
        $this->assertEquals($data['updated_by'], $updatedContent->updated_by);
    }
}
