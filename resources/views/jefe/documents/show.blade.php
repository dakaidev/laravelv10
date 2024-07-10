<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2>Document Details</h2>
            </div>
            <div class="card-body">
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
                            <a href="{{ route('jefe.documents.download', $file->id) }}">{{ $file->file_path }}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
        <div class="text-center mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
