<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        UserType::firstOrCreate(['name' => 'admin'], ['description' => 'Administrator']);
        UserType::firstOrCreate(['name' => 'jefe'], ['description' => 'Jefe']);
        UserType::firstOrCreate(['name' => 'secretaria'], ['description' => 'Secretaria']);
    }
}
