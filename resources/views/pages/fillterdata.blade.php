@extends('layouts.app')

@section('title')
Arena Category Page
@endsection
<style> 

input[type="text"]{
background-color:white !important;
border: 3px solid #358F66;
}


i{
    color: #358F66;
}

input[type=text]:focus {
  border: 3px solid #358F66;
}
.input-group-prepend span{
    background-color:white !important;
border: 3px solid #358F66;
line-height: 1;
}

.input-group select.form-control {
  background-color:white !important;
  border: 3px solid #358F66;
  
}



</style>
@section('content')
<div class="page-content page-home">



  <!-- Store Trend Categori -->
 <section class="store-carouse pt-3" data-aos="fade-up">
        <div class="container">
       <form action="{{ route('filterdata') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div  class="row  justify-content-center">

                <div class="col-12 col-md-3 col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>

                        </div>
                        <input type="text" class="form-control" name="arena" placeholder="Nama Arena" aria-label="Nama Arena" aria-describedby="basic-addon1">
                    </div>
                </div>
           
                <div class="col-md-3 col-lg-3 ">
                            <div class="input-group mb-3" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"></i></span>
                                </div>
                              <select name="regencies_id" id="" class="form-control">
                                <option value=""  selected> Pilih Kota</option>
                                @foreach ($regencies as $regency)
                                  <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                                @endforeach
                              </select>
                            </div>
                </div>

                <div class="col-md-3 col-lg-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-bars"></i></span>
                                </div>
                              <select name="category" id="" class="form-control">
                                <option value="" selected> Pilih Kategori</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                            </div>
                </div>

                
                <div class="col-12 col-md-1 col-lg-1">
                    <button type="submit" class="btn btn-success btn-md px-3 mb-2 btn-block">Cari</button>
                </div>
            </div>
        </form>
        
           
        </div>
    </section>


    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Halaman Utama</a>
                            </li>
                           
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

  <!-- Store new Produk -->
  {{-- <body class="" > --}}
  <section class="store-new-products min-vh-100" >
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
        
                      <span style="font-size: 23px; color: black; font-weight:800;"> Arena </span>

        </div>
      </div>
                    <div class="row">
                        @php
                        $incrementProduct = 0
                        @endphp
                        @forelse ( $products as $product)
                        <div class="col-12 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+=100 }}">
                            @if($product->user->store_status == 1)
                            <a href="{{ route('store-page-detail', $product->user->id) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image" style="
                                                 @if ($product->user->arena_photos)
                                                    background-image: url('{{ Storage::url($product->user->arena_photos) }}')
                                                 @else
                                                    background-image: url('{{ Storage::url('/assets/product/no-photo.png') }}')
                                                 @endif 
                                                ">
                                    </div>
                                </div>
                              
                                <div class="products-text">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:black; ">
                                                <i  class="fa-solid fa-store pr-1" style="color:black;"></i>{{ $product->user->store_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end">
                                            @if ($product->user->store_status == 1)
                                            <span style="font-size:13px; color:green; ">
                                                Buka
                    
                                            </span>
                                            @else
                                            <span style="font-size:13px; color:red; ">
                                                Tutup
                    
                                            </span>
                                            @endif
                    
                                        </div>
                                    </div>
                                </div>
                                    {{-- {{ $product->name }}
                                    @auth
                                    @if($product->users_id == Auth::user()->id)
                                    <small class="text-success"> Your Product
                                    </small>
                                    @else
                    
                                    @endif
                                    @endauth --}}
                                </div>
                                
                    
                              


                                <div class="row">
                                    <div class="col-8">
                                        <div class="d-flex justify-content-start">
                                            <div class="">
                                    <span style="font-size:12px; color:black; ">
                                    {{ $product->user->regencies->name }}
                                </span>
                                </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            
                                            <span style="font-size:15px; color:black; ">
                                             {{-- Stok : {{ $product->stock }} --}}

                                             <i class="fa-solid fa-map-location-dot"></i>
                    
                                            </span>
                                           
                    
                                        </div>
                                    </div>
                                </div>
                    
                    
                    
                    
                    
                                

                            </a>
                            @else
                            <a data-toggle="modal" data-target="#exampleModal" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image" style="
                                                 @if ($product->user->arena_photos)
                                                    background-image: url('{{ Storage::url($product->user->arena_photos) }}')
                                                 @else
                                                    background-image: url('{{ Storage::url('/assets/product/no-photo.png') }}')
                                                 @endif 
                                                ">
                                    </div>
                                </div>
                              
                                <div class="products-text">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:black; ">
                                                <i  class="fa-solid fa-store pr-1" style="color:black;"></i>{{ $product->user->store_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="d-flex justify-content-end">
                                            @if ($product->user->store_status == 1)
                                            <span style="font-size:13px; color:green; ">
                                                Buka
                    
                                            </span>
                                            @else
                                            <span style="font-size:13px; color:red; ">
                                                Tutup
                    
                                            </span>
                                            @endif
                    
                                        </div>
                                    </div>
                                </div>
                                    {{-- {{ $product->name }}
                                    @auth
                                    @if($product->users_id == Auth::user()->id)
                                    <small class="text-success"> Your Product
                                    </small>
                                    @else
                    
                                    @endif
                                    @endauth --}}
                                </div>
                                
                    
                              


                                <div class="row">
                                    <div class="col-8">
                                        <div class="d-flex justify-content-start">
                                            <div class="">
                                    <span style="font-size:12px; color:black; ">
                                    {{ $product->user->regencies->name }}
                                </span>
                                </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            
                                            <span style="font-size:15px; color:black; ">
                                             {{-- Stok : {{ $product->stock }} --}}

                                             <i class="fa-solid fa-map-location-dot"></i>
                    
                                            </span>
                                           
                    
                                        </div>
                                    </div>
                                </div>
                    
                    
                    
                    
                    
                                

                            </a>

                          
                            @endif
                        </div>


                        <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Informasi Arena</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3> Mohon Maaf Toko Sedang Tutup </h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                    
                        @empty
                    
                        @endforelse
                    </div>


      {{-- <div class="row">
        @php
        $incrementProduct = 0
        @endphp
        @forelse ( $products as $product)
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+=100 }}">
          <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
            <div class="products-thumbnail">
              <div class="products-image" style="
                             @if ($product->galleries->count())
                                background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                             @else
                                background-image: #eee
                             @endif 
                            ">
              </div>
            </div>
            <div class="products-text">
              {{ $product->name }}
            </div>
            <div class="products-price">
              <span class="text-dark">RP.</span> {{ $product->price }}
            </div>
          </a>
        </div>

        @empty
            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
              Data Tidak Di Temukan
            </div>
        @endforelse
      </div> --}}

      {{-- <div class="row">
        <div class="col-12 mt-4">
          {{ $products->links() }}
        </div>
      </div> --}}
    </div>
  </section>
</div>
@endsection