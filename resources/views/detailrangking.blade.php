@extends('layouts.app')

@section('title')
Detail Rangking
@endsection

@section('content')
<br>
<br>
<br>
<br>

<section class="store-name">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="d-flex justify-content-center flex-row bd-highlight">

                    <div class="p-1 bd-highlight">
                        <h2> Daftar Rangking Penjualan Produk Desa</h2>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section class="store-name mt-3" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-5 text-center mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Desa</th>
                            <th scope="col">Ranking</th>
                            <th scope="col">Jumlah Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no =0;
                        $test =1;
                        @endphp
                        @foreach ($occurences as $x => $val )
                        @php
                        $no++;
                        $datadesa = App\Models\Village::find($x)
                        @endphp
                        <tr>
                            <td>{{ $datadesa->name }}</td>
                            <td>{{ $test++ }}</td>
                            <td>{{ $val }}</td>
                        </tr>

                        @if ($no == 5)
                        @break
                        @endif
                        @endforeach



                    </tbody>
                </table>




            </div>
        </div>
    </div>
</section>


@endsection