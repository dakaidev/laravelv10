<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentFile;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    public function index()
    {
        // Esto es para el dashboard
        return view('secretaria.index');
    }

    public function documentsIndex()
    {
        // Esto es para el listado de documentos
        $documents = Document::all();
        return view('secretaria.documents.index', compact('documents'));
    }

    public function create()
    {
        $document_types = DocumentType::all();
        return view('secretaria.documents.create', compact('document_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_number' => 'required|string|unique:documents',
            'document_type_id' => 'required|exists:document_types,id',
            'sender' => 'required|string',
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'date' => 'required|date',
            'received_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $document = Document::create($request->all());

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents');
            DocumentFile::create([
                'document_id' => $document->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('secretaria.documents.index')->with('success', 'Document added successfully');
    }

    public function edit(Document $document)
    {
        $document_types = DocumentType::all();
        return view('secretaria.documents.edit', compact('document', 'document_types'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'document_number' => 'required|string|unique:documents,document_number,' . $document->id,
            'document_type_id' => 'required|exists:document_types,id',
            'sender' => 'required|string',
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'date' => 'required|date',
            'received_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $document->update($request->all());

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents');
            $document->documentFiles()->create(['file_path' => $path]);
        }

        return redirect()->route('secretaria.documents.index')->with('success', 'Document updated successfully');
    }
}