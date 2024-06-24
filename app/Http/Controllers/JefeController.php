<?php


namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JefeController extends Controller
{
    public function index()
    {
        return view('jefe.index');
    }

    public function documentsIndex()
    {
        $documents = Document::all();
        return view('jefe.documents.index', compact('documents'));
    }

    public function create()
    {
        $document_types = DocumentType::all();
        return view('jefe.documents.create', compact('document_types'));
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

        return redirect()->route('jefe.documents.index')->with('success', 'Document added successfully');
    }

    public function edit(Document $document)
    {
        $document_types = DocumentType::all();
        return view('jefe.documents.edit', compact('document', 'document_types'));
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

        return redirect()->route('jefe.documents.index')->with('success', 'Document updated successfully');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('jefe.documents.index')->with('success', 'Document deleted successfully');
    }
}