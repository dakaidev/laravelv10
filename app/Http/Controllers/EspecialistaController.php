<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class EspecialistaController extends Controller
{
    public function index()
    {
        return view('especialista.index');
    }

    public function documentsIndex()
    {
        $documents = Document::with('documentType')->where('office_id', auth()->user()->office_id)->get();
        return view('especialista.documents.index', compact('documents'));
    }

    public function create()
    {
        $document_types = DocumentType::all();
        return view('especialista.documents.create', compact('document_types'));
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

        $document = Document::create([
            'document_number' => $request->document_number,
            'document_type_id' => $request->document_type_id,
            'sender' => $request->sender,
            'recipient' => $request->recipient,
            'subject' => $request->subject,
            'date' => $request->date,
            'received_date' => $request->received_date,
            'office_id' => auth()->user()->office_id,
            'uploaded_by' => $request->user()->id,
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents');
            $document->files()->create([
                'file_path' => $path,
                'uploaded_by' => $request->user()->id,
            ]);
        }

        return redirect()->route('especialista.documents.index')->with('success', 'Document added successfully');
    }

    public function edit(Document $document)
    {
        $document_types = DocumentType::all();
        return view('especialista.documents.edit', compact('document', 'document_types'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'document_number' => 'required|string|unique:documents,document_number,'.$document->id,
            'document_type_id' => 'required|exists:document_types,id',
            'sender' => 'required|string',
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'date' => 'required|date',
            'received_date' => 'required|date',
        ]);

        $document->update($request->all());

        return redirect()->route('especialista.documents.index')->with('success', 'Document updated successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $documents = Document::where('office_id', auth()->user()->office_id)
            ->where(function($q) use ($query) {
                $q->where('document_number', 'like', "%$query%")
                    ->orWhere('sender', 'like', "%$query%")
                    ->orWhere('recipient', 'like', "%$query%")
                    ->orWhere('subject', 'like', "%$query%");
            })
            ->with('documentType')
            ->get();
    
        return response()->json(['documents' => $documents]);
    }
    
}