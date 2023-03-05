@extends('layouts.admin')

@section('title')
Transaksi
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Transaksi
            </h2>
            <p class="dashboard-subtitle">
                Edit Transaksi
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                             <div class="row">

                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status Transaksi</label>
                                            <select name="transaction_status" class="form-control">
                                            @if ($item->transaction_status == 'PENDING')
                                            <option value="{{ $item->transaction_status }}" selected>Belum Bayar</option>
                                            @elseif($item->transaction_status == 'DP')
                                            <option value="{{ $item->transaction_status }}" selected>DP</option>
                                            @else
                                            <option value="{{ $item->transaction_status }}" selected>Lunas</option>
                                            @endif
                                            <option value="" disabled>---------------------------</option>
                                            <option value="PENDING">Belum Bayar</option>
                                            <option value="DP">DP</option>
                                            <option value="SUCCESS">Lunas</option>
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Total Price</label>
                                            <input type="number" name="total_price" class="form-control" value="{{ $item->total_price }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Simpan
                                        </button>
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
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
     <script>
     CKEDITOR.replace('editor');
    </script>
@endpush