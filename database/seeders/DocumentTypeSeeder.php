<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    public function run()
    {
        $documentTypes = [
            ['name' => 'Informe', 'description' => 'Un informe detallado'],
            ['name' => 'Hoja de Coordinación', 'description' => 'Documento para coordinar actividades'],
            ['name' => 'Memorandum', 'description' => 'Un memorandum oficial']
        ];

        foreach ($documentTypes as $type) {
            DocumentType::create($type);
        }
    }
}