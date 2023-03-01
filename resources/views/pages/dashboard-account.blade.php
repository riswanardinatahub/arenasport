@extends('layouts.dashboard')

@section('title')
Store Dashboard Account
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
        Akun
      </h2>
      <p class="dashboard-subtitle">
        Silahkan Update Akunmu
      </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('dashboard-settings-redirect','dashboard-settings-account' ) }}" method="POST"
            enctype="multipart/form-data" id="locations">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row mb-2 pt-3" data-aos="fade-up" data-aos-delay="200">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                  </div>

                   <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Nama Arena</label>
                      <input type="text" name="store_name" class="form-control" value="{{ $user->store_name }}">
                    </div>
                  </div>
                  
                  {{-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_one">Lokasi 1</label>
                      <input type="text" class="form-control" id="address_one" name="address_one"
                        value="{{ $user->address_one }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_two">Lokasi 2</label>
                      <input type="text" class="form-control" id="address_two" name="address_two"
                        value="{{ $user->address_two }}">
                    </div>
                  </div> --}}
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="provinces_id">Provinsi</label>
                      <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces"
                        v-model="provinces_id">
                        {{-- <option selected >{{ $provinces->name }}</option> --}}
                        <option v-for="province in provinces" :value="province.id" >@{{ province.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>
                  </div>

                  

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="regencies_id">Kota</label>
                      <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies"
                        v-model="regencies_id">
                        {{-- <option selected >{{ $regencies->name }}</option> --}}
                        <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                      </select>

                      <select v-else class="form-control"></select>
                    </div>
                  </div>

                  {{-- <div class="col-md-4">
                    <div class="form-group">
                      <label for="zip_code">Postal Code</label>
                      <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $user->zip_code }}">
                    </div>
                  </div> --}}


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="country">Negara</label>
                      <select name="country" id="country" class="form-control">
                        <option value="{{ $user->country }}">Indonesia</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone_number">No Telpon</label>
                      <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    </div>
                  </div>



                  

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_one">Alamat Lengkap</label>
                  <textarea class="form-control" name="address_one" id="address_one" cols="10" rows="3">{{ $user->address_one }}</textarea>

                    </div>
                  </div>

                 

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input disabled type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Kategori ( @if(Auth::user()->categories_id)
                        {{ Auth::user()->category->name }}
                      @else
                        Pilih Kategori
                      @endif)
                      </label>
                      <select name="categories_id" id="" class="form-control">
                        <option value="{{ $user->categories_id }}">Tidak Di Ganti </option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                 
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_two">Lokasi Maps (Latitude,Longitude)</label>
                      <input type="text" class="form-control" id="address_two" name="address_two" value="{{ $user->address_two }}">
                    </div>
                  </div>
                        
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Arena</label>
                      <p class="text-muted">Apakah Saat Ini Arena Anda Buka?</p>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="store_status" id="openStoreTrue"
                          value="1" {{ $user->store_status == 1 ? 'checked' : '' }}>
                        <label for="openStoreTrue" class="custom-control-label">Buka</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="store_status"
                          id="openStoreFalse" value="0" {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}>
                        <label for="openStoreFalse" class="custom-control-label">Sementara Tutup</label>
                      </div>
                      <br>
                      <label class="mt-3" for="address_two">Tutorial </label>

                      <img src="/images/tutorialmaps.jpg" class="img-fluid" alt="">

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="images">Upload Foto Profil</label>
                      <input type="file" class="form-control" id="images" name="images">
                    </div>

                    <img src="{{ Storage::url($user->images) }}" alt="" height="100" class="mr-2">


                    <div class="form-group mt-3">
                      <label for="arena_photos">Upload Foto Arena</label>
                      <input type="file" class="form-control" id="arena_photos" name="arena_photos">
                    </div>


                    <img src="{{ Storage::url($user->arena_photos) }}" alt="" height="100" class="mr-2">

                  </div>

                 
               

                  

                   

                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5 mt-3">
                      Simpan Perubahan
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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
      this.getRegenciesDataAll();
      
    },
    data: {
      provinces: null,
      regencies: null,
      provinces_id: {{ $provinces->id }},
      regencies_id: {{ $regencies->id }},
    },
    methods: {
      getProvincesData(){ 
        var self = this;
        axios.get('{{ route('api-provinces') }}')
        .then(function(response){
            self.provinces = response.data;
        })
      },

      getRegenciesDataAll(){ 
        var self = this;
        axios.get('{{ url('api/regencies') }}/')
        .then(function(response){
            self.regencies = response.data;
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
            this.regencies_id = regencies_id;
            this.getRegenciesData();
        }
    }
  });

</script>
@endpush