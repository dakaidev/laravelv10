<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.create_user') }}" class="btn btn-success">Create User</a>
        <a href="{{ route('admin.documents.index') }}" class="btn btn-primary">Manage Documents</a>

        <!-- Botón de logout -->
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    
    </div>
</body>
</html>
