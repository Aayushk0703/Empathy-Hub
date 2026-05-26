<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff']);
        $studentRole = Role::firstOrCreate(['name' => 'Student']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@college.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@12345'),
            ]
        );
        $admin->syncRoles([$adminRole]);
    }
}
