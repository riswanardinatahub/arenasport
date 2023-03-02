@extends('layouts.success')

@section('title')
    Success Page
@endsection

@section('content')
   <div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-6 text-center">
            <img src="/images/success.svg" class="mb-4" alt="">
            <h2>
              Selesaikan Transaksimu!
            </h2>
            <p>
              Silahkan chat arenamu untuk lakukan transaksi dan <br>
              status akan berubah setelah transaksi dilakukan! 
            </p>
            <a href="" class="btn btn-success w-50 mt-4">
              Cek Pesananmu
            </a>

            <a href="/" class="btn btn-signup w-50 mt-2">
              Halaman Utama
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection