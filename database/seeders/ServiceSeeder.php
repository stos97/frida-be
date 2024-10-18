<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Klasican manikir',
            'category_id' => 1,
        ]);
        Service::create([
            'name' => 'Gel lak',
            'category_id' => 1,
        ]);
        Service::create([
            'name' => 'Jacanje raber bazom',
            'category_id' => 1,
        ]);

        Service::create([
            'name' => 'Klasican pedikir',
            'category_id' => 2,
        ]);
        Service::create([
            'name' => 'Pedikir sa obicnim lakom',
            'category_id' => 2,
        ]);
        Service::create([
            'name' => 'Pedikir sa gel lakom',
            'category_id' => 2,
        ]);
    }
}
