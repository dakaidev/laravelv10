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
        // Eliminar los archivos asociados al documento del sistema de archivos y de la base de datos
        $document->files()->each(function($file) {
            Storage::delete($file->file_path);
            $file->delete();
        });

        // Ahora puedes eliminar el documento
        $document->delete();

        return redirect()->route('jefe.documents.index')->with('success', 'Document deleted successfully');
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
                        <a href="' . route('jefe.documents.edit', $document->id) . '" class="btn btn-warning">Edit</a>
                        <form action="' . route('jefe.documents.destroy', $document->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>';
            }

            return response()->json($output);
        }
    }
}