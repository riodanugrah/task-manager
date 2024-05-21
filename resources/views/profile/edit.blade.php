@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
            <a href="{{ route('profile.show') }}" class="btn btn-link">Back</a>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tambahkan input fields untuk mengedit profile di sini -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection