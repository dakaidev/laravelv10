<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentFile extends Model
{
    use HasFactory;

    protected $fillable = ['document_id', 'file_path'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}