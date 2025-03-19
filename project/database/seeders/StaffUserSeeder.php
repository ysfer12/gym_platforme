<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@fittrackgym.com',
            'password' => Hash::make('admin123'),
            'address' => '123 Admin Street',
            'role' => 'Administrator',
            'status' => 'Active',
            'registrationDate' => now(),
            'email_verified_at' => now(),
        ]);

        // Create Trainers
        $trainers = [
            [
                'firstname' => 'John',
                'lastname' => 'Davis',
                'email' => 'john.davis@fittrackgym.com',
                'password' => Hash::make('trainer123'),
                'address' => '456 Trainer Avenue',
            ],
            [
                'firstname' => 'Sarah',
                'lastname' => 'Johnson',
                'email' => 'sarah.johnson@fittrackgym.com',
                'password' => Hash::make('trainer123'),
                'address' => '789 Fitness Street',
            ],
            [
                'firstname' => 'Mike',
                'lastname' => 'Roberts',
                'email' => 'mike.roberts@fittrackgym.com',
                'password' => Hash::make('trainer123'),
                'address' => '101 Gym Boulevard',
            ],
        ];

        foreach ($trainers as $trainer) {
            User::create([
                'firstname' => $trainer['firstname'],
                'lastname' => $trainer['lastname'],
                'email' => $trainer['email'],
                'password' => $trainer['password'],
                'address' => $trainer['address'],
                'role' => 'Trainer',
                'status' => 'Active',
                'registrationDate' => now(),
                'email_verified_at' => now(),
            ]);
        }

        // Create Receptionists
        $receptionists = [
            [
                'firstname' => 'Jessica',
                'lastname' => 'Smith',
                'email' => 'jessica.smith@fittrackgym.com',
                'password' => Hash::make('reception123'),
                'address' => '202 Reception Road',
            ],
            [
                'firstname' => 'David',
                'lastname' => 'Brown',
                'email' => 'david.brown@fittrackgym.com',
                'password' => Hash::make('reception123'),
                'address' => '303 Front Desk Lane',
            ],
        ];

        foreach ($receptionists as $receptionist) {
            User::create([
                'firstname' => $receptionist['firstname'],
                'lastname' => $receptionist['lastname'],
                'email' => $receptionist['email'],
                'password' => $receptionist['password'],
                'address' => $receptionist['address'],
                'role' => 'Receptionist',
                'status' => 'Active',
                'registrationDate' => now(),
                'email_verified_at' => now(),
            ]);
        }
    }
}