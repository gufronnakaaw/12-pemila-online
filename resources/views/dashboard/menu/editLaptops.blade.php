@extends('dashboard.master.app')
@section('title', 'Update Laptop')
@section('page_heading', 'Laptops')

@section('content')
<a href="/laptops" class="btn btn-info">
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
        <form action="/laptops/update" method="POST" enctype="multipart/form-data" autocomplete="off">
            @method('patch')
            @csrf
            <input type="hidden" name="id_laptop" value="{{ $laptop->id }}">
            <div class="text-center">
                <img src="{{ asset("img/laptops/$laptop->img_laptop") }}" alt="..." class="img-thumbnail" style="width: 200px; height: 200px;">
            </div>

            <div class="form-group mt-4">
                <label>Change Image (optional)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error ('edit_img_laptop') {{ 'is-invalid' }} @enderror" id="edit_img_laptop" name="edit_img_laptop">
                    <label class="custom-file-label" for="edit_img_laptop">Choose file</label>
                    <div class="invalid-feedback">
                        @error('edit_img_laptop')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label>Name Laptop</label>
                <input type="text" class="form-control @error ('edit_brand_laptop') {{ 'is-invalid' }} @enderror" value="{{ $laptop->name_laptop }}" name="edit_name_laptop">
                <div class="invalid-feedback">
                    @error('edit_name_laptop')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            
            <div class="form-group mt-4">
                <label>Brand Laptop</label>
                <input type="text" class="form-control @error ('edit_brand_laptop') {{ 'is-invalid' }} @enderror" name="edit_brand_laptop" value="{{ $laptop->brand_laptop }}">
                <div class="invalid-feedback">
                    @error('edit_brand_laptop')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status_laptop">Status</label>
                <select class="form-control @error ('edit_status_laptop') {{ 'is-invalid' }} @enderror" name="edit_status_laptop" autocomplete="off">
                    <option value="">- Choose -</option>
                    <option value="used" {{ ($laptop->status == 'used') ? 'selected' : '' }}>Used</option>
                    <option value="unused"{{ ($laptop->status == 'unused') ? 'selected' : '' }}>Unused</option>
                </select>
                <div class="invalid-feedback max-number">
                    @error('edit_status_laptop') {{ $message }} @enderror
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-info">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection