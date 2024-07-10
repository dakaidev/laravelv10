<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form method="POST" action="{{ route('admin.update_user', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="user_type_id">User Type</label>
                <select name="user_type_id" id="user_type_id" class="form-control" required>
                    @foreach($user_types as $type)
                        <option value="{{ $type->id }}" {{ $user->user_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="office_id">Office</label>
                <select name="office_id" id="office_id" class="form-control">
                    <option value="">None</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}" {{ $user->office_id == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update User</button>
        </form>
    </div>
</body>
</html>
