@extends('layouts.app')

@section('title')
Desaku Category Page
@endsection

@section('content')
<div class="page-content page-home">



  <!-- Store Trend Categori -->
  <section class="store-trend-categories mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Kategori</h5>
        </div>
      </div>
      <div class="row">

        @php
        $incrementCategory = 0
        @endphp

        @forelse ($categories as $category)
        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $incrementCategory+= 100 }}">
          <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block text-center ">
            <div class="categories-image  ">
              <img src="{{ Storage::url($category->photo) }}" alt="" class="img-fluid">
            </div>
          </a>
          <p class="fw-bold text-center">
            {{ $category->name }}
          </p>
        </div>
        @empty
        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
          Data Tidak Di Temukan
        </div>
        @endforelse




      </div>
    </div>
  </section>

  <!-- Store new Produk -->
  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Produk</h5>
        </div>
      </div>
      <div class="row">
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
      </div>
      <div class="row">
        <div class="col-12 mt-4">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </section>
</div>
@endsection