@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                    <a href="{{ route('home') }}" class="btn btn-link">Back</a>
                </div>
            </nav>
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="card-text">
                        <h1>{{ $user->name }}</h1>
                        <p>Email: {{ $user->email }}</p>
                        <!-- Tambahkan informasi profil lainnya sesuai kebutuhan -->
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection