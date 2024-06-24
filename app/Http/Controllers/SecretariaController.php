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
        $documents = Document::all();
        return view('secretaria.index', compact('documents'));
    }

    public function documentsIndex()
    {
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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('search');
            $documents = Document::where('document_number', 'like', '%' . $query . '%')
                ->orWhere('sender', 'like', '%' . $query . '%')
                ->orWhere('recipient', 'like', '%' . $query . '%')
                ->orWhere('subject', 'like', '%' . $query . '%')
                ->orWhereHas('documentType', function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->get();
                
            $output = '';
            foreach ($documents as $document) {
                $output .= '<tr>
                    <td>' . $document->document_number . '</td>
                    <td>' . $document->documentType->name . '</td>
                    <td>' . $document->sender . '</td>
                    <td>' . $document->recipient . '</td>
                    <td>' . $document->subject . '</td>
                    <td>' . $document->date . '</td>
                    <td>' . $document->received_date . '</td>
                    <td>
                        <a href="' . route('secretaria.documents.edit', $document->id) . '" class="btn btn-warning">Edit</a>
                    </td>
                </tr>';
            }

            return response()->json($output);
        }
    }
}