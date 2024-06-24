<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Documents</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Documents</h2>
        <div class="d-flex justify-content-between">
            <a href="{{ route('secretaria.documents.create') }}" class="btn btn-success">Add Document</a>
            <input type="text" id="search" class="form-control" placeholder="Search Documents" style="width: 300px;">
        </div>
        <table class="table mt-3">
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
            <tbody id="document-list">
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
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                $.ajax({
                    url:"{{ route('secretaria.documents.search') }}",
                    type:"GET",
                    data:{'search':query},
                    success:function(data){
                        $('#document-list').html(data);
                    }
                })
            });
        });
    </script>
</body>
</html>
