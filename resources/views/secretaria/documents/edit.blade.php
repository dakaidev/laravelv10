<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit Document</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        <form method="POST" action="{{ route('secretaria.documents.update', $document->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="document_number">Document Number</label>
                <input type="text" name="document_number" id="document_number" class="form-control" value="{{ $document->document_number }}" required>
            </div>
            <div class="form-group">
                <label for="document_type_id">Document Type</label>
                <select name="document_type_id" id="document_type_id" class="form-control" required>
                    @foreach($document_types as $type)
                        <option value="{{ $type->id }}" {{ $document->document_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sender">Sender</label>
                <input type="text" name="sender" id="sender" class="form-control" value="{{ $document->sender }}" required>
            </div>
            <div class="form-group">
                <label for="recipient">Recipient</label>
                <input type="text" name="recipient" id="recipient" class="form-control" value="{{ $document->recipient }}" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" value="{{ $document->subject }}" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $document->date }}" required>
            </div>
            <div class="form-group">
                <label for="received_date">Received Date</label>
                <input type="date" name="received_date" id="received_date" class="form-control" value="{{ $document->received_date }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Document</button>
        </form>
        <!-- Formulario de Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
