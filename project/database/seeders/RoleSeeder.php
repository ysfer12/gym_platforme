<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrator',
                'description' => 'System administrator with full access',
            ],
            [
                'name' => 'Member',
                'description' => 'Regular gym member',
            ],
            [
                'name' => 'Trainer',
                'description' => 'Fitness trainer who leads sessions',
            ],
            [
                'name' => 'Receptionist',
                'description' => 'Front desk staff',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}