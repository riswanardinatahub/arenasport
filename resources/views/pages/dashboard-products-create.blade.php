@extends('layouts.dashboard')

@section('title')
Dashboard Lapangan Details Pages
@endsection

@section('content')
 <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">
                Tambah Lapangan
              </h2>
              <p class="dashboard-subtitle">
                Ayok Tambahkan Lapangan Kamu
              </p>
            </div>
            <div class="dashboard-content">
              <div class="row">
                <div class="col-12">
                 @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Nama Lapangan</label>
                              <input type="text" class="form-control" name="name" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Harga</label>
                              <input type="number" class="form-control" name="price" required>
                            </div>
                          </div>
                          {{-- <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Stok</label>
                              <input type="number" class="form-control" name="stock">
                            </div>
                          </div> --}}
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Kategori Lapangan</label>
                                <select name="categories_id" class="form-control" required>
                                      @foreach ( $categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Deskirpsi</label>
                              <textarea name="description" id="editor" required></textarea>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Thumbnails</label>
                              <input type="file" class="form-control" name="photo" required>
                              <p class="text-muted">
                                kamu dapat memilih lebih dari satu file
                              </p>
                            </div>
                          </div>





                        </div>
                        <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                              <label for="">Pilih Jadwal Yang Ingin Di Buka</label> <br>
                              <table class="table table-borderless table-responsive">
                                        <thead>
                                          
                                        </thead>
                                        <tbody>
                                          <tr>
                                            {{-- <input type="hidden" name="param" value="0">
                                            <input type="checkbox" name="param" value="1"> --}}
                                            <div class="row">

                                           
                                            <div class="col-2">
                                                <input type="hidden" name="time1" value="no"> 
                                                <input type="checkbox" name="time1" value="yes"> <label>00.00 - 01.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time2" value="no"> 
                                                <input type="checkbox" name="time2" value="yes"> <label>01.00 - 02.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time3" value="no"> 
                                                <input type="checkbox" name="time3" value="yes"> <label>02.00 - 03.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time4" value="no"> 
                                                <input type="checkbox" name="time4" value="yes"> <label>03.00 - 04.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time5" value="no"> 
                                                <input type="checkbox" name="time5" value="yes"> <label>04.00 - 05.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time6" value="no"> 
                                                <input type="checkbox" name="time6" value="yes"> <label>05.00 - 06.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time7" value="no"> 
                                                <input type="checkbox" name="time7" value="yes"> <label>06.00 - 07.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time8" value="no"> 
                                                <input type="checkbox" name="time8" value="yes"> <label>07.00 - 08.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time9" value="no"> 
                                                <input type="checkbox" name="time9" value="yes"> <label>08.00 - 09.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time10" value="no"> 
                                                <input type="checkbox" name="time10" value="yes"> <label>09.00 - 10.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time11" value="no"> 
                                                <input type="checkbox" name="time11" value="yes"> <label>10.00 - 11.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time12" value="no"> 
                                                <input type="checkbox" name="time12" value="yes"> <label>11.00 - 12.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time13" value="no"> 
                                                <input type="checkbox" name="time13" value="yes"> <label>12.00 - 13.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time14" value="no"> 
                                                <input type="checkbox" name="time14" value="yes"> <label>13.00 - 14.00</label>
                                            </div><div class="col-2">
                                                <input type="hidden" name="time15" value="no"> 
                                                <input type="checkbox" name="time15" value="yes"> <label>14.00 - 15.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time16" value="no"> 
                                                <input type="checkbox" name="time16" value="yes"> <label>15.00 - 16.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time17" value="no"> 
                                                <input type="checkbox" name="time17" value="yes"> <label>16.00 - 17.00</label>
                                            </div><div class="col-2">
                                                <input type="hidden" name="time18" value="no"> 
                                                <input type="checkbox" name="time18" value="yes"> <label>17.00 - 18.00</label>
                                            </div><div class="col-2">
                                                <input type="hidden" name="time19" value="no"> 
                                                <input type="checkbox" name="time19" value="yes"> <label>18.00 - 19.00</label>
                                            </div><div class="col-2">
                                                <input type="hidden" name="time20" value="no"> 
                                                <input type="checkbox" name="time20" value="yes"> <label>19.00 - 20.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time21" value="no"> 
                                                <input type="checkbox" name="time21" value="yes"> <label>20.00 - 21.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time22" value="no"> 
                                                <input type="checkbox" name="time22" value="yes"> <label>21.00 - 22.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time23" value="no"> 
                                                <input type="checkbox" name="time23" value="yes"> <label>22.00 - 23.00</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="hidden" name="time24" value="no"> 
                                                <input type="checkbox" name="time24" value="yes"> <label>23.00 - 24.00</label>
                                            </div>
                                          

                                              
                                             
                                            </div>

                                          </tr>
                                         
                                          
                                        </tbody>
                              </table>

                             
                                
                          

                            </div>
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" class="btn btn-success px-5 mt-3">
                              Simpan
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
   {{-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> --}}
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script>
   CKEDITOR.replace('editor');
   CKEDITOR.config.extraPlugins = 'youtube,justify';
  </script>
@endpush