<!DOCTYPE html>
<html>
<head>
    <title>todo Deleted</title>
</head>
<body>
    <h1>todo Deleted</h1>
    <p><strong>Title:</strong> {{ $todo->title }}</p>
    <p><strong>Description:</strong> {{ $todo->description }}</p>
    <p><strong>Deleted At:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
</body>
</html>
