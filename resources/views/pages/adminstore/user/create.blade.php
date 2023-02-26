@extends('layouts.adminstore')

@section('title')
User
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                User
            </h2>
            <p class="dashboard-subtitle">
                Create New User
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                        {{ $message }}
                        </div>
	                  @endif
                        <div class="card-body">
                            <form action="{{ route('adddata') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama User</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No Telpon</label>
                                            <input type="text" name="phone_number" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama toko</label>
                                            <input type="text" name="store_name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password User</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
   <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
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