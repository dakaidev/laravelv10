<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Create User</h2>
        <form method="POST" action="{{ route('admin.store_user') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_type">User Type</label>
                <select name="user_type" id="user_type" class="form-control" required>
                    @foreach($user_types as $user_type)
                        <option value="{{ $user_type->id }}">{{ $user_type->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create User</button>
        </form>
    </div>
</body>
</html>
