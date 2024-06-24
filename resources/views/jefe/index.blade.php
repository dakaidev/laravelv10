<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jefe Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Jefe Dashboard</h2>
        <a href="{{ route('jefe.documents.create') }}" class="btn btn-success">Add Document</a>
        <a href="{{ route('jefe.documents.index') }}" class="btn btn-primary">Manage Documents</a>
        
        <!-- Formulario de Logout -->
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
