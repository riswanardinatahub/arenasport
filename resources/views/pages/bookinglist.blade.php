@extends('layouts.app')

@section('title')
Booking List
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

      <div class="row mt-5">
        <div class="col mb-4">
          <span class="" style="font-size: 23px; color: black; font-weight:800;"> Daftar Booking </span>

        </div>
        <div class="col-12">

          <table id="example" class="table table-bordered" style="width:100%">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Booking</th>
                <th scope="col">Arena</th>
                <th scope="col">Total Biaya</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Status</th>
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
                <td>{{ $data->arena->store_name }}</td>
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
                <td>Rp. {{ number_format($data->down_payment,0,',','.') }}</td>

                <td><a href="{{ route('detailbooking', $data->id) }}" class="btn btn-sm btn-success">Detail</a></td>
              </tr>
            @endforeach
              
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>










@endsection