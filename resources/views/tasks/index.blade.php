@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks Manager</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
    <div class="row mb-3">
        <div class="col">
            <form action="{{ route('tasks.index') }}" method="GET">
                <div class="input-group" style="padding-top: 10px;">
                    <select class="form-select" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <input type="date" class="form-control" name="due_date" value="{{ request('due_date') }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($tasks as $task)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('tasks.view', $task->id) }}">{{ $task->title }}</a></h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <p class="card-text">Category: {{ ucfirst($task->category) }}</p>
                    <p class="card-text">Due Date: {{ $task->due_date }}</p>
                    <p class="card-text">Status: {{ ucfirst($task->status) }}</p>
                    <div class="d-flex gap-2">
                        <div class="flex-fill">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning text-white w-100">Edit</a>
                        </div>
                        <div class="flex-fill">
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                    @if($task->status == 'pending')
                    <form action="{{ route('tasks.markAsCompleted', $task) }}" method="POST" style="display: flex;">
                        @csrf
                        <button type="submit" class="btn btn-success w-100" style="margin-top: 5px;">Mark as Completed</button>
                    </form>
                    @else
                    <form action="{{ route('tasks.markAsPending', $task) }}" method="POST" style="display: flex;">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-100" style="margin-top: 5px;">Mark as Pending</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $tasks->links('pagination::bootstrap-4') }}
</div>
@endsection