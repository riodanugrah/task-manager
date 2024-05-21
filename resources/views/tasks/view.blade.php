@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                <li class="breadcrumb-item active" aria-current="page">Task Detail</li>
            </ol>
            <a href="{{ route('tasks.index') }}" class="btn btn-link">Back</a>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>Task Detail</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <p>Category: {{ $task->category }}</p>
                    <p>Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Comments</h3>
                </div>
                <div class="card-body">
                    @if($task->comments->isEmpty())
                    <p>No comments yet.</p>
                    @else
                    <div class="comments">
                        @foreach($task->comments as $comment)
                        <div class="comment" id="comment-{{ $comment->id }}" style="margin-top: 5px;">
                            <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}</p>
                            <!-- Tombol untuk mengedit komentar
                            <button class="edit-comment-btn" data-comment-id="{{ $comment->id }}">Edit</button> -->
                            <!-- Form untuk menghapus komentar -->
                            <form action="{{ route('taskcomments.destroy', ['task' => $task->id, 'comment' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="margin-top: 5px;">Hapus</button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class=" card mt-4">
                <div class="card-header">
                    <h3>Add Comment</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('taskcomments.store', ['task' => $task->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit Comment</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h2>Shared Users</h2>
                </div>
                <div class="card-body">
                    @if(isset($shared) && $shared->count() > 0)
                    <ul>
                        @foreach($shared as $user)
                        <li>{{ $user->name }} - {{ $user->email }}</li>
                        @endforeach
                    </ul>
                    @else
                    <p>No shared users found.</p>
                    @endif
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Share Task</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('taskshare.shared', ['task' => $task->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="emails" class="form-control" placeholder="Enter user emails separated by comma">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Share Task</button>
                        @error('emails')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection