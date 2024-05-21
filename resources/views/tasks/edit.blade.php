<!-- resources/views/tasks/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
            </ol>
            <a href="{{ route('tasks.index') }}" class="btn btn-link">Back</a>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Task</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="personal" {{ $task->category == 'personal' ? 'selected' : '' }}>Personal</option>
                        <option value="work" {{ $task->category == 'work' ? 'selected' : '' }}>Work</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" style="width: 250px;" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection