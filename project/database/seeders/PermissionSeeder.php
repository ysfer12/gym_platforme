<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define permissions
        $permissions = [
            // User management permissions
            [
                'name' => 'manage-users',
                'description' => 'Create, update and delete users',
            ],
            [
                'name' => 'view-users',
                'description' => 'View user details',
            ],
            
            // Session management permissions
            [
                'name' => 'manage-sessions',
                'description' => 'Create, update and delete sessions',
            ],
            [
                'name' => 'view-sessions',
                'description' => 'View session details',
            ],
            [
                'name' => 'book-sessions',
                'description' => 'Book a session',
            ],
            
            // Subscription management permissions
            [
                'name' => 'manage-subscriptions',
                'description' => 'Create, update and delete subscriptions',
            ],
            [
                'name' => 'view-subscriptions',
                'description' => 'View subscription details',
            ],
            
            // Attendance management permissions
            [
                'name' => 'manage-attendances',
                'description' => 'Record and manage attendances',
            ],
            [
                'name' => 'view-attendances',
                'description' => 'View attendance details',
            ],
            
            // Payment management permissions
            [
                'name' => 'manage-payments',
                'description' => 'Process and manage payments',
            ],
            [
                'name' => 'view-payments',
                'description' => 'View payment details',
            ],
        ];

        // Create all permissions
        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        // Assign permissions to roles
        $roles = [
            'Administrator' => [
                'manage-users', 'view-users',
                'manage-sessions', 'view-sessions', 'book-sessions',
                'manage-subscriptions', 'view-subscriptions',
                'manage-attendances', 'view-attendances',
                'manage-payments', 'view-payments',
            ],
            'Trainer' => [
                'view-users',
                'manage-sessions', 'view-sessions',
                'view-subscriptions',
                'manage-attendances', 'view-attendances',
            ],
            'Receptionist' => [
                'view-users',
                'view-sessions', 'book-sessions',
                'manage-subscriptions', 'view-subscriptions',
                'manage-attendances', 'view-attendances',
                'manage-payments', 'view-payments',
            ],
            'Member' => [
                'view-sessions', 'book-sessions',
                'view-subscriptions',
            ],
        ];

        foreach ($roles as $roleName => $permissionNames) {
            $role = Role::where('name', $roleName)->first();
            
            if ($role) {
                $permissions = Permission::whereIn('name', $permissionNames)->get();
                $role->permissions()->attach($permissions);
            }
        }
    }
}