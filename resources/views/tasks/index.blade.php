@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tasks</h1>

        <!-- Filter Dropdown -->
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Tasks</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Task List -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th> <!-- Add an Actions column -->
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Delete Button -->
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this task?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
