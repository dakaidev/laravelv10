<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\UserType;
use App\Models\DocumentFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create_user()
    {
        $user_types = UserType::all();
        return view('admin.create_user', compact('user_types'));
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|exists:user_types,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'user_type_id' => $request->user_type,
        ]);

        return redirect()->route('admin.index')->with('success', 'User created successfully');
    }

    public function documents_index()
    {
        $documents = Document::all();
        return view('admin.documents.index', compact('documents'));
    }

    public function documents_create()
    {
        $document_types = DocumentType::all();
        return view('admin.documents.create', compact('document_types'));
    }

    public function documents_store(Request $request)
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

        return redirect()->route('admin.documents.index');
    }

    public function documents_edit(Document $document)
    {
        $document_types = DocumentType::all();
        return view('admin.documents.edit', compact('document', 'document_types'));
    }

    public function documents_update(Request $request, Document $document)
    {
        $request->validate([
            'document_number' => 'required|string|unique:documents,document_number,' . $document->id,
            'document_type_id' => 'required|exists:document_types,id',
            'sender' => 'required|string',
            'recipient' => 'required|string',
            'subject' => 'required|string',
            'date' => 'required|date',
            'received_date' => 'required|date',
            'file' => 'sometimes|file|mimes:pdf,doc,docx',
        ]);

        $document->update($request->all());

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents');
            DocumentFile::create([
                'document_id' => $document->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('admin.documents.index');
    }

    public function documents_destroy(Document $document)
    {
        $document->files()->each(function($file) {
            Storage::delete($file->file_path);
            $file->delete();
        });

        $document->delete();
        return redirect()->route('admin.documents.index');
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
                        <a href="' . route('admin.documents.edit', $document->id) . '" class="btn btn-warning">Edit</a>
                        <form action="' . route('admin.documents.destroy', $document->id) . '" method="POST" style="display:inline;">
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
