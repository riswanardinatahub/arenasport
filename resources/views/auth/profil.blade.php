@extends('layouts.auth')

@section('content')
<div class="page-content page-auth" >
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login ">
                 

          <div class="col-12 col-lg-8">
            <h3 class="fw-bolder"><p class="fw-bolder">Profil</p></h3>
            @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                        {{ $message }}
                        </div>
	                  @endif
            
            <form class="mt-3" method="POST" action="{{ route('profilupdate') }}" enctype="multipart/form-data" >
               @csrf
              <div class="row">
                <div class="col-lg-12" id="register">
                      <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="">No Telpon</label>
                        <input id="phone_number"  type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                          value="{{ $user->phone_number }}" required autocomplete="phone_number" autofocus>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Email</label>
                        <input disabled type="email" name="email" value="{{ $user->email }}" @change="checkForEmail()" class="form-control  @error('email') is-invalid @enderror"
                          />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>


                      <div class="form-group">
                        <label for="images">Upload Foto</label>
                        <input type="file" class="form-control" id="images" name="images">
                      </div>

                      @if ($user->images)
                      <img src="{{ Storage::url($user->images) }}" alt="" height="100" class="mr-2">
                        
                      @else
                        
                      @endif





                      



                      
                      
                       <button type="submit" :disabled="this.email_unavailable" class="btn btn-success btn-block mt-4">
                         Simpan Perubahan
                        </button>

                      <div class="form-group d-none">
                        <label for="">Toko</label>
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
                      
                      <div class="form-group d-none" v-if="is_store_open">
                        <label for="">Nama Toko</label>
                        <input type="text" v-model="store_name" id="store_name" class="form-control @error('store_name') is-invalid @enderror"
                          name="store_name" required autocomplete autofocus>
                        @error('store_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      
                     
                </div>
                
                <div class="col-lg-6" id="locations">
                    {{-- <div class="form-group">
                      <div class="form-group">
                        <label for="provinces_id">Provinsi</label>
                        <select disabled name="provinces_id" id="provinces_id" class="form-control">
                          <option value="" selected >{{ $provinces->name }}</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="regencies_id">Kabupaten</label>
                      <select disabled name="regencies_id" id="regencies_id" class="form-control">
                        <option >{{ $regencies->name }}</option>
                      </select>
                     
                    </div> --}}

                    {{-- <div class="form-group">
                      <label for="districts_id">Kecamatan/Kelurahan</label>
                      <select disabled name="districts_id" id="districts_id" class="form-control" >
                        <option>{{ $distric->name }}</option>
                      </select>
                      
                    </div> --}}

                    {{-- <div class="form-group">
                      <label for="villages_id">Desa</label>
                      <select name="villages_id" id="villages_id" class="form-control" v-if="villages"
                        v-model="villages_id">
                        <option v-for="village in villages" :value="village.id">@{{ village.name }}</option>
                      </select>
                      <select v-else class="form-control"></select>
                    </div> --}}
           
                </div>
                
             
              </div>

              
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>





@endsection
<style>
.toasting {
  color: white !important;
  background-color: green !important;
}
</style>

@push('addon-script')
   <script src="/vendor/vue/vue.js"></script>
   <script src="/vendor/axios/dist/axios.min.js"></script>
   <script src="https://unpkg.com/vue-toasted"></script>
   {{-- <script src="/vendor/vuetoadted/vue-toasted.min.js"></script> --}}
  {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
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
                          className: ["success","rounded"],
                          position: "top-center",
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
            is_store_open: false,
            store_name: "",
            email_unavailable:false
          }
        },
    });
  </script>

 
 
@endpush
