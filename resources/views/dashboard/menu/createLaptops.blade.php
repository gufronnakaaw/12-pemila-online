@extends('dashboard.master.app')
@section('title', 'Create Laptop')
@section('page_heading', 'Laptop')

@section('content')

<a href="/laptops" class="btn btn-info">
    <i class="fa fa-arrow-left"></i>
    Back
</a>

<form action="/laptops/store" method="post" id="form_add_laptop" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="form-group mt-4">
                <label>Image Laptop (optional)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="img_laptop" name="img_laptop">
                    <label class="custom-file-label" for="img_laptop">Choose file</label>
                </div>
            </div>

            <div class="form-group">
                <label for="name_laptop">Name Laptop *</label>
                <input type="text" class="form-control @error('name_laptop') {{ 'is-invalid ' }} @enderror" name="name_laptop" autocomplete="off" value="{{ old('name_laptop') }}">
                <div class="invalid-feedback">
                    @error('name_laptop') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="brand">Brand Laptop *</label>
                <input type="text" class="form-control @error('brand') {{ 'is-invalid ' }} @enderror" name="brand" autocomplete="off" value="{{ old('brand') }}">
                <div class="invalid-feedback">
                    @error('brand') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select class="form-control @error('status') {{ 'is-invalid ' }} @enderror" id="status" name="status" autocomplete="off">
                    <option value="">- Choose -</option>
                    <option value="used">Used</option>
                    <option value="unused">Unused</option>
                </select>
                <div class="invalid-feedback max-number">
                    @error('status') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
    
</form>
@endsection