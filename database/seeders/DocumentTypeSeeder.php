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
            ['name' => 'Informe Cultural', 'description' => 'PDF con información detallada sobre aspectos culturales de la isla'],
            ['name' => 'Relato Tradicional', 'description' => 'Documento PDF que contiene historias o leyendas contadas por los pobladores'],
            ['name' => 'Registro de Fauna y Flora', 'description' => 'Archivo PDF que describe especies observadas en la isla'],
            ['name' => 'Costumbres y Tradiciones', 'description' => 'Documento PDF que detalla prácticas y celebraciones ancestrales'],
            ['name' => 'Acta Comunal', 'description' => 'PDF con acuerdos o reuniones realizadas por autoridades o grupos comunales'],
        ];

        foreach ($documentTypes as $type) {
            DocumentType::create($type);
        }
    }
}