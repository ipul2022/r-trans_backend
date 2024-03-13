@extends('layouts.app')

@section('title', 'Receipt Order')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Receipt Order</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Order</a></div>
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
                                <h4>Order Yang Sedang Di Proses</h4>
                                {{-- <div class="section-header-button">
                                    <a href="{{ route('order.order.proses') }}" class="btn btn-primary">New Order</a>
                                </div> --}}
                            </div>
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET", action="{{ route('receipt.index') }}">
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
                                        <tr>
                                            <th>ID</th>
                                            <th>Jarak</th>
                                            <th>Tarif</th>
                                            <th>Driver</th>
                                            <th>User</th>

                                            <th>Service</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($receipt as $receipts)
                                            <tr>
                                                <td>
                                                    {{ $receipts->id }}
                                                </td>
                                                <td>
                                                    {{ $receipts->jarak }}
                                                </td>
                                                <td>
                                                    {{ $receipts->tarif }}
                                                </td>

                                                <td>
                                                    {{ $receipts->driver->name }}
                                                </td>
                                                <td>
                                                    {{ $receipts->user->name }}
                                                </td>
                                                <td>
                                                    {{ $receipts->order->service }}
                                                </td>
                                                <td>
                                                    <div>
                                                        <button class="btn btn-success">
                                                            <i class=""></i> {{ $receipts->status}}
                                                        </button>
                                                    </div>
                                                </td>


                                                {{-- <td>
                                                <select name="order_id" class="form-control">
                                                    <option value="">{{$receipts->status}}</option>
                                                    @foreach ($receipt as $receipts )
                                                    <option value="{{$receipts->status}}">{{$receipts->status}}</option>

                                                    @endforeach
                                                   </select>
                                                </td> --}}
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <div class="section-header-button">

                                                            @If($receipts=='Active')
                                                            <a " class="btn btn-primary">Di Proses</a>
                                                       @else($receipts=='Done')
                                                        <a " class="btn btn-primary">Di Proses</a>
                                                       @endif
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $receipt->withQueryString()->links() }}
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
