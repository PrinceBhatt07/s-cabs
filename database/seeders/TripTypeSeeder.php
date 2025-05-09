<?php

namespace Database\Seeders;

use App\Models\TripType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tripType = [
            ['name' => 'One Way', 'slug' => 'one-way'],
            ['name' => 'Round Trip', 'slug' => 'round-trip'],
            ['name' => 'Local Trip', 'slug' => 'local-trip'],
        ];


        TripType::insert($tripType);
    }
}
