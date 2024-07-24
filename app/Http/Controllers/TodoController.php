<?php
// app/Http/Controllers/TodoController.php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new Todo for the authenticated user
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Optionally, you can return a response or redirect
        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
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

        // Redirect to the todos index page with a success message
        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();

        return redirect()->back();
    }
}
