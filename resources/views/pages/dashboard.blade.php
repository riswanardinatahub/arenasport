@extends('layouts.dashboard')

@section('title')
Store Dashboard
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Dashboard
            </h2>
            <p class="dashboard-subtitle">
                Promosikan Bisnis mu di Arena Sport.
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Users
                            </div>
                            <div class="dashboard-card-subtitle">

                                {{ $hasil }}

                                {{-- @forelse ($customer as $index => $data)

                                @if($index == 0)
                                {{ $data->transaction->user->distinct('id')->count() }}
                                @endif
                                @empty
                                0
                                @endforelse --}}


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Penghasilan
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($totattransaksi) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Total Transaksi
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($totaltransaksisemua) }}
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Total Lapangan
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $totalproduct }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3"> Transaksi Terakhir</h5>

                    @foreach ($trasaction_data as $transaction)
                    <a href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                        class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    {{ $transaction->code }}
                                </div>
                                <div class="col-md-2">
                                    {{ $transaction->user->name }}
                                </div>
                                <div class="col-md-2">
                                    Rp. {{ number_format($transaction->total_price,0,',','.') }}
                                </div>
                                <div class="col-md-2">
                                    {{ $transaction->created_at->format('d-m-Y') }}
                                </div>
                                <div class="col-md-2">
                                     @if ($transaction->transaction_status == 'PENDING')
                            <span class="font-weight-bold"  style="color: red;">Belum Bayar</span> 
                            @elseif ($transaction->transaction_status == 'DP')
                            <span class="font-weight-bold" style="color: orange;">DP</span>
                            @else
                            <span class="font-weight-bold" style="color: green;">Lunas</span>
                              
                            @endif
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
@endsection