@extends('layouts.app')

@section('title')
Desaku
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
                        <div class="p-2 bd-highlight"><img src="/images/ceklis.svg" alt=""></div>
                        <div class="p-1 bd-highlight">
                            <h2> Official store</h2>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


 {{-- @php
    $sumber = 'http://desaku.test/api/productterlaris';
    $konten = file_get_contents($sumber);
    $datas = json_decode($konten, true);
    var_dump($datas);

   
  @endphp


    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
   @foreach ($datas['transaction'] as $row)
    <tr>
      <td scope="row">{{ $row['name'] }}</td>
      <td scope="row">{{ $row['name'] }}</td>
      <td scope="row">{{ $row['price'] }}</td>
      <td scope="row">{{ $row['jumlah_terjual'] }}</td>
      
            @foreach ($datas['datafoto'] as $kamu)
                @if($kamu['products_id'] == $row['products_id']){
                    <td>{{ $kamu['photos'] }}</td>
                @else{

                }
            @endforeach
      </tr>
      @endforeach



    


    
  </tbody>
</table> --}}







     {{-- <section class="store-name">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-5 text-center mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Desa</th>
                        <th scope="col">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                     @php
                        $no =0;
                        $test =1;
                     @endphp
                    @foreach ($occurences as $x => $val )
                            @php
                                $no++;
                                $datadesa = App\Models\Village::find($x)
                            @endphp
                        <tr>
                            <td>{{ $datadesa->name }}</td>
                            <td><img src="/images/bintang{{ $test++ }}.png" alt=""></td>
                        </tr>
                        
                        @if ($no == 5)
                            @break
                        @endif
                    @endforeach
                        

                       
                    </tbody>
                    </table>
                    <a href="/rank" class="btn btn-success"> Cek Detail</a>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Store Trend Categori -->
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    {{-- <h5>Kategori</h5> --}}
                </div>
            </div>
            <div class="row justify-content-center">

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
    <section class="store-new-products">
        <div class="container-fluid p-5">
        <div class="row">
                 <div class="col-3">
                    <div class="row justify-content-center">
                     <div class="card mt-5" style="width: 290px;">
                            <div class="pl-4 pt-4" style=" font-size: 15px; font-weight: bold; background-color:white; color:black;">
                               PRODUK TERLARIS
                                <div class="row">
                                    <div class="col-3">
                                        <hr style="padding-left: 0px; border-top: 3px solid #358f66; width:50px;">
                                    </div>
                                </div>
                            </div>

                            @foreach ($produkterlaris as $data)
                                @php
                                    $product = App\Product::find($data->id_produk)
                                @endphp
                            <div class="row pl-4 pb-3">
                                <div class="col-4">
                                 @if ($product->galleries->count())
                                 <img src="{{ Storage::url($product->galleries->first()->photos) }}" alt="" style="height: 60px;">
                                
                                 @else
                                 <img src="/images/no-photo.png" alt="" style="height: 60px;">
                               
                                 @endif
                                   
                                </div>
                                <div class="col-8 mb-0">
                                    <a href="{{ route('detail', $product->slug) }}" class="text-decoration-none" > 
                                    <h6 class="pl-3 mb-0" style="font-size: 14px; color: black;">{{ $product->name }}</h6>
                                    <span class="pl-3" style="font-size: 10px; color: #ff7158;"> RP. {{ number_format($product->price, 0, ',', '.')  }}  <span style="color: cadetblue;">Terjual ({{ $data->jumlah_terjual }}x) </span>  </span>
                                    <br>
                                    <span class="pl-3" style="font-size: small; color: black;"> {{ $product->user->villages->name }} </span>
                                    </a>      
                                </div>   
                            </div>
                            @endforeach

                            

                           
                        </div>
                        {{-- <div class="card mt-5" style="width: 290px;">
                            @php
                            $infrastruktur = 'https://desaku-desatour.masuk.id/api/infrastruktur';
                                $konteninfrastruktur = @file_get_contents($infrastruktur);
                                if($konteninfrastruktur === FALSE){
                                   
                                    $datainfrastruktur =[];
                                }else{
                                        $datainfrastruktur = json_decode($konteninfrastruktur, true);
                                }
                        
                            @endphp
                            <div class="pl-4 pt-4" style=" font-size: 15px; font-weight: bold; background-color:white; color:black;">
                                INFRASTRUKTUR DESA
                                <div class="row">
                                    <div class="col-3">
                                        <hr style="padding-left: 0px; border-top: 3px solid #358f66; width:50px;">
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                @php
                                $no = 1;
                                @endphp
                                @foreach($datainfrastruktur['data'] as $row)
                                @php
                                $no++;
                                @endphp
                                <li class="list-group-item">
                                    <img src="{{ $row['foto'] }}"
                                        style="width: 100%; height: 75px; object-fit: cover;" alt="">
                                    <a href="" target="_blank"
                                        class="text-decoration-none text-dark" style="font-weight: bolder; font-size: 14px;">{{ $row['nama'] }}</a>
                                    <br>
                                    <div class="row">
                        
                                        <div class="col">
                                            <span  style="font-size:12px;">
                                                {{ $row['desa'] }} <span style="background-color:#358f66; color: white;">{{ $row['Status'] }}</span>
                                            </span>
                                        </div>
                                      
                                    </div>
                                </li>
                                @if ($no == 5)
                                @break
                                @endif
                                @endforeach
                        
                        
                            </ul>
                        </div> --}}
                   </div>

                  
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12" data-aos="fade-up">
                            <h5>Produk Terbaru</h5>
                    
                            {{-- @php
                            $kamu = '3204270006';
                    
                            $sumber = 'http://desaku.id/api/productvillage/'.+$kamu;
                            $konten = file_get_contents($sumber);
                            $data = json_decode($konten, true);
                            @endphp
                    
                            @foreach ($data as $aku)
                            {{ $aku['name'] }}
                            @endforeach --}}
                        </div>
                    </div>
                    <div class="row">
                        @php
                        $incrementProduct = 0
                        @endphp
                        @forelse ( $products as $product)
                        <div class="col-6 col-md-4 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $incrementProduct+=100 }}">
                            @if($product->stock >= 1)
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
                                <span style="font-size:15px; color:#050505; ">
                                    Desa : {{ $product->user->villages->name }}
                                </span>
                    
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:#29a867; ">
                                                Store : {{ $product->user->store_name }}
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
                                    <span class="text-dark">RP.</span> {{ number_format($product->price) }}
                                </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="d-flex justify-content-end">
                                            
                                            <span style="font-size:13px; color:#29a867; ">
                                             Stok : {{ $product->stock }}
                    
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
                                    Desa : {{ $product->user->villages->name }}
                                </span>
                    
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex justify-content-start">
                                            <span style="font-size:13px; color:#29a867; ">
                                                Store : {{ $product->user->store_name }}
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
                                             Stok : {{ $product->stock }}
                    
                                            </span>
                                           
                    
                                        </div>
                                    </div>
                                </div>
                    
                            </a>
                                
                            @endif
                        </div>
                    
                        @empty
                    
                        @endforelse
                    </div>
                </div>


                {{-- Produk Kosong --}}
                <!-- Button trigger modal -->


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
        <h3> Mohon Maaf Untuk Sekarang Produk Tidak Tersedia </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
               
                <div class="col-3 ">
                   <div class="row justify-content-center">
                       
                        <div class="card mt-5" style="width: 290px;">
                            {{-- @php
                            $sumberberita = 'https://desaku-desanews.masuk.id/api/berita/';
                            $kontenberita = @file_get_contents($sumberberita);
                            if($kontenberita === FALSE){
                            
                            $databerita =[];
                            }else{
                            $databerita = json_decode($kontenberita, true);
                            }
                        
                            @endphp --}}
                            <div class="pl-4 pt-4" style=" font-size: 15px; font-weight: bold; background-color:white; color:black;">
                                RANGKING DESA
                                <div class="row">
                                    <div class="col-3">
                                        <hr style="padding-left: 0px; border-top: 3px solid #358f66; width:50px;">
                                    </div>
                                </div>
                            </div>
                            {{-- <ul class="list-group list-group-flush">
                                @php
                                $no = 1;
                                @endphp
                                @foreach($databerita as $row)
                                @php
                                $no++;
                                @endphp
                                <li class="list-group-item">
                                    <img src="https://desaku-desanews.masuk.id/{{ $row['gambar'] }}"
                                        style="width: 100%; height: 75px; object-fit: cover;" alt="">
                                    <a href="https://desaku-desanews.masuk.id/berita/{{ $row['id'] }}/{{ $row['slug'] }}" target="_blank"
                                        class="text-decoration-none text-dark" style="font-weight: bolder; font-size: 14px;">{{ $row['judul'] }}</a>
                                    <br>
                                    <div class="row">
                        
                                        <div class="col">
                                            <span  style="font-size:12px;">
                                                {{ $row['kelurahans'] }} -  {{ \Carbon\Carbon::parse($row['created_at'])->format('D m Y') }}
                                            </span>
                                        </div>
                                       
                                    </div>
                                </li>
                                @if ($no == 5)
                                @break
                                @endif
                                @endforeach
                        
                        
                            </ul> --}}

                                <div class="col-5 text-center mt-2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th scope="col">Desa</th>
                                            <th scope="col">Ranking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $no =0;
                                            $test =1;
                                        @endphp
                                        @foreach ($occurences as $x => $val )
                                                @php
                                                    $no++;
                                                    $datadesa = App\Models\Village::find($x)
                                                @endphp
                                            <tr>
                                                <td>{{ $datadesa->name }}</td>
                                                <td><img src="/images/bintang{{ $test++ }}.png" alt=""></td>
                                            </tr>
                                            
                                            @if ($no == 5)
                                                @break
                                            @endif
                                        @endforeach
                                            

                                        
                                        </tbody>
                                        </table>
                                        
                                        

                                    </div>
                                    <div class="row mb-2 text-center justify-content-center">
                                         <a href="/rank" class="btn btn-success"> Cek Detail</a>
                                    </div>
                                </div>
                            
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Store new Produk -->
    {{-- <section class="store-new-products mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Poduk Terlaris</h5>
                </div>
            </div>
            <div class="row">
                @foreach ($produkterlaris as $data)
                    @php
                        $product = App\Product::find($data->id_produk)
                    @endphp
                 <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
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
                            <span class="text-dark">RP.</span> {{ number_format($product->price, 0, ',', '.')  }}
                            <p class="text-success w-15"> ( <span> {{ $data->jumlah_terjual }} </span>) Produk Terjual  </p>
                        </div>
                    </a>
                </div>
                
                @endforeach
                
               
               
            </div>
        </div>
    </section> --}}
</div>

@endsection

