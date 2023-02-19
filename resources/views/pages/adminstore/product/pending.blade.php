@extends('layouts.adminstore')

@section('title')
Product
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Produk
            </h2>
            <p class="dashboard-subtitle">
                List Produk
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
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Pemilik</th>
                                            <th>Desa</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th>Action</th>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var datatable = $('#crudTable').DataTable({
        porcessing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            {data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'user.name', name: 'user.name' },
            { data: 'user.villages.name', name: 'user.villages.name' },
            { data: 'category.name', name: 'category.name' },
            { data: 'price', name: 'price' },
            { data: 'image', name: 'image' },
            
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





<script>
$('body').on('click','.terimaproduk',function(event){
                event.preventDefault();
                    var id = $(this).attr('data-id');
                    var nama = $(this).attr('data-nama');
                    swal({
                        title: "Yakin?",
                        text: "Akan Menerima Produk Ini "+ nama +" ??",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        console.log(willDelete);
                        if (willDelete) {
                           
                            window.location = "terima/" + id + ""
                            swal("Data Produk :  "+ nama +" telah berhasil Di Terima", {
                            icon: "success",
                        
                            });
                        
                        } else {
                            swal("Data Produk "+ name + " Tidak Jadi Di Terima ");
                        }
                    });
        });
        

    </script>


    <script>
$('body').on('click','.tolakproduk',function(event){
                event.preventDefault();
                    var id = $(this).attr('data-id');
                    var nama = $(this).attr('data-nama');
                    swal({
                        title: "Yakin?",
                        text: "Akan Menolak Produk Ini "+ nama +" ??",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        console.log(willDelete);
                        if (willDelete) {
                           
                            window.location = "tolak/" + id + ""
                            swal("Data Produk :  "+ nama +" telah berhasil Di Tolak", {
                            icon: "success",
                        
                            });
                        
                        } else {
                            swal("Data Produk "+ name + " Tidak Jadi Di Terima ");
                        }
                    });
        });
        

    </script>


@endpush