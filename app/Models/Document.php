<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number', 'document_type_id', 'sender', 'recipient', 
        'subject', 'date', 'received_date'
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function files()
    {
        return $this->hasMany(DocumentFile::class);
    }
}