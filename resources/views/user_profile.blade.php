@extends('layout')
@section('title', 'User Profile')
@section('content')
<style>

</style>
<div class="container">
    <h1>User Profile</h1>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
        </div>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
        <a href="{{ route('user.changeEmail') }}" class="btn btn-primary">Change</a>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly>
            <a href="{{ route('user.changePhone') }}" class="btn btn-primary">Change</a>
        </div>

        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image">
            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Save Changes</button>
    </form>
</div>
@endsection