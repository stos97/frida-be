<?php

namespace Database\Seeders;

use App\Models\AdditionalService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdditionalService::create([
            'type' => 'size',
            'name' => 'S',
        ]);
        AdditionalService::create([
            'type' => 'size',
            'name' => 'M',
        ]);
        AdditionalService::create([
            'type' => 'size',
            'name' => 'L',
        ]);

        AdditionalService::create([
            'type' => 'addition',
            'name' => 'Frenc',
        ]);
        AdditionalService::create([
            'type' => 'addition',
            'name' => 'Ombre',
        ]);
    }
}
