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
            <div class="col-lg-6 mt-3">
              <div class="owner card">
                <div class="card-body">
                  <a href="store.html" class="card-list d-block mb-0">
                    <div class="card-body py-0">
                      <div class="row align-items-center">
                        <img src="/images/icon-store.svg" alt="" class="mr-3" style="max-height: 65px;">
                        <p class="text-bold mt-4" style="font-size: 20px;">{{ $user->store_name }}</p>
                      </div>
                    </div>
                  </a>
                  <div class="row">
                    <div class="col-6 col-md-6">
                      Jumlah Arena : <span> {{ $products_count }} </span>
                    </div>
                    <div class="col-6 col-md-6">
                      Status Arena :  
                      @if ($user->store_status == 1)
                      <span class="text-success">Buka</span>
                      @else
                      <span class="text-danger">Tutup</span>
                      @endif 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>

      <section class="store-new-products mt-3">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Arena </h5>
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