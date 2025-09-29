<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{

    public function index(Request $request)
    {
        $tasks = Auth::user()->tasks();
        if ($request->filled('search')) {
            $tasks->where('title', 'like', '%' . $request->search . '%');
        }
        $tasks = $tasks->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create', [
            'task' => new \App\Models\Task
        ]);
    }


    public function store(CreateTaskRequest $request)
    {
        $user = Auth::user()->id;
        $data = $request->validated();
        $data['user_id'] = $user;
        $task = Task::create($data);
        return redirect()->route('tasks.create')
            ->with('success', 'Task created successfuly');
    }


    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')
                ->with('error', 'You are not authorized to edit this task.');
        }

        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')
                ->with('error', 'You are not authorized to update this task.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')
                ->with('error', 'You are not authorized to delete this task.');
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
    public function toggleStatus(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Not authorized');
        }
        $oldStatus = $task->is_completed;
        $task->is_completed = !$task->is_completed;
        $task->save();

        //logging Information
        log::info('Task status changed', [
            'task_id' => $task->id,
            'title' => $task->title,
            'old_status' => $oldStatus ? 'completed' : 'pending',
            'new_status' => $task->is_completed ? 'Completed' : 'Pending',
            'changed_by' => Auth::user()->id,
            'time' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task status updated!');
    }
    public function search(Request $request)
    {
        $search = $request->query('search');
        $tasks = Auth::user()->tasks;
        if ($search)
            return view('tasks.index', compact('tasks'));
    }
}
