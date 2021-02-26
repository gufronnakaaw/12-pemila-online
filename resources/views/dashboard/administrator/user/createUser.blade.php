@extends('dashboard.master.app')
@section('title', 'Create User')
@section('page_heading', 'Users')

@section('content')

<a href="/users" class="btn btn-info">
    <i class="fa fa-arrow-left"></i>
    Back
</a>

<form action="/users/store" method="post" id="form_add_user">
    @csrf
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="text" class="form-control @error('email') {{ 'is-invalid ' }} @enderror" name="email" autocomplete="off" value="{{ old('email') }}">
                <div class="invalid-feedback">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" class="form-control @error('username') {{ 'is-invalid ' }} @enderror" name="username" autocomplete="off" value="{{ old('username') }}">
                <div class="invalid-feedback">
                    @error('username') {{ $message }} @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" class="form-control @error('password') {{ 'is-invalid ' }} @enderror" name="password" autocomplete="off">
                <div class="invalid-feedback max-number">
                    @error('password') {{ $message }} @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role *</label>
                <select class="form-control @error('role') {{ 'is-invalid ' }} @enderror" id="role" name="role" autocomplete="off">
                    <option value="">- Choose -</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <div class="invalid-feedback max-number">
                    @error('role') {{ $message }} @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
    
</form>
@endsection