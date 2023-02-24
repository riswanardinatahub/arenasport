@extends('layouts.app')

@section('title')
Arena
@endsection

@section('content')
<div class="page-content page-home">
    <!-- Carusel Section -->
    <section class="store-carousel" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#storeCarousel" data-slide-to="0">
                            </li>
                            <li data-target="#storeCarousel" data-slide-to="1">
                            </li>
                            <li data-target="#storeCarousel" data-slide-to="2">
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/images/banner2.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/images/banner1.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/images/banner3.jpg" alt="Carousel Img" class="d-block w-100">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-name">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="d-flex justify-content-center flex-row bd-highlight">
                        <div class="p-2 bd-highlight"><img src="/images/not-ceklis.svg" alt=""></div>
                        <div class="p-1 bd-highlight">
                            <h2>DESA {{ $villages->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Store Trend Categori -->
    <section class="store-trend-categories">
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
                    <a href="{{ route('categories-detail', $category->slug) }}"
                        class="component-categories d-block text-center ">
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
    <section class="store-new-products mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Arena Terbaru</h5>
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
                                @auth
                                    @if($product->users_id == Auth::user()->id)
                                <small class="text-success"> Your Product
                                </small>
                                @else
                                
                                @endif
                                @endauth
                                
                            
                            
                        </div>

                         <span style="font-size:15px; color:#050505; ">
                               Desa : {{ $product->user->villages->name }}
                            </span>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex justify-content-start">
                                 <span style="font-size:13px; color:#29a867; ">
                                 Store : {{ $product->user->store_name }}
                                </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                @if ($product->user->store_status == 1)
                                        <span style="font-size:13px; color:#29a867; ">
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

                        <div class="products-price">
                            <span class="text-dark">RP.</span> {{ number_format($product->price) }}
                        </div>
                    </a>
                </div>

                @empty

                @endforelse
            </div>
        </div>
    </section>


    <!-- Store new Produk -->
    {{-- <section class="store-new-products mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Rokomendasi Produk</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/nasi-samin.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Nasi Samin
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/sayur-sayuran.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/ikan.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/durian.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/kaktus.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/baju.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="700">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/kacamata.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="800">
                    <a href="/details.html" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="background-image: url(/images/ayam.jpg);">
                            </div>
                        </div>
                        <div class="products-text">
                            Aplle Watch 4
                        </div>
                        <div class="products-price">
                            <span class="text-dark">RP.</span> 50.000
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
</div>

@endsection