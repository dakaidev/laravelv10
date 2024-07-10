<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Documents Count</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Office Documents Count</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Office</th>
                    <th>Documents Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offices as $office)
                    <tr>
                        <td>{{ $office->name }}</td>
                        <td>{{ $office->documents_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
