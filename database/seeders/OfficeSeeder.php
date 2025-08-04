<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            ['name' => 'Comunidad Campesina de Taquile'],
            ['name' => 'Asociación de Artesanos de Taquile'],
            ['name' => 'Oficina Comunal de Cultura y Turismo'],
            ['name' => 'Oficina Comunal de Medio Ambiente'],
            ['name' => 'Archivo Histórico de Taquile'],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
