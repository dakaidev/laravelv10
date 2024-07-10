<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialista Documents</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2>Documents</h2>
                <a href="{{ route('especialista.documents.create') }}" class="btn btn-success">Add Document</a>
            </div>
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back</a>
                <input type="text" id="search" class="form-control mb-3" placeholder="Search documents">
                <table class="table table-striped">
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
                    <tbody id="documents-table">
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
                                    <a href="{{ route('especialista.documents.edit', $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('especialista.documents.search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data){
                        $('#documents-table').empty();
                        $.each(data.documents, function(index, document) {
                            var row = '<tr>' +
                                '<td>' + document.document_number + '</td>' +
                                '<td>' + document.document_type.name + '</td>' +
                                '<td>' + document.sender + '</td>' +
                                '<td>' + document.recipient + '</td>' +
                                '<td>' + document.subject + '</td>' +
                                '<td>' + document.date + '</td>' +
                                '<td>' + document.received_date + '</td>' +
                                '<td>' +
                                    '<a href="/especialista/documents/' + document.id + '/edit" class="btn btn-warning btn-sm">Edit</a>' +
                                '</td>' +
                            '</tr>';
                            $('#documents-table').append(row);
                        });
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
