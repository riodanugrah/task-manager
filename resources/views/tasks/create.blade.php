@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Task</li>
            </ol>
            <a href="{{ route('tasks.index') }}" class="btn btn-link">Back</a>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            <h1>Create Task</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="personal">Personal</option>
                        <option value="work">Work</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" style="width: 250px;" id="due_date" name="due_date" required>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection