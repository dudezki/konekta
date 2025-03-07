@extends('layout')
@section('title', 'Change Phone Number')
@section('content')
<div class="container">
    <h1>Change Phone Number</h1>
    <form action="{{ route('user.updatePhone') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="phone">New Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-success">Update Phone Number</button>
    </form>
</div>
@endsection