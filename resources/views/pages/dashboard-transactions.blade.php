@extends('layouts.dashboard')

@section('title')
Dashboard Transactions Pages
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
               Transaksi
            </h2>
            <p class="dashboard-subtitle">
               List Transaksi
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                           
        <div class="table-responsive">
                    <table id="exampless" class="table table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Kode Booking</th>
                          <th scope="col">Nama Pemesan</th>
                          <th scope="col">Total Biaya</th>
                          <th scope="col">Tanggal Transaksi</th>
                          <th scope="col">Status Transaksi</th>
                          <th scope="col">Total DP</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                        $no=1;
                      @endphp
                      @foreach ($transaction as $data)
                        <tr>
                          <th scope="row">{{ $no++ }}</th>
                          <td>{{ $data->code }}</td>
                          <td>{{ $data->user->name }}</td>
                          <td>Rp. {{ number_format($data->total_price,0,',','.') }}</td>
                          <td>{{ $data->created_at->format('d-m-Y') }}</td>
                          <td>
                            @if ($data->transaction_status == 'PENDING')
                            <span class="font-weight-bold"  style="color: red;">Belum Bayar</span> 
                            @elseif ($data->transaction_status == 'DP')
                            <span class="font-weight-bold" style="color: orange;">DP</span>
                            @else
                            <span class="font-weight-bold" style="color: green;">Lunas</span>
                              
                            @endif
                        
                          
                          </td>

                          <td>{{ $data->down_payment }}</td>

                          <td><a href="{{ route('dashboard-transaction-details', $data->id) }}" class="btn btn-sm btn-success">Detail</a></td>
                        </tr>
                      @endforeach
                        
                        
                      </tbody>
                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





 {{-- <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">
                Transaksi
              </h2>
              <p class="dashboard-subtitle">
                Perbanyak transaksi untuk toko mu
              </p>

            

            </div>
             <div class="dashboard-content">

              <div class="row">
                <div class="col-12 mt-2">

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Beli Produk</a>
                    </li>
                    
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                      aria-labelledby="pills-home-tab">
                    @foreach ( $transaction as $row)
                        <a href="{{ route('dashboard-transaction-details', $row->id) }}" class="card card-list d-block">
                        <div class="card-body">
                          <div class="row">
                          <div class="col-md-3">
                               Transaksi
                            </div>
                            <div class="col-md-4">
                              {{ $row->code }}
                            </div>
                            <div class="col-md-3">
                               {{ $row->transaction_status }}
                            </div>
                            
                            <div class="col-md-1 d-none d-md-block">
                              <img src="/images/dashboard-arrow-right.svg" alt="">
                            </div>
                          </div>
                        </div>
                      </a>
                     @endforeach
                     
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
                    </div>

                  </div>


                </div>
              </div>
            </div>
            <div class="dashboard-content">

              <div class="row">
                <div class="col-12 mt-2">

                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Jual Produk</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Beli Produk</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                      aria-labelledby="pills-home-tab">
                     @foreach ( $selltransaction as $sell)
                        <a href="{{ route('dashboard-transaction-details', $sell->id) }}" class="card card-list d-block">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-1">
                              <img src="{{ Storage::url($sell->product->galleries->first()->photos ??  '') }}" class="w-50">
                            </div>
                            <div class="col-md-4">
                              {{ $sell->product->name }}
                            </div>
                            <div class="col-md-3">
                               {{ $sell->product->user->store_name }}
                            </div>
                            <div class="col-md-3">
                               {{ $sell->created_at }}
                            </div>
                            <div class="col-md-1 d-none d-md-block">
                              <img src="/images/dashboard-arrow-right.svg" alt="">
                            </div>
                          </div>
                        </div>
                      </a>
                     @endforeach
                     
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                     @foreach ( $buytransaction as $sell)
                        <a href="{{ route('dashboard-transaction-details', $sell->id) }}" class="card card-list d-block">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-1">
                              <img src="{{ Storage::url($sell->product->galleries->first()->photos ??  '') }}" class="w-50">
                            </div>
                            <div class="col-md-4">
                              {{ $sell->product->name }}
                            </div>
                            <div class="col-md-3">
                               {{ $sell->product->user->store_name }}
                            </div>
                            <div class="col-md-3">
                               {{ $sell->created_at }}
                            </div>
                            <div class="col-md-1 d-none d-md-block">
                              <img src="/images/dashboard-arrow-right.svg" alt="">
                            </div>
                          </div>
                        </div>
                      </a>
                     @endforeach

                    </div>

                  </div>


                </div>
              </div>
            </div>
          </div>
  </div> --}}

@endsection