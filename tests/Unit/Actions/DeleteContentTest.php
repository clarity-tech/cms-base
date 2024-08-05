<?php

namespace ClarityTech\Cms\Tests\Unit\Actions;

use App\Models\User;
use ClarityTech\Cms\Actions\DeleteContent;
use ClarityTech\Cms\Cms;
use ClarityTech\Cms\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class DeleteContentTest extends TestCase
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
    public function it_can_delete_content()
    {
        // first create a content
        $content = Cms::contentModel()::create([
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

        // now delete the content
        $action = new DeleteContent();

        $action->delete($content->id);

        $this->assertSoftDeleted('contents',
            ['id' => $content->id]
        );

        // Assert that the content is not returned in a normal query
        $this->assertNull(Cms::contentModel()::find($content->id));

        // Check if the content exists in the database when including soft deleted records
        $deletedContent = Cms::contentModel()::withTrashed()->find($content->id);
        $this->assertNotNull($deletedContent);
        $this->assertNotNull($deletedContent->deleted_at);
    }
}
