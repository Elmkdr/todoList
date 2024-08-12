<!DOCTYPE html>
<html>
<head>
    <title>New Todo Created</title>
</head>
<body>
    <h1>A New Todo Has Been Created</h1>
    <p><strong>Title:</strong> {{ $todo->title }}</p>
    <p><strong>Description:</strong> {{ $todo->description }}</p>
    <p><strong>Created At:</strong> {{ $todo->created_at->format('d M Y H:i') }}</p>
</body>
</html>
