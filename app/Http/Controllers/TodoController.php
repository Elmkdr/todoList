<?php
// app/Http/Controllers/TodoController.php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TodoCreated;
use App\Mail\UpdatedTodo;
use App\Mail\DeletedTodo;
use App\Notifications\TodoCreatedNotification;
use Illuminate\Support\Facades\Notification as LaravelNotification;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public $todo;
public function index()
{
    // Ensure the user is authenticated
    $user = Auth::user();

    // Check if user is not null and has todos
    if ($user) {
        // Get the authenticated user's todos
        $todos = $user->todos;
    } else {
        // Handle the case when user is not authenticated or doesn't have todos
        $todos = collect(); // or you could redirect or throw an exception
    }

    // Pass the todos to the view
    return view('todos.index', compact('todos'));
}

public function create()
{
    return view('todos.create');
}

public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,]);

        // Send the email notification
        Mail::to(Auth::user()->email)->send(new TodoCreated($todo));

        return redirect()->route('todos.index')->with('success', 'Todo created successfully and email sent.');
    }


public function notifyCreatedTodo($todo)
{
    try {
        LaravelNotification::send(Auth::user(), new TodoCreatedNotification($todo));
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error sending notification', ['error' => $e->getMessage()]);
    }
}


    public function show($id)
    {
        // Retrieve the todo item by its ID
        $todo = Todo::findOrFail($id);

        // Return the view with the todo item
        return view('todos.show', compact('todo'));
    }
    public function edit($id)
    {
        // Retrieve the todo item by its ID
        $todo = Todo::findOrFail($id);

        // Return the view with the todo item
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
        ]);

        // Find the todo item by ID
        $todo = Todo::findOrFail($id);

        // Update the todo item with new data
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed,
        ]);
        // Send email notification
        Mail::to(Auth::user()->email)->send(new UpdatedTodo($todo));

        // Redirect to the todos index page with a success message
        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        // Send email notification before deletion
        Mail::to(Auth::user()->email)->send(new DeletedTodo($todo));
        $todo->delete();
        
        return redirect()->back();
    }
}
