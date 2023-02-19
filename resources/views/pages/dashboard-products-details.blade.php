@extends('layouts.dashboard')

@section('title')
Store Dashboard Products Details Pages
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
       {{ $product->name }}
      </h2>
      <p class="dashboard-subtitle">
        Detail Produk
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li> {{ $error }} </li>
              @endforeach
            </ul>
          </div>
          @endif
          <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Produk</label>
                      <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Harga</label>
                      <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Stok</label>
                      <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Kategori Produk</label>
                      <select name="categories_id" class="form-control">
                        <option value="{{ $product->categories_id }}"> Tidak Di Ganti ({{ $product->category->name }})
                        </option>
                        @foreach ( $categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Deskripsi</label>
                      <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                    </div>
                  </div>


                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success px-5 mt-3 btn-block">
                      Simpan
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach ($product->galleries as $gallery)
                <div class="col-md-3">
                  <div class="gallery-container">
                    <img src="{{ Storage::url($gallery->photos ?? '') }}" alt="" class="w-100">
                    <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                      <img src="/images/icon-delete.svg" alt="">
                    </a>
                  </div>
                </div>
                @endforeach
                
                <div class="col-12">
                  <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="products_id" value="{{ $product->id }}" class="d-none" multiple>
                    <input type="file" id="file" name="photos" class="d-none" onchange="form.submit()">

                    <button type="button" class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                      Tambah Foto
                    </button>
                  </form>
                </div>

              </div>
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
  function thisFileUpload() {
    document.getElementById("file").click();
  }
</script>

<script>
  CKEDITOR.replace('editor');
</script>
@endpush