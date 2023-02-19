@extends('layouts.app')

@section('title')
Cari Store
@endsection

@section('content')

<div class="page-content page-home">

  <!-- Section Search -->
  <section class="search-store">
    <div class="container">
      <div class="row text">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-6">
                  <form action="/stores" class="mt-3" id="locations" method="GET">
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



                    <button type="submit" class="btn btn-success px-5 mt-2">
                      Search
                    </button>


                  </form>

                  {{-- /list-store.html --}}
                </div>
              </div>

              <div class="row mt-5">
                <div class="col-12 mt-2">
                  <h5 class="mb-3 text-center">List All Store</h5>

                  <div class="row justify-content-center mx-5 ">
                    <div class="col-8">
                      <table class="table table-bordered">
                        <thead class="border-0">
                          <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Store Name</th>
                            <th scope="col">Desa</th>
                            <th scope="col">Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if ($store)
                            @foreach ($store as $raw)
                            @if ($raw->store_name=='')
                              @else
                              <tr>
                                {{-- <th scope="row">{{ $raw->id }}</th> --}}
                                <td>{{ $raw->store_name }}</td>
                                <td>{{ $raw->villages->name }}</td>

                                <td>
                                  <a href="{{ route('store-page-detail', $raw->id) }}"
                                    class="btn btn-success btn-sm">Cek Toko</a>

                                    <a href="{{ route('store-page-area', $raw->villages_id) }}"
                                    class="btn btn-success btn-sm">Store Area</a>
                                </td>
                              </tr>
                            @endif
                          @endforeach
                            @else
                            {{-- Kondisi Data Kosong --}}
                          @endif
                        </tbody>
                      </table>

                    </div>

                  </div>

                </div>
              </div>

              {{-- <div class="row mt-4">
                <div class="col-12 text-center">
                  @foreach($store as $d)
                    @if($d->villages_id)
                  <a href="{{ route('store-page-area', $d->villages_id) }}"
                    class="btn btn-success btn-sm py-2 px-3">Go To Area Store</a>
                  @break
                  @endif
                  @endforeach
                </div>
              </div> --}}


            </div>
          </div>
        </div>
      </div>
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