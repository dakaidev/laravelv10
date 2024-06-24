<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>View Document</h2>
        <div>
            <p><strong>Document Number:</strong> {{ $document->document_number }}</p>
            <p><strong>Type:</strong> {{ $document->documentType->name }}</p>
            <p><strong>Sender:</strong> {{ $document->sender }}</p>
            <p><strong>Recipient:</strong> {{ $document->recipient }}</p>
            <p><strong>Subject:</strong> {{ $document->subject }}</p>
            <p><strong>Date:</strong> {{ $document->date }}</p>
            <p><strong>Received Date:</strong> {{ $document->received_date }}</p>
        </div>
        <h3>Files</h3>
        <ul>
            @foreach($files as $file)
                <li>
                    <a href="{{ route('jefe.documents.download', $file->id) }}">{{ basename($file->file_path) }}</a>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('jefe.documents.index') }}" class="btn btn-primary">Back to Documents</a>
    </div>
</body>
</html>
