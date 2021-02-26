@extends('dashboard.master.app')
@section('title', 'Laptops')
@section('page_heading', 'Laptops')

@section('content')
<a href="/laptops/create" class="btn btn-info">
    <i class="fa fa-plus"></i>
    Add Laptops
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

<div class="table-responsive mt-4">
    <table class="table table-bordered text-center">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @if ($laptops->isNotEmpty())
            @foreach ($laptops as $laptop)
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">
                    <img src="{{ asset("img/laptops/$laptop->img_laptop") }}" width="90" height="90" alt="image {{ $laptop->name_laptop }}" srcset="">
                </td>
                <td class="align-middle">{{ $laptop->name_laptop }}</td>
                <td class="align-middle">{{ $laptop->brand_laptop }}</td>
                <td class="align-middle">{{ $laptop->status }}</td>
                <td class="align-middle">
                    <a href="/laptops/edit/{{ $laptop->id }}" class="btn btn-success">Edit</a>

                    <form action="/laptops/delete/{{ $laptop->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('are you sure?')">Delete</button>
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