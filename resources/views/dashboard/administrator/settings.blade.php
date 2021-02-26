@extends('dashboard.master.app')
@section('title', 'Settings')
@section('page_heading', 'Settings')

@section('content')

@if(Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="span-close">&times;</span>
    </button>
</div>
@endif

@if(Session::get('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ Session::get('fail') }}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="span-close">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-4 offset-md-4">
        <form action="/settings/update" method="POST" enctype="multipart/form-data" autocomplete="off">
            @method('patch')
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id }}">
            <div class="text-center">
                <img src="{{ asset("img/admin/$user->img") }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
            </div>

            <div class="form-group mt-4">
                <label>Change Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error ('edit_img_admin') {{ 'is-invalid' }} @enderror" id="edit_img_admin" name="edit_img_admin">
                    <label class="custom-file-label" for="edit_img_admin">Choose file</label>
                    <div class="invalid-feedback">
                        @error('edit_img_admin')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label>Email</label>
                <input type="text" class="form-control" disabled value="{{ $user->email }}">
            </div>
            
            <div class="form-group mt-4">
                <label>Username</label>
                <input type="text" class="form-control @error ('edit_username_admin') {{ 'is-invalid' }} @enderror" name="edit_username_admin" value="{{ $user->username }}">
                <div class="invalid-feedback">
                    @error('edit_username_admin')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-info">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection