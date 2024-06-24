<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Documents</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Documents</h2>
        <a href="{{ route('secretaria.documents.create') }}" class="btn btn-success">Add Document</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Document Number</th>
                    <th>Type</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Received Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->document_number }}</td>
                        <td>{{ $document->documentType->name }}</td>
                        <td>{{ $document->sender }}</td>
                        <td>{{ $document->recipient }}</td>
                        <td>{{ $document->subject }}</td>
                        <td>{{ $document->date }}</td>
                        <td>{{ $document->received_date }}</td>
                        <td>
                            <a href="{{ route('secretaria.documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>