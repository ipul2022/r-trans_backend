@extends('layouts.app')

@section('title', 'List Order')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New Order</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">New Order</a></div>
                    {{-- <div class="breadcrumb-item">All Orders</div> --}}
                </div>
            </div>
            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">

                                    <h4>New Order</h4>
                                    <div class="card-header-action">
                                        <div class="btn-group">
                                            <a href="{{ route('order.index') }}"
                                                class="btn btn-primary">R-Ride</a>
                                            <a href="{{ route('shop.index') }}"
                                                class="btn btn-primary">R-Shop</a>
                                            <a href="{{ route('pickup.index') }}"
                                                class="btn btn-primary">R-Pickup</a>
                                        </div>
                                    </div>

                            </div>

                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET", action="{{ route('shop.index') }}">
                                        {{-- <form action="{{ route('order') }}" method="GET"> --}}
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Jenis</th>
                                                <th>Jumlah</th>
                                                <th>DanaTalangan</th>
                                                <th>Pembelian</th>
                                                <th>Pengantaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        @foreach ($shop as $order)

                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>
                                                    <div>
                                                        <form action="" method=""

                                                            class="ml-2">

                                                            <button class="btn btn-success">
                                                                <i class=""></i> {{ $order->status ? 'neworder' : 'selesai'}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $order->jenis_barang }}</td>
                                                <td>{{ $order->jumlah_barang }}</td>
                                                <td>{{ $order->dana_talangan }}</td>
                                                <td>
                                                    {{ $order->alamat_penjemputan }}
                                                </td>
                                                <td>
                                                    {{ $order->alamat_tujuan }}
                                                </td>


                                                {{-- <td>
                                                    <a href="{{ route('order.update', $order->id) }}'" class="btn btn-sm
                                                        btn-{{ $order->status ? 'primary' : 'succes'}}"
                                                        >{{ $order->status ? 'selesai' : 'onproses'}}</a>

                                                </td> --}}


                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <div class="section-header-button">
                                                            <a href="{{ route('receipt.create') }}" class="btn btn-primary">Teruskan</a>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                                <div class="float-right">
                                    {{ $shop->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
