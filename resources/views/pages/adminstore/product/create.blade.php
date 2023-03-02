@extends('layouts.adminstore')

@section('title')
Lapangan
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Lapangan
            </h2>
            <p class="dashboard-subtitle">
                + Tambah Lapangan
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                     @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                        {{ $message }}
                        </div>
	                @endif
                        <div class="card-body">
                            <form action="{{ route('addproduk') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Lapangan</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pemilik Lapangan</label>
                                            <select name="users_id" class="form-control">
                                                @foreach ( $users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>

                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kategori Lapangan</label>
                                            <select name="categories_id" class="form-control">
                                                 @foreach ( $categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                 @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Harga Lapangan</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskirpsi Lapangan</label>
                                            <textarea name="description" id="editor"> </textarea>
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