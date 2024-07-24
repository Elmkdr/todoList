@extends('layouts.app')

@section('content')


<div class="container mt-5">
    <h1>Edit Todo</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $todo->title) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description', $todo->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="completed">Completed</label>
            <select name="completed" class="form-control" id="completed" required>
                <option value="0" {{ $todo->completed ? '' : 'selected' }}>No</option>
                <option value="1" {{ $todo->completed ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Todo</button>
    </form>
    <a href="{{ route('todos.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>

@endsection

