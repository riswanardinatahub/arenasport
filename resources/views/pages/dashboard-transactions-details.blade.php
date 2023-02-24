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
    <div class="dashboardcontent" id="transactionDetails">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-4">
                  <img src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                    class="w-100 mb-3" alt="">
                </div>
                <div class="col-12 col-md-8">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Nama Pembeli
                      </div>
                      <div class="product-subtitle">
                        {{ $transaction->transaction->user->name }}
                      </div>
                    </div>
                      <div class="col-12 col-md-6">
                      <div class="product-title">
                        Nama Penjual
                      </div>
                      <div class="product-subtitle">
                        {{ $transaction->product->user->name }}
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Nama Arena
                      </div>
                      <div class="product-subtitle">
                        {{ $transaction->product->name }}
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Harga Per Arena
                      </div>
                      <div class="product-subtitle">
                      RP. {{ number_format($transaction->product->price) }}
                       
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
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
                        {{ $transaction->created_at }}
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
                        Total Qty
                      </div>
                      <div class="product-subtitle ">
                        {{ $transaction->total_qty}}
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

                    

                    @if (Auth::user()->id == $transaction->product->users_id)
                      <div class="col-12 col-md-6">
                      <div class="product-title">
                        No Telpon Pembeli
                      </div>
                      <div class="product-subtitle ">
                        {{ $transaction->transaction->user->phone_number }}  <a target="_blank" href="https://api.whatsapp.com/send?text=Hallo saya dokter {{ $transaction->product->name }}&phone={{ $transaction->transaction->user->phone_number }}" type="button" class="btn btn-success btn-sm">Chat</a>
                      </div>

                      @if ($transaction->transaction->transaction_status == 'SUCCESS')
                        <button disabled type="button" class="btn btn-success btn-sm">Selesai</button>
                      @else
                        <a href="/konfirmasistatuspenjual/{{ $transaction->transaction->id }}" class="btn btn-warning">Konfrimasi Transasksi</a>
                      @endif
                      


                    </div>

                    @else
                      <div class="col-12 col-md-6">
                      <div class="product-title">
                        No Telpon Penjual
                      </div>
                      <div class="product-subtitle ">
                         {{ $transaction->product->user->phone_number }} <a target="_blank" href="https://api.whatsapp.com/send?text=Hallo saya dokter {{ $transaction->product->name }}&phone={{ $transaction->transaction->user->phone_number }}" type="button" class="btn btn-success btn-sm">Chat</a>
                      </div>

                      @if ($transaction->transaction->status_transaction_customer == 'SUCCESS')
                        <button disabled type="button" class="btn btn-success btn-sm">Selesai</button>
                      @else
                        <a href="/konfirmasistatuscustomer/{{ $transaction->transaction->id }}" class="btn btn-warning">Konfrimasi Transasksi</a>
                      @endif
                       
                    </div>
                    @endif
                    
                    
                  </div>
                </div>
              </div>
              <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row">
                  <div class="col-12 mt-4">
                    <h5>Informasi COD</h5>
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
                          Lokasi 2
                        </div>
                        <div class="product-subtitle">
                          {{ $transaction->transaction->user->address_two }}
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