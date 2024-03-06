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
                <h1>List Order</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Orders</a></div>
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
                                <h4>List Orders</h4>
                                {{-- <div class="section-header-button">
                                    <a href="{{ route('receipt.create') }}" class="btn btn-primary">New Order</a>
                                </div> --}}
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET", action="{{ route('listOrder.index') }}">
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
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Service</th>
                                                <th>Created</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>

                                        @foreach ($listOrders as $order)

                                            <tr>
                                                <td>
                                                    {{ $order->id }}
                                                </td>
                                                <td>
                                                    {{ $order->user->name }}
                                                </td>
                                                <td>
                                                    {{ $order->user->phone }}
                                                </td>

                                                <td>
                                                    {{ $order->service }}
                                                </td>
                                                <td>
                                                    {{ $order->created_at }}
                                                </td>



                                                <td>
                                                    <div>
                                                        <button class="btn btn-success">
                                                            <i class=""></i> {{ $order->status}}
                                                        </button>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                                <div class="float-right">
                                    {{ $listOrders->withQueryString()->links() }}
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
