@extends('layout')
@section('title', 'Change Email')
@section('content')
<div class="container">
    <h1>Change Email</h1>
    <form action="{{ route('user.updateEmail') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">New Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success">Update Email</button>
    </form>
</div>
@endsection