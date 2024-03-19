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
                <h1>Update Price</h1>

                {{-- <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Price</a></div>

                </div> --}}
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
                            {{-- <div class="card-header">
                                <h4>Order Yang Sedang Di Proses</h4> --}}
                                {{-- <div class="section-header-button">
                                    <a href="{{ route('order.order.proses') }}" class="btn btn-primary">New Order</a>
                                </div> --}}
                            {{-- </div> --}}
                            <div class="card-body">

                                {{-- <div class="float-right">
                                    <form method="GET", action="{{ route('receipt.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>ID</th>
                                            <th>Price</th>
                                            <th>Created</th>
                                            <th>Update</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($price as $prices)
                                            <tr>
                                                <td>
                                                    {{ $prices->id }}
                                                </td>
                                                <td>
                                                    {{ $prices->price }}
                                                </td>
                                                <td>
                                                    {{ $prices->created_at }}
                                                </td>
                                                <td>
                                                    {{ $prices->updated_at }}
                                                </td>





                                                {{-- <td>
                                                <select name="order_id" class="form-control">
                                                    <option value="">{{$prices->status}}</option>
                                                    @foreach ($price as $prices )
                                                    <option value="{{$prices->status}}">{{$prices->status}}</option>

                                                    @endforeach
                                                   </select>
                                                </td> --}}
                                                <td>
                                                    <div class="d-flex justify-content-center">

                                                        <div class="section-header-button">

                                                            <a href='{{ route('price.edit', $prices->id )}}'
                                                                class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i>
                                                                Edit
                                                            </a>
                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach



                                    </table>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $price->withQueryString()->links() }}
                                </div> --}}
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
