@extends('layouts.admin')

@section('title')
Admin Dashboard
@endsection

@section('content')
        <div class="section-content section-dashboard-home" data-aos="fade-up">
                <div class="container-fluid">
                    <div class="dashboard-heading">
                    <h2 class="dashboard-title">
                      Admin  Dashboard
                    </h2>
                    <p class="dashboard-subtitle">
                        Halaman ini di akses oleh super admin Lapangan
                    </p>
                    </div>
                    <div class="dashboard-content">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                            <div class="dashboard-card-title">
                                Users
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $customer }}
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                            <div class="dashboard-card-title">
                                Transaksi
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $transaction }}
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                            <div class="dashboard-card-title">
                                Penghasilan
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ $revenue }}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                     <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card mb-2">
                                <div class="card-body" id="container">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-2">
                                <div class="card-body" id="datatransaksi">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 mt-2">
                        <h5 class="mb-3"> Transaksi Terakhir </h5>
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


@push('addon-script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>


            Highcharts.chart('datatransaksi', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: 'Statistik Transaksi'
                },
                subtitle: {
                    text: 'Source: WorldClimate.com'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                    text: 'Total Transaction'
                    },
                    labels: {
                    formatter: function () {
                        return this.value + '';
                    }
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true
                },
                plotOptions: {
                    spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                    }
                },
                series: [{
                    name: 'Transction',
                    marker: {
                    symbol: 'square'
                    },
                    data: {{ $statistiktransaksi }}

                }, ]
                });
</script>
   <script type="text/javascript">
    
   
    Highcharts.chart('container', {
        title: {
            text: 'Pengguna Baru, {{ \Carbon\Carbon::now()->year }}'
        },
        subtitle: {
            text: 'Lapangan'
        },
         xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Jumlah Pengguna Mendafatar'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Pengguna Baru',
            data: {!! $statistikuser !!}
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 200
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
@endpush