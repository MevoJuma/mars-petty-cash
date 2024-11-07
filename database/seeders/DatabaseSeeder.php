<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'role' => 'employee'
        ]);

        User::factory()->create([
            'name' => 'Head of Department',
            'email' => 'hod@example.com',
            'role' => 'head_of_department'
        ]);

        User::factory()->create([
            'name' => 'Branch Manager',
            'email' => 'branch_manager@example.com',
            'role' => 'branch_manager'
        ]);

        User::factory()->create([
            'name' => 'General Manager',
            'email' => 'gm@example.com',
            'role' => 'general_manager'
        ]);
    }
}
