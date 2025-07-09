<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_is_assigned_to_user(): void
    {
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('Admin');

        $this->assertTrue($user->hasRole('Admin'));
    }
}
