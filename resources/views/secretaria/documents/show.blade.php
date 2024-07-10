<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Document Details</h2>
        <p><strong>Document Number:</strong> {{ $document->document_number }}</p>
        <p><strong>Type:</strong> {{ $document->documentType->name }}</p>
        <p><strong>Sender:</strong> {{ $document->sender }}</p>
        <p><strong>Recipient:</strong> {{ $document->recipient }}</p>
        <p><strong>Subject:</strong> {{ $document->subject }}</p>
        <p><strong>Date:</strong> {{ $document->date }}</p>
        <p><strong>Received Date:</strong> {{ $document->received_date }}</p>
        <h3>Files</h3>
        <ul>
            @foreach ($files as $file)
                <li>
                    <a href="{{ route('secretaria.documents.download', $file->id) }}">{{ $file->file_path }}</a>
                </li>
            @endforeach
        </ul>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        <!-- Formulario de Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
