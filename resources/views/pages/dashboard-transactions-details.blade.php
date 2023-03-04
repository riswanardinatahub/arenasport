@extends('layouts.dashboard')

@section('title')
Store Dashboard Transactions Details Pages
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
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true">
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
          </div>


          <div class="modal fade" id="buktipembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true">
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
          </div>






          


    <div class="dashboardcontent" id="transactionDetails">



      <div class="row">
      <div class="col-12 col-md-8">
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                        <h5 class="mb-3">Detail Transaction</h5>
                         
                        </div>
                    </div>
                </div>


        <div class="col-12">
          <div class="card">
            <div class="card-body">
              @foreach ($transactiondetails as $transaction)
                            <a href="#"
                                class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                                                class="w-75">
                                        </div>
                                        <div class="col-md-4">
                                            {{ $transaction->product->name }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $transaction->price }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $transaction->total_qty }}
                                        </div>
                                        
                                    </div>
                                </div>
                            </a>
                         @endforeach










             
              <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-12 mt-4">
                    <h5>Informasi</h5>
                  </div>
                  @if (Auth::user()->id == $transaction->product->users_id)
                    <div class="col-12 col-md-12">
                        <div class="product-title">
                          No Telpon Pembeli
                        </div>
                        <div class="product-subtitle ">
                          {{ $transaction->transaction->user->phone_number }}  <a target="_blank" href="https://api.whatsapp.com/send?text=Hallo saya dokter {{ $transaction->product->name }}&phone={{ $transaction->transaction->user->phone_number }}" type="button" class="btn btn-success btn-sm">Chat</a>
                        </div>
                        <div class="product-title">
                          Konfirmasi Status Pembelian
                        </div>
                          @if ($transaction->transaction->transaction_status == 'SUCCESS')
                            <button disabled type="button" class="btn btn-success btn-sm">Selesai</button>
                          @else
                            <a href="/konfirmasistatuspenjual/{{ $transaction->transaction->id }}" class="btn btn-warning">Konfrimasi Transasksi</a>
                          @endif
                    </div>

                    @else
                      <div class="col-12 col-md-12">
                        <div class="product-title">
                          No Telpon Penjual
                        </div>
                        <div class="product-subtitle ">
                          {{ $transaction->product->user->phone_number }} <a target="_blank" href="https://api.whatsapp.com/send?text=Hallo saya dokter {{ $transaction->product->name }}&phone={{ $transaction->transaction->user->phone_number }}" type="button" class="btn btn-success btn-sm">Chat</a>
                        </div>

                       @if ($transaction->transaction->invoice)

                       <div class="product-title">
                          Konfirmasi Status Pembelian
                        </div>
                        
                        @if ($transaction->transaction->status_transaction_customer == 'SUCCESS')
                          <button disabled type="button" class="btn btn-success btn-sm">Selesai</button>
                        @else

                          <a href="/konfirmasistatuscustomer/{{ $transaction->transaction->id }}" class="btn btn-warning">Konfrimasi Transasksi</a>
                        @endif

                        <div class="product-title">
                          Cek Bukti Pembayaran
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buktipembayaran">
                          Bukti Pemyaran
                        </button>
                         
                       @else
                       <div class="product-title">
                          Upload Bukti Pembayaran
                        </div>
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Upload Bukti Pembayaran
                        </button>
                       @endif

                        

                        
                        
                        
                       
                      </div>
                    @endif

                  <div class="mt-3 col-12 col-md-6">
                      <div class="product-title">
                        Status Pengiriman
                      </div>
                      <div class="product-subtitle">
                      @if ($transaction->shipping_status == 'PENDING')
                          Belum Di Kirim
                      @elseif ($transaction->shipping_status == 'SHIPPING')
                          Sedang Dalam Perjalanan
                      @else
                          Selesai
                      @endif
       
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Tanggal Transaksi
                      </div>
                      <div class="product-subtitle">
                        {{ $transaction->created_at->format('d-m-Y') }}
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Status Transaksi
                      </div>
                      
                      @if ($transaction->transaction->transaction_status == 'SUCCESS' AND $transaction->transaction->status_transaction_customer == 'SUCCESS')
                       <div class="product-subtitle text-success">
                        SUCCESS
                         </div>
                        @else
                          <div class="product-subtitle text-danger">
                        PENDING
                         </div>
                      @endif

                     </div>

                     <div class="col-12 col-md-6">
                      <div class="product-title">
                        Total Produk
                      </div>
                      <div class="product-subtitle ">
                        {{ $jumlahproduk}}
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Total Biaya
                      </div>
                      <div class="product-subtitle ">
                      RP. {{ number_format($transaction->price) }}
                       
                      </div>
                    </div>
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          Lokasi 1
                        </div>
                        <div class="product-subtitle">
                          {{ $transaction->transaction->user->address_one }}
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          silahkan melakukan pembayaran ke rekening :
                        </div>
                        <div class="product-subtitle">
                         <img src="/images/bca.png" style="width:70px;" alt=""> 3370968798 a/n Al hilal julianda
                          
                        </div>
                      </div>
                      
                      {{-- <div class="col-12 col-md-6">
                        <div class="product-title">
                          Province
                        </div>
                        <div class="product-subtitle">
                          {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          City
                        </div>
                        <div class="product-subtitle">
                         {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          Postal Code
                        </div>
                        <div class="product-subtitle">
                         {{ $transaction->transaction->user->zip_code }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">
                          Country
                        </div>
                        <div class="product-subtitle">
                         {{ $transaction->transaction->user->country }}
                        </div>
                      </div> --}}

                      @if (Auth::user()->id == $transaction->product->users_id)
                        <div class="col-12 col-md-3">
                        <div class="product-title">
                          Status Pengiriman
                        </div>
                        <select name="shipping_status" id="status" class="form-control" v-model=status>
                          <option value="PENDING">Belum Di Kirim</option>
                          <option value="SHIPPING">Sedang Dalam Perjalanan</option>
                          <option value="SUCCESS">Selesai</option>
                        </select>
                      </div>
                      {{-- <template v-if="status == 'SHIPPING' ">
                        <div class="col-md-3">
                          <div class="product-title">Input Resi</div>
                          <input type="text" class="form-control" name="resi" v-model="resi">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success btn-block mt-4">Update Resi</button>
                        </div>
                      </template> --}}
                    </div>
                  </div>
                </div>
                <div class="row text-right">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success btn-lg mt-4">UPDATE</button>
                  </div>
                </div>
              @endif
                      
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
      status: "{{ $transaction->shipping_status }}",
      resi: "{{ $transaction->resi }}",
    },
  });
</script>
@endpush