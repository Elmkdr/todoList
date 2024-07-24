@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Todo</h1>
        <p><strong>Title:</strong> {{ $todo->title }}</p>
        <p><strong>Description:</strong> {{ $todo->description }}</p>
        <p><strong>Completed:</strong> {{ $todo->completed ? 'Yes' : 'No' }}</p>
        <a href="{{ route('todos.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
