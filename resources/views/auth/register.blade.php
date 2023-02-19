@extends('layouts.auth')

@section('content')
<div class="page-content page-auth" >
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login ">
          <div class="col-12 col-lg-8">
            <h2>Silahkan Daftarkan Diri Anda</h2>
            
            <form class="mt-3" method="POST" action="{{ route('register') }}">
               @csrf
              <div class="row">
                <div class="col-lg-6" id="register">
                      <div class="form-group">
                        <label for="">Full Name</label>
                        <input id="name" v-model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                          value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="">No Telpon</label>
                        <input id="phone_number" v-model="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                          value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" name="email" @change="checkForEmail()" class="form-control  @error('email') is-invalid @enderror"
                          :class="{ 'is-invalid' : this.email_unavailable }" aria-describedby="emailHelp" placeholder="Masukan Email"
                          v-model="email" autocomplete="email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                          required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password"
                          class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required
                          autocomplete="new-password">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                       <button type="submit" :disabled="this.email_unavailable" class="btn btn-success btn-block mt-4">
                  Sign Up Now
                </button>

              <a href="{{ route('login') }}" class="btn btn-signup btn-block  mt-2">
                Back To Sign In
              </a>
                      
                      <div class="form-group">
                        <label for="">Store</label>
                        <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue" v-model="is_store_open"
                            :value="true">
                          <label for="openStoreTrue" class="custom-control-label">Iya, Boleh</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse" v-model="is_store_open"
                            :value="false">
                          <label for="openStoreFalse" class="custom-control-label">Enggak, Makasih</label>
                        </div>
                      </div>
                      
                      <div class="form-group" v-if="is_store_open">
                        <label for="">Nama Toko</label>
                        <input type="text" v-model="store_name" id="store_name" class="form-control @error('store_name') is-invalid @enderror"
                          name="store_name" required autocomplete autofocus>
                        @error('store_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                      <div class="form-group" v-if="is_store_open">
                        <label for="">Kategori</label>
                        <select name="categories_id" id="" class="form-control">
                          <option value="" disabled>Select Category</option>
                          @foreach ($categories as $category )
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                </div>
                
                <div class="col-lg-6" id="locations">
                    <div class="form-group">
                      <div class="form-group">
                        <label for="provinces_id">Province</label>
                        <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                          <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                        </select>
                        <select v-else class="form-control"></select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="regencies_id">Kabupaten</label>
                      <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies"
                        v-model="regencies_id">
                        <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>

                    <div class="form-group">
                      <label for="districts_id">Kecamatan/Kelurahan</label>
                      <select name="districts_id" id="districts_id" class="form-control" v-if="districts"
                        v-model="districts_id">
                        <option v-for="district in districts" :value="district.id">@{{ district.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>

                    <div class="form-group">
                      <label for="villages_id">Desa</label>
                      <select name="villages_id" id="villages_id" class="form-control" v-if="villages"
                        v-model="villages_id">
                        <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div>
           
                </div>
                
              </div>

              
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>





{{-- <div class="container d-none">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection


@push('addon-script')
   <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    Vue.use(Toasted);
    var register = new Vue({
      el: '#register',
      mounted() {
        AOS.init();
       
      },
      methods:{
          checkForEmail: function(){
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
                params: {
                  email: self.email
                }
              })
              .then(function (response) {
                // Handle Success
                if(response.data == "Available"){
                      self.$toasted.show(
                        "Email Anda Tersedia,Silahkan lanjutkan langkah pendaftaran.",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 5000,
                        }
                      );
                      self.email_unavailable = false ;
                }else{
                      
                      self.$toasted.error(
                        "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 5000,
                        }
                      );
                      self.email_unavailable = true;
                }
                console.log(response);
              })
              
          }
        },
      data() {
          return{
            name: "",
            email: "",
            is_store_open: true,
            store_name: "",
            email_unavailable:false
          }
        },
    });
  </script>

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
      districts: null,
      villages: null,
      provinces_id: null,
      regencies_id: null,
      districts_id: null,
      villages_id: null,
    },
    methods: {
      getProvincesData() {
        var self = this;
        axios.get('{{ route('api-provinces') }}')
          .then(function (response) {
            self.provinces = response.data;
          })
      },

      getRegenciesData() {
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
          .then(function (response) {
            self.regencies = response.data;
          })
      },

      getDistrictsData() {
        var self = this;
        axios.get('{{ url('api/districts') }}/' + self.regencies_id)
          .then(function (response) {
            self.districts = response.data;
          })
      },

      getVillagesData() {
        var self = this;
        axios.get('{{ url('api/villages') }}/' + self.districts_id)
          .then(function (response) {
            self.villages = response.data;
          })
      },

    },
    watch: {
      provinces_id: function (val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      },

      regencies_id: function (val, oldVal) {
        this.districts_id = null;
        this.getDistrictsData();
      },

      districts_id: function (val, oldVal) {
        this.villages_id = null;
        this.getVillagesData();
      }
    }
  });

</script>
 
@endpush
