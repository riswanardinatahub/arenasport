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
            <img src="/images/emptycart.svg" class="mb-4" alt="">
            <h2 class="font-weight-bold">
              Oops! Kamu Belum Memilih Lapangan
            </h2>
            
            <a href="{{ route('home') }}" class="btn btn-success w-50 mt-4">
              Cari Lapangan
            </a>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection