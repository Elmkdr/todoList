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
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $todo->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Todo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this todo?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var todoId = button.data('id'); // Extract info from data-* attributes
        var action = "{{ url('todos') }}/" + todoId;
        $('#deleteForm').attr('action', action);
    });
});
</script>
@endsection
