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
               Transaksi
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Pemesan</th>
                                            <th>Nama Arena</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    var datatable = $('#crudTable').DataTable({
        porcessing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user.name', name: 'user.name' },
            { data: 'arena.store_name', name: 'arena.store_name' },
            { data: 'total_price', name: 'total_price' },
            { data: 'status', name: 'transaction_status' },
            { data: 'time', name: 'created_at' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'

            },
        ]
    });
</script>
@endpush