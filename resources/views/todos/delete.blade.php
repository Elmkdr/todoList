@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Todo List</h1>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Add New Todo</a>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->completed ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('todos.show', $todo->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this todo?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
