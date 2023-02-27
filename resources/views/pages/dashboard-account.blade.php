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
                      <label for="email">Email</label>
                      <input disabled type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
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
                      <label for="images">Upload Foto</label>
                      <input type="file" class="form-control" id="images" name="images">
                    </div>

                    <img src="{{ Storage::url($user->images) }}" alt="" height="100" class="mr-2">

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address_one">Alamat Lengkap</label>
                      <input type="text" class="form-control" id="address_one" name="address_one" value="{{ $user->address_one }}">
                    </div>
                  </div>

                  <div class="col-md-12 pt-3">
                    <div class="form-group">
                      <label for="address_two">Lokasi Maps (Latitude,Longitude)</label>
                      <textarea class="form-control" name="address_two" id="" cols="30" rows="3">{{ $user->address_two }}</textarea>
                    </div>
                  </div>

                  <div class="col-md-12 pt-3">
                    <div class="form-group">
                      <label for="address_two">Tutorial </label>
                      <img src="/images/tutorialmaps.jpg" class="img-fluid" alt="">
                    </div>
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