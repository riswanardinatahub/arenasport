@extends('layouts.app')

@section('title')
Detail Arena
@endsection

@section('content')
<div class="page-content page-details">
    <div class="store-details-container" data-aos="fade-up">
      <section class="store-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mt-4">
              <div class="owner card "style="height: 20rem;">
                <div class="card-body">
                  <a href="store.html" class="card-list d-block mb-0">
                    <div class="card-body py-0">
                      <div class="row align-items-center">
                      @if ($user->images)
                    <img src="{{ Storage::url($user->images) }}" alt="" class="rounded-circle mr-3 profile-picture">
                    @else
                    <img src="/images/icon-store.svg" alt="" class="mr-3">
                    @endif
                        {{-- <img src="/images/icon-store.svg" alt="" class="mr-3" style="max-height: 65px;"> --}}
                        <p class="text-bold mt-4" style="font-size: 24px; font-weight: 900;">{{ $user->store_name }}</p>
                      </div>
                    </div>
                  </a>
                  <div class="row">
                    <div class="col-12 col-md-12">
                    <span style="font-size: 19px; color: black; font-weight:600;"> {{ $user->regencies->name }} </span>
                      
                    </div>
                    <div class="col-12 col-md-12 mt-2">
                      {{-- Jumlah Lapangan : <span> {{ $products_count }} </span> --}}
                    <span style="font-size: 15px; color: black;"><i class="fa-regular fa-square-check"></i>   Opsi pembayaran Down Payment (DP) </span>

                    </div>

                    <div class="col-12 col-md-12 mt-1">
                      {{-- Jumlah Lapangan : <span> {{ $products_count }} </span> --}}
                    <span style="font-size: 15px; color: black;"><i class="fa-regular fa-square-check"></i>  Reservasi tidak dapat dibatalkan dan tidak berlaku refund </span>

                    </div>

                    <div class="col-12 col-md-9 mt-4">
                        <span style="font-size: 12px; color: black;"> Jl. Gndangan Kecamatan Riau no. 34 Samping Bengkel</span>

                    </div>
                    <div class="col-12 col-md-3 mt-4">
                      <span style="font-size: 13px; color: black;"><i class="fa-solid fa-street-view mr-1"></i> Lihat Peta </span>

                    </div>
                    {{-- <div class="col-6 col-md-6">
                      Status Lapangan :  
                      @if ($user->store_status == 1)
                      <span class="text-success">Buka</span>
                      @else
                      <span class="text-danger">Tutup</span>
                      @endif 
                    </div> --}}
                  </div>


                </div>
              </div>
            </div>

            <div class="col-lg-6 mt-2">
              <div class=" card " style="height: 15rem;">
                <img class="card-img-top img-fluid " src="{{ Storage::url($user->arena_photos)  }}" alt="Card image cap">

                
              </div>
            </div>

          



          </div>

        </div>
      </section>

      <section class="store-new-products mt-3">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-3" data-aos="fade-up">
                      <span style="font-size: 23px; color: black; font-weight:800;"> Lapangan </span>

            </div>
          </div>
          <div class="row">
            @foreach ($products_data as $product)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <a href="{{ route('detail',$product->slug) }}" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" 
                  style="@if ($product->galleries->count())
                  background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                @else
                  background-image: #eee
                @endif ">
                  </div>
                </div>
                <div class="products-text">
                  {{ $product->name }}
                </div>
                <div class="products-price">
                  Rp. {{ number_format($product->price) }}
                </div>
              </a>
            </div>    
            @endforeach
          </div>
        </div>
      </section>

    </div>

  </div>

@endsection