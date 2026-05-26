<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'Admin']);
    }

    public function test_admin_can_create_post(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)->post(route('admin.posts.store'), [
            'title' => 'Admissions Open',
            'slug' => 'admissions-open',
            'excerpt' => '2026 admissions',
            'body' => 'Detailed information for admissions.',
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Admissions Open',
            'slug' => 'admissions-open',
            'status' => 'published',
        ]);
    }

    public function test_admin_can_update_post(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $post = Post::create([
            'user_id' => $admin->id,
            'title' => 'Old title',
            'slug' => 'old-title',
            'body' => 'Body',
            'status' => 'draft',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.posts.update', $post), [
            'title' => 'Updated Title',
            'slug' => 'updated-title',
            'body' => 'Updated body',
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'slug' => 'updated-title',
        ]);
    }

    public function test_admin_can_upload_media_file(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $file = UploadedFile::fake()->create('college.pdf', 500, 'application/pdf');

        $response = $this->actingAs($admin)->post(route('admin.media.store'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        /** @var Media $media */
        $media = Media::query()->first();
        $this->assertNotNull($media);
        Storage::disk('public')->assertExists($media->path);
        $this->assertDatabaseHas('media', [
            'id' => $media->id,
            'disk' => 'public',
        ]);
    }
}

