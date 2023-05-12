@extends('layouts.admin')

@section('title')
Admin Dashboard
@endsection

@section('content')

<style>
    .highcharts-figure,
.highcharts-data-table table {
  min-width: 310px;
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
        <div class="section-content section-dashboard-home" data-aos="fade-up">
                <div class="container-fluid">
                    <div class="dashboard-heading">
                    <h2 class="dashboard-title">
                      Admin  Dashboard
                    </h2>
                    <p class="dashboard-subtitle">
                        Halaman ini di akses oleh super admin
                    </p>
                    @if ($lapanganpending >=1)
                        <p class="dashboard-subtitle">
                       <a href="{{ route('admin-product-pending') }}" class="btn btn-warning text-white">
                       Lapangan perlu persetujuan mohon segera lakukan pengecekan total {{ $lapanganpending }}
                       </a>
                    </p>
                    @else 
                    @endif
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
                    <a href="#"
                        class="card card-list d-block">
                        <div class="card-body">
                            <div class="row">
                            
                                <div class="col-md-2">
                                    {{ $transaction->code }}
                                </div>
                                <div class="col-md-2">
                                    {{ $transaction->arena->store_name }}
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
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
                    data: {!! json_encode($datatransaksi) !!}

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