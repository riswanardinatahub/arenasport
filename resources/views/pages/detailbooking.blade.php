@extends('layouts.app')

@section('title')
Booking Detail
@endsection

@section('content')
<div class="page-content page-auth ">
  <div class="section-store-auth" data-aos="fade-up">
    <div class="container">
      <div class="row ">


        <div class="col-12 col-lg-8 mt-2 w-100 h-100">
          @if ($message = Session::get('success'))
          <div class="alert alert-success" role="alert">
            {{ $message }}
          </div>
          @endif
        </div>



      </div>

      <div class="row mt-3">
        <div class="col mb-4">
          <span class="" style="font-size: 23px; color: black; font-weight:800;"> Detail Transaksi </span>( {{ $transaction->code }} ) 

        </div>
        <div class="col-12">
          <div class="row">
            <div class="dashboardcontent" >



              <div class="row">
             

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

                    
                        <div class="row">
                          <div class="col-12 mt-4">
                            <div class="col mb-4">
                              <span class="" style="font-size: 20px; color: black; font-weight:600;"> Informasi</span>
                            </div>
                          </div>

                          <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              No Telpon Arena 
                            </div>
                            <div class="product-subtitle ">
                              <div class="row">
                                <div class="col-12 col-md-9 col-lg-9 pr-md-0">
                             <input disabled  value="{{ $transaction->product->user->phone_number }}" type="text" class="form-control" >

                                </div>
                                <div class="col-12 col-md-3 col-lg-3 pl-md-1">
                              <a target="_blank"
                                href="https://api.whatsapp.com/send?text=Terimakasih Telah Memesan Lapangan ini silahkan {{ $transaction->product->name }}&phone={{ $transaction->transaction->user->phone_number }}"
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
                             <input disabled  value="{{ $transaction->created_at->format('d-m-Y') }}" type="text" class="form-control" >

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
                             <input disabled  value="RP. {{ number_format($transaction->price) }}" type="text" class="form-control" >

                              

                            </div>
                          </div>

                          <div class="col-12 col-md-6 mb-3">
                            <div class="product-title">
                              Status Transaksi  
                            

                            @if ($transaction->transaction->transaction_status== 'SUCCESS' )
                            <div class="product-subtitle font-weight-bold text-success">
                            LUNAS
                              
                             {{-- <input disabled  value="SUCCESS" type="text" class="form-control text-success" > --}}

                            </div>
                            @elseif ( $transaction->transaction->transaction_status == 'PENDING')
                            <div class="product-subtitle font-weight-bold text-danger">
                             {{-- <input disabled  value="PENDING" type="text" class="form-control" > --}}
                            BELUM BAYAR
                            </div>
                            @else
                            <div class="product-subtitle font-weight-bold text-warning">
                             {{-- <input disabled  value="DP" type="text" class="form-control" > --}}
                            DP
                            </div>
                            @endif

                          </div>
                          
                        </div>
                        
                        

                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>










@endsection