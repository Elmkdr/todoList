<!DOCTYPE html>
<html>
<head>
    <title>todo Updated</title>
</head>
<body>
    <h1>todo Updated</h1>
    <p><strong>Title:</strong> {{ $todo->title }}</p>
    <p><strong>Description:</strong> {{ $todo->description }}</p>
    <p><strong>Updated At:</strong> {{ $todo->updated_at->format('d M Y H:i') }}</p>
</body>
</html>
