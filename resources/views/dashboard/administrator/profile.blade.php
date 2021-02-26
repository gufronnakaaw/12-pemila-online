@extends('dashboard.master.app')
@section('title', 'Profile')
@section('page_heading', 'Profile')

@section('content')
<div class="row">
    <div class="col-md-4 offset-md-4">
        <div class="text-center">
            <img src="{{ asset("img/admin/$user->img") }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
        </div>

        <div class="form-group mt-4">
            <label>Email</label>
            <input type="text" class="form-control" disabled value="{{ $user->email }}">
        </div>
        
        <div class="form-group mt-4">
            <label>Username</label>
            <input type="text" class="form-control" disabled value="{{ $user->username }}">
        </div>
    </div>
</div>
@endsection