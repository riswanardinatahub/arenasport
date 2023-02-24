@extends('layouts.adminstore')

@section('title')
Arena
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Arena Galeri
            </h2>
            <p class="dashboard-subtitle">
                Edit Arena Galeri
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-6">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                        {{ $message }}
                        </div>
	                @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('adminstore-product-gallery.update', $productgallery->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                             <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Arena</label>
                                            <input disabled type="text" name="name" class="form-control" value="{{ $productgallery->product->name}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ Storage::url($productgallery->photos) }}" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Foto Product</label>
                                            <input type="file" name="photos" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
     <script>
     CKEDITOR.replace('editor');
    </script>
@endpush