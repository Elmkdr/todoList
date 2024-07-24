@extends('layouts.app')

@section('content')
<style>
body, html {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
}

.form-container {
    text-align: center;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
    background-color: #f9f9f9;
}

form {
    display: inline-block;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"] {
    width: 200px; /* Adjust the width as needed */
    padding: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>

    <div class="form-container">
        <h1>Create New Todo</h1>
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div><br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
