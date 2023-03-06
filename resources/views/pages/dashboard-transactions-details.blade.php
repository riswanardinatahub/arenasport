@extends('layouts.dashboard')

@section('title')
Dashboard Transactions Details Pages
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">

  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">
        {{ $transaction->code }}
      </h2>
      <p class="dashboard-subtitle">
        Transaksi Detail
      </p>
    </div>

    <!-- Button trigger modal -->
          <!-- Modal -->
          {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Silahkan Lakukan Pembayaran Sebesar : RP. {{ number_format($transaction->total_price) }}
                  <br>
                  Ke Rekening :
                  <br>
                  BCA : 3370968798 
                  <br>
                  atas nama al hilal julianda
              <form action="/dashboard/transactions/uploadbuktipembayaran/{{ $transaction->id }}" method="POST" enctype="multipart/form-data">
              @csrf
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Bukti Pembayaran</label>
                      <input class="form-control" name="invoice" type="file" id="formFile">
                    </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

              </div>
            </div>
          </div> --}}


          {{-- <div class="modal fade" id="buktipembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Bukti Pembayaran
              <br>
              <img src="{{ asset('invoice/'.$transaction->invoice) }}" style="width:200px;" alt="">


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  
                </div>
              

              </div>
            </div>
          </div> --}}

    <div class="dashboardcontent" id="transactionDetails">
      <div class="row">
      <div class="col-12 col-md-8">
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                        <h5 class="mb-3">Transaksi Detail </h5>
                         
                        </div>
                    </div>
                </div>


        <div class="col-12">
          <div class="card">
            <div class="card-body">
                    @foreach ($transactiondetails as $transaction)
                      <a href="#" class="card card-list d-block">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-1">
                              <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                class="w-75">
                            </div>
                            <div class="col-md-3">
                              {{ $transaction->product->name }}
                            </div>
                            <div class="col-md-3">
                              
                              RP. {{ number_format($transaction->price) }}
                            </div>
                            {{-- <div class="col-md-2">
                              {{ $transaction->total_qty }}
                            </div> --}}

                            <div class="col-md-2">
                              {{ date('d-m-Y', strtotime($transaction->book_date)) }} 
                            </div>

                            <div class="col-md-2">
                              {{ $transaction->book_time }}
                            </div>

                          </div>
                        </div>
                      </a>
                    @endforeach
             
            <form action="{{ route('dashboard-transaction-update',$transactionss->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-12 mt-4">
                    <span class="" style="font-size: 20px; color: black; font-weight:600;"> Informasi</span>
                  </div>
                  
                  <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              No Telpon 
                            </div>
                            <div class="product-subtitle ">
                              <div class="row">
                                <div class="col-12 col-md-9 col-lg-9 pr-md-0">
                             <input disabled  value="0{{ $transaction->transaction->user->phone_number }}" type="text" class="form-control" >

                                </div>
                                <div class="col-12 col-md-3 col-lg-3 pl-md-1">
                              <a target="_blank"
                                href="https://api.whatsapp.com/send?text=Terimakasih Terimakasih Telah Melakukan pemesanan {{ $transaction->product->name }} dengan kode booking {{ $transactionss->code }} total biaya {{ $transactionss->total_price }} &phone=62{{ $transaction->transaction->user->phone_number }}"
                                type="button" class="btn btn-success d-block ">Whatsapp</a>
                                </div>
                              </div>
                              
                               
                            </div>

                    </div>

                    <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              Tanggal Transaksi
                            </div>
                            <div class="product-subtitle">
                             <input disabled  value="{{ $transactionss->created_at->format('d-m-Y') }}" type="text" class="form-control" >

                            </div>
                          </div>
                          

                          <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              Total Pesanan
                            </div>
                            <div class="product-subtitle ">
                             <input disabled  value="{{ $jumlahproduk}}" type="text" class="form-control" >

                              
                            </div>
                          </div>
                          <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              Total Biaya
                            </div>
                            <div class="product-subtitle ">
                             <input disabled  value="RP. {{ number_format($transactionss->total_price) }}" type="text" class="form-control" >

                              

                            </div>
                          </div>


            

                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-3">
                        <div class="product-title">
                          Status Pengiriman
                        </div>
                        <select name="transaction_status" id="status" class="form-control" v-model=status>
                          <option value="PENDING">Belum Bayar</option>
                          <option value="DP">DP</option>
                          <option value="SUCCESS">Lunas</option>
                        </select>
                      </div>
                 
                    </div>
                  </div>
                </div>

            
                <div class="row text-right">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success  mt-4">Simpan Perubahan</button>
                    <a href="{{ route('downoadpdf',$transactionss->id) }}" class="btn btn-warning  mt-4">Cetak Invoice</a>
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
<script>
  var transactionDetails = new Vue({
    el: '#transactionDetails',
    data: {
      status: "{{ $transaction->transaction->transaction_status }}",
      resi: "{{ $transaction->resi }}",
    },
  });
</script>
@endpush