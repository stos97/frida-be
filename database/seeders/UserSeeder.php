<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jelena Tosic',
            'email' => 'jelena@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '123',
        ]);

        User::factory()->create([
            'name' => 'Tamara Mihajlovic',
            'email' => 'tamara@test.com',
            'password' => bcrypt('password'),
            'role' => 'worker',
            'phone' => '123',
        ]);

        User::factory()->create([
            'name' => 'Nevena Nesic',
            'email' => 'nevena@test.com',
            'password' => bcrypt('password'),
            'role' => 'worker',
            'phone' => '123',
        ]);

        User::factory(10)->create();
    }
}
