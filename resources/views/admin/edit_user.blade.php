<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.update_user', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_type_id" class="form-label">User Type</label>
                        <select name="user_type_id" id="user_type_id" class="form-select" required>
                            @foreach($user_types as $type)
                                <option value="{{ $type->id }}" {{ $user->user_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="office_id" class="form-label">Office</label>
                        <select name="office_id" id="office_id" class="form-select">
                            <option value="">None</option>
                            @foreach($offices as $office)
                                <option value="{{ $office->id }}" {{ $user->office_id == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update User</button>
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
