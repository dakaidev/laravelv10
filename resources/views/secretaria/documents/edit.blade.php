<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2>Edit Document</h2>
            </div>
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back</a>
                <form method="POST" action="{{ route('secretaria.documents.update', $document->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="document_number" class="form-label">Document Number</label>
                        <input type="text" name="document_number" id="document_number" class="form-control" value="{{ $document->document_number }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="document_type_id" class="form-label">Document Type</label>
                        <select name="document_type_id" id="document_type_id" class="form-select" required>
                            @foreach($document_types as $type)
                                <option value="{{ $type->id }}" {{ $document->document_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sender" class="form-label">Sender</label>
                        <input type="text" name="sender" id="sender" class="form-control" value="{{ $document->sender }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient" class="form-label">Recipient</label>
                        <input type="text" name="recipient" id="recipient" class="form-control" value="{{ $document->recipient }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="{{ $document->subject }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $document->date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="received_date" class="form-label">Received Date</label>
                        <input type="date" name="received_date" id="received_date" class="form-control" value="{{ $document->received_date }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update Document</button>
                </form>
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

