<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jelena = User::whereId(1)->first();
        $data = [
            1 => [
                'price' => 100,
                'minutesNeeded' => 100,
            ],
            4 => [
                'price' => 400,
                'minutesNeeded' => 400,
            ],
        ];
        $jelena->services()->sync($data);

        $tamara = User::whereId(2)->first();
        $data = [
            2 => [
                'price' => 200,
                'minutesNeeded' => 200,
            ],
            5 => [
                'price' => 500,
                'minutesNeeded' => 500,
            ],
        ];
        $tamara->services()->sync($data);
    }
}
