@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tasks List</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    <!--  Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search -->
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search tasks..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary"> Search</button>
    </form>

    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Completed</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr class="@if($task->due_date?->isPast() && !$task->is_completed) table-danger @endif">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</td>
                            <td>
                                @if($task->is_completed)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-warning text-white">No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- Edit -->
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info me-1">Edit</a>

                                <!-- Toggle Completed -->
                                <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="d-inline-block me-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        {{ $task->is_completed ? 'Mark as Pending' : 'Mark as Complete' }}
                                    </button>
                                </form>

                                <!-- Delete -->
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
