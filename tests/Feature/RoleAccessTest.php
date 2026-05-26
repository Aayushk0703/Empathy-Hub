<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Staff']);
        Role::firstOrCreate(['name' => 'Student']);
    }

    public function test_student_cannot_access_admin_posts_route(): void
    {
        $student = User::factory()->create();
        $student->assignRole('Student');

        $response = $this->actingAs($student)->get(route('admin.posts.index'));
        $response->assertForbidden();
    }

    public function test_staff_can_access_admin_posts_route(): void
    {
        $staff = User::factory()->create();
        $staff->assignRole('Staff');

        $response = $this->actingAs($staff)->get(route('admin.posts.index'));
        $response->assertStatus(200);
    }

    public function test_staff_cannot_access_admin_payments_route(): void
    {
        $staff = User::factory()->create();
        $staff->assignRole('Staff');

        $response = $this->actingAs($staff)->get(route('admin.payments.index'));
        $response->assertForbidden();
    }
}

