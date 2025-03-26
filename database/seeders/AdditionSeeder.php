<?php

namespace Database\Seeders;

use App\Models\Addition;
use Illuminate\Database\Seeder;

class AdditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizeS = Addition::create([
            'type' => 'size',
            'name' => 'S',
        ]);
        $sizeM = Addition::create([
            'type' => 'size',
            'name' => 'M',
        ]);
        $sizeL = Addition::create([
            'type' => 'size',
            'name' => 'L',
        ]);

        $frenc = Addition::create([
            'type' => 'addition',
            'name' => 'Frenc',
        ]);
        $ombre = Addition::create([
            'type' => 'addition',
            'name' => 'Ombre',
        ]);

        $sizeS->services()->attach(1);
        $sizeM->services()->attach(1);
        $sizeL->services()->attach(1);
        $frenc->services()->attach(1);

        $sizeS->services()->attach(2);
        $sizeM->services()->attach(2);
        $sizeL->services()->attach(2);

        $sizeS->services()->attach(3);
        $sizeM->services()->attach(3);
        $sizeL->services()->attach(3);

        $sizeS->services()->attach(5);
        $sizeM->services()->attach(5);
        $sizeL->services()->attach(5);
        $ombre->services()->attach(5);
    }
}
