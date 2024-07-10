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
            ['name' => 'Oficina de Administración'],
            ['name' => 'Oficina de Recursos Humanos'],
            ['name' => 'Oficina de Tecnología e Informática'],
            ['name' => 'Oficina de Finanzas'],
            ['name' => 'Oficina de Planeamiento'],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
