<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('due_date') && $request->due_date != '') {
            $query->whereDate('due_date', '=', $request->due_date);
        }

        $sharedTasks = auth()->user()->tasks();
        $tasks = $query->union($sharedTasks)->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'required',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.view', compact('task'));
    }

    public function edit(Task $task)
    {
        $task = Task::findOrFail($task->id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'due_date' => $request->due_date,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function markAsCompleted(Task $task)
    {
        $task->update(['status' => 'completed']);
        return redirect()->route('tasks.index');
    }

    public function markAsPending(Task $task)
    {
        $task->update(['status' => 'pending']);
        return redirect()->route('tasks.index');
    }
}
