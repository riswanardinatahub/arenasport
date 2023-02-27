@extends('layouts.app')

@section('title')
Arena Cart Page
@endsection

@section('content')
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
             @if ($message = Session::get('success'))
                        <div class="alert alert-danger" role="alert">
                        {{ $message }}
                        </div>
	                @endif
                <div class="col-12 table-responsive">
                    <table class="table table-borderless table-cart">
                        <thead>
                            <tr>
                                <td>Foto</td>
                                <td>Arena &amp; Toko</td>
                                <td>Harga</td>
                                <td>Tanggal</td>
                                <td>Waktu</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $totalPrice = 0
                            @endphp
                            @forelse ($carts as $cart )
                            <tr>
                                <td style="width: 20%;">
                                    @if ($cart->product->galleries->count())
                                    <img src="{{ Storage::url($cart->product->galleries->first()->photos) }}" alt=""
                                        class="cart-image ">

                                    @else

                                    @endif
                                </td>
                                <td style="width: 20%;">
                                    <div class="product-title">{{ $cart->product->name }}</div>
                                    <div class="product-subtitle">{{ $cart->product->user->store_name }}</div>
                                </td>
                                <td style="width: 20%;">
                                    <div class="product-title"> {{ number_format($cart->product->price ) }}</div>
                                    <div class="product-subtitle">Rupiah</div>
                                </td>
                                <td style="width: 20%;">
                                    <div class="product-title"> {{ $cart->book_date }}</div>
                                    
                                </td>
                                <td style="width: 20%;">
                                    <div class="product-title">{{ $cart->book_time }}</div>
                                    
                                </td>
                                {{-- <td style="width: 20%;">
                                    <div class="row mt-3 pt-1">
                                        <div class="col-2">
                                            <a href="{{ route('kurangqty', $cart->id) }}" class="btn btn-danger btn-sm">-</a>
                                        </div>
                                        <div class="ml-2 col-2">
                                            {{ $cart->qty }}
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('tambahqty', $cart->id) }}" class="btn btn-success btn-sm">+</a>
                                        </div>
                                    </div>
                                </td> --}}
                                <td style="width: 25%;">
                                    <form action="{{ route('cart-delete',$cart->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-remove-cart btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                            $totalPrice += $cart->qty * $cart->product->price
                            
                            
                            @endphp

                            @php
                                $totalqty = $cart->qty 
                            @endphp
                            @empty
                            Data Kosong

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="row" data-aos="fade-up" data-aos-delay="150">
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h2 class="mb-4"> Lokasi COD</h2>
                </div>
            </div> --}}


            <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden"  name="total_price" value={{ $totalPrice }}>
                @if ($totalqty)
                    <input type="hidden"  name="total_qty" value={{ $totalqty }}>
                @else
                    
                @endif
            
            
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_one">Detail Lokasi 1</label>
                            <input type="text" class="form-control" id="address_one" name="address_one"
                              >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_two">Detail Lokasi 2</label>
                            <input type="text" class="form-control" id="address_two" name="address_two"
                              >
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinces_id">Provinsi</label>
                            <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="regencies_id">Kota</label>
                             <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                            </select>

                            <select v-else class="form-control"></select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Postal Code</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" >
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="Indonesia">Indonesia</option>
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">No Telpon</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ Auth::user()->phone_number }}">
                        </div>
                    </div> --}}

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h2 class="mb-1"> Informasi Biaya </h2>
                    </div>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="200">
                    {{-- <div class="col-4 col-md-2">
                        <div class="product-title">$10</div>
                        <div class="product-subtitle">Country Tax</div>
                    </div>
                    <div class="col-4 col-md-3">
                        <div class="product-title">$230</div>
                        <div class="product-subtitle">Product Insurance</div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="product-title">$1500</div>
                        <div class="product-subtitle">Ship to jakarta</div>
                    </div> --}}
                    <div class="col-4 col-md-2">
                        <div class="product-title text-success"> RP. {{ number_format($totalPrice ?? 0) }}</div>
                        <div class="product-subtitle">Total</div>
                    </div>
                    <div class="col-8 col-md-3">
                        <button type="submit" class="btn btn-success mt-4 px-4 btn-block"> Checkout Now</button>
                    </div>
                </div>
            </form>

        </div>
    </section>

</div>
@endsection


@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var locations = new Vue({
    el: "#locations",
    mounted() {
       AOS.init();
      this.getProvincesData();
    },
    data: {
      provinces: null,
      regencies: null,
      provinces_id: null,
      regencies_id: null,
    },
    methods: {
      getProvincesData(){ 
        var self = this;
        axios.get('{{ route('api-provinces') }}')
        .then(function(response){
            self.provinces = response.data;
        })
      },

      getRegenciesData(){
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
        .then(function(response){
            self.regencies = response.data;
        })
      },

    },
    watch:{
        provinces_id: function(val, oldVal){
            this.regencies_id = null;
            this.getRegenciesData();
        }
    }
  });

</script>
@endpush