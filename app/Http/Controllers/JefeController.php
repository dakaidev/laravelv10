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
        $documents = Document::with('documentType')->where('office_id', auth()->user()->office_id)->get();
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
            'document_number' => 'required|string|unique:documents,document_number,'.$document->id,
            'document_type_id' => 'required|exists:document_types,id',
            'sender' => 'required|string',
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'date' => 'required|date',
            'received_date' => 'required|date',
        ]);

        $document->update($request->all());

        return redirect()->route('jefe.documents.index')->with('success', 'Document updated successfully');
    }

    public function destroy(Document $document)
    {
        $document->files()->each(function($file) {
            Storage::delete($file->file_path);
            $file->delete();
        });

        $document->delete();
        return redirect()->route('jefe.documents.index')->with('success', 'Document deleted successfully');
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

    public function show(Document $document)
    {
        $files = $document->files;
        return view('jefe.documents.show', compact('document', 'files'));
    }

    public function download(DocumentFile $file)
    {
        return Storage::download($file->file_path);
    }
}