<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter parameter from the request
        $status = $request->query('status');

        // Query tasks with pagination
        $tasks = Task::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->orderBy('due_date')->paginate(5); // Fetch 10 tasks per page

        // Pass tasks and status to the view
        return view('tasks.index', compact('tasks', 'status'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ]);

        // Mass-assignable fields: title, description, status, due_date
        auth()->user()->tasks()->create($request->except('_token'));  // Exclude the CSRF token

        return redirect()->route('tasks.index');
    }


    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
