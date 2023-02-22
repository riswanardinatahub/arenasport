@extends('layouts.adminstore')

@section('title')
Admin Store Dashboard
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Admin Dashboard
            </h2>
            <p class="dashboard-subtitle">
                Dashboard ini di akses admin Arena {{ Auth::user()->villages->name }}
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class=" card-body">
                            <div class="dashboard-card-title">
                                Customers
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $customer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Product Total
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $product_total }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Transaction
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $transaction_total }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Revenue
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($revenue,0, ',' , '.')  }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3"> Recent Transaction</h5>
                    @foreach ($transaction_data as $transaction)
                    <a href="{{ route('dashboard-transaction-details', $transaction->id) }}"
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
                                    {{ $transaction->product->user->name ?? '' }}
                                </div>
                                <div class="col-md-3">
                                    {{ $transaction->created_at }}
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