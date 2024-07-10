<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Documents</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Documents</h2>
        <a href="{{ route('secretaria.documents.create') }}" class="btn btn-success">Add Document</a>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        <input type="text" id="search" class="form-control" placeholder="Search documents">
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
                            <a href="{{ route('secretaria.documents.edit', $document->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('secretaria.documents.show', $document->id) }}" class="btn btn-info">View</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Formulario de Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('secretaria.documents.search') }}",
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
                                    '<a href="/secretaria/documents/' + document.id + '/edit" class="btn btn-warning">Edit</a> ' +
                                    '<a href="/secretaria/documents/' + document.id + '" class="btn btn-info">View</a> ' +
                                '</td>' +
                            '</tr>';
                            $('#documents-table').append(row);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
