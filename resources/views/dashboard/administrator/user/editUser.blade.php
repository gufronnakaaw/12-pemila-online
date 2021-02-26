@extends('dashboard.master.app')
@section('title', 'Update User')
@section('page_heading', 'Users')

@section('content')
<a href="/users" class="btn btn-info">
    <i class="fa fa-arrow-left"></i>
    Back
</a>


@if(Session::get('fail'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ Session::get('fail') }}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="span-close">&times;</span>
    </button>
</div>
@endif

<div class="row mt-4">
    <div class="col-md-4 offset-md-4">
        <form action="/users/updateUser" method="POST" enctype="multipart/form-data" autocomplete="off">
            @method('patch')
            @csrf
            <input type="hidden" name="id_user" value="{{ $user->id }}">
            <div class="text-center">
                <img src="{{ asset("img/user/$user->img") }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
            </div>

            <div class="form-group mt-4">
                <label>Change Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error ('edit_img_user') {{ 'is-invalid' }} @enderror" id="edit_img_user" name="edit_img_user">
                    <label class="custom-file-label" for="edit_img_user">Choose file</label>
                    <div class="invalid-feedback">
                        @error('edit_img_user')
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
                <input type="text" class="form-control @error ('edit_username_user') {{ 'is-invalid' }} @enderror" name="edit_username_user" value="{{ $user->username }}">
                <div class="invalid-feedback">
                    @error('edit_username_user')
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