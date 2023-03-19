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
                        <span style="font-size: 12px; color: black;">{{ $user->address_one }}</span>

                    </div>
                    <div class="col-12 col-md-3 mt-4">
                    @if ($user->maps)
                    <a href="{{ $user->maps }}"><span style="font-size: 13px; color: black;"><i class="fa-solid fa-street-view mr-1"></i> Lihat Peta </span></a>
                      
                    @else
                    <a href="#"><span style="font-size: 13px; color: black;"><i class="fa-solid fa-street-view mr-1"></i> Lihat Peta </span></a>
                      
                    @endif
                     

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

            <div class="col-md-6 col-lg-6 d-sm-none mt-2">
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
                        @php
                        $incrementProduct = 0
                        @endphp
                        @forelse ( $products_data as $product)
                        <div class="col-12 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+=100 }}">
                            @if($product->user->store_status == 1)
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image" style="
                                                 @if ($product->galleries->count())
                                                    background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                                                 @else
                                                    background-image: url('{{ Storage::url('/assets/product/no-photo.png') }}')
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
                                <span style="font-size:15px; color:black; ">
                                    {{ $product->user->regencies->name }}
                                </span>
                    
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:black; ">
                                                <i class="fa-solid fa-store pr-1"></i>{{ $product->user->store_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
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


                                <div class="row">
                                    <div class="col-7">
                                        <div class="d-flex justify-content-start">
                                            <div class="products-price">
                                    <span class="text-dark">Rp.</span> {{ number_format($product->price) }}
                                </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="d-flex justify-content-end">
                                            
                                            <span style="font-size:13px; color:black; ">
                                             {{-- Stok : {{ $product->stock }} --}}

                                             1 Jam
                    
                                            </span>
                                           
                    
                                        </div>
                                    </div>
                                </div>
                    
                    
                    
                    
                    
                                

                            </a>
                            @else
                            <a data-toggle="modal" data-target="#exampleModal" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image" style="
                                                 @if ($product->galleries->count())
                                                    background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                                                 @else
                                                    background-image: url('{{ Storage::url('/assets/product/no-photo.png') }}')
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
                                    Lokasi : {{ $product->user->villages->name }}
                                </span>
                    
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:#29a867; ">
                                                Arena : {{ $product->user->store_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
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


                                <div class="row">
                                    <div class="col-8">
                                        <div class="d-flex justify-content-start">
                                            <div class="products-price">
                                    <span class="text-dark">RP.</span> {{ number_format($product->price) }}
                                </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            
                                            <span style="font-size:13px; color:#29a867; ">
                                             {{-- Stok : {{ $product->stock }} --}}
                                             1 Jam
                    
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
                                            <h5 class="modal-title" id="exampleModalLabel">Informasi Produk</h5>
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
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Data Tidak Di Temukan
                          </div>
                        @endforelse
                    </div>

        </div>
      </section>

    </div>

  </div>

@endsection