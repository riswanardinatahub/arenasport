@extends('layouts.admin')

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
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label>Password User</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="locations">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="provinces_id">Province</label>
                                                <select name="provinces_id" id="provinces_id" class="form-control"
                                                    v-if="provinces" v-model="provinces_id">
                                                    <option v-for="province in provinces" :value="province.id">@{{
                                                        province.name }}</option>
                                                </select>
                                                <select v-else class="form-control"></select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="regencies_id">Kabupaten</label>
                                            <select name="regencies_id" id="regencies_id" class="form-control"
                                                v-if="regencies" v-model="regencies_id">
                                                <option v-for="regency in regencies" :value="regency.id">@{{
                                                    regency.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>

                                        <div class="form-group">
                                            <label for="districts_id">Kecamatan/Kelurahan</label>
                                            <select name="districts_id" id="districts_id" class="form-control"
                                                v-if="districts" v-model="districts_id">
                                                <option v-for="district in districts" :value="district.id">@{{
                                                    district.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>

                                        <div class="form-group">
                                            <label for="villages_id">Desa</label>
                                            <select name="villages_id" id="villages_id" class="form-control"
                                                v-if="villages" v-model="villages_id">
                                                <option v-for="village in villages" :value="village.id">@{{ village.name
                                                    }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Roles</label>
                                            <select name="roles" required class="form-control">
                                                <option value="ADMIN">Admin</option>
                                                <option value="USER">User</option>
                                                <option value="ADMINSTORE">Admin Store</option>
                                            </select>
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