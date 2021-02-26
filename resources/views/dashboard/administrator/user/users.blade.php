@extends('dashboard.master.app')
@section('title', 'Users')
@section('page_heading', 'Users')

@section('content')

<a href="/users/create" class="btn btn-info">
    <i class="fa fa-plus"></i>
    Add User
</a>

@if(Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ Session::get('success') }}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="span-close">&times;</span>
    </button>
</div>
@endif

@if(Session::get('fail'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ Session::get('fail') }}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="span-close">&times;</span>
    </button>
</div>
@endif
<div class="table-responsive text-center mt-4">
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        @if ($users->isNotEmpty())
            @foreach ($users as $user)
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">
                    <img src="{{ asset("img/user/$user->img") }}" width="90" height="90" alt="image {{ $user->username }}" srcset="">
                </td>
                <td  class="align-middle">{{ $user->email }}</td>
                <td  class="align-middle">{{ $user->username }}</td>
                <td  class="align-middle">{{ $user->role }}</td>
                <td  class="align-middle">
                    <a href="/users/edit/{{ $user->id }}" class="btn btn-success">Edit</a>

                    <form action="/users/delete/{{ $user->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('are you sure?')" class="btn btn-danger">Delete</button>
                    
                    </form>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="alert alert-danger text-center">Data Empty</td>
            </tr>
        @endif
    </table>
</div>
@endsection