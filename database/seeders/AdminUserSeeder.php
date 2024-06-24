<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Asegurarse de que el tipo de usuario 'admin' existe
        $adminUserType = UserType::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrator']
        );

        // Crear el usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('0T1producci0n'),
            'user_type_id' => $adminUserType->id,
        ]);
    }
}