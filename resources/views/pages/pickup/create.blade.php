@extends('layouts.app')

@section('title', 'New order')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">order</a></div>
                   {{-- <div class="breadcrumb-item">New User</div> --}}
                </div>
            </div>

            <div class="section-body">

                        <div class="card">
                            <form action="{{route('pickup.store')}}" method="POST">
                                @csrf
                                <div class="card-header">
                                    <h4>Add order</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Jarak</label>
                                        <input type="text"
                                            class="form-control @error('jarak')
                                            is-invalid
                                            @enderror"
                                            name="jarak">
                                            @error('jarak')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tarif</label>
                                        <input type="text"
                                            class="form-control @error('tarif')
                                            is-invalid
                                            @enderror"
                                            name="tarif">
                                            @error('tarif')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Order ID</label>
                                       <select name="order_id" class="form-control">
                                        <option value="">-pilih-</option>
                                        @foreach ($orders as $order )
                                        <option value="{{$order->id}}">{{$order->id}}</option>

                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Service</label>
                                       <select name="service" class="form-control">
                                        <option value="">-pilih-</option>
                                        @foreach ($orders as $order )
                                        <option value="{{$order->service}}">{{$order->service}}</option>

                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>User Name</label>
                                       <select name="user_id" class="form-control">
                                        <option value="">-pilih-</option>
                                        @foreach ($orders as $order )
                                        <option value="{{$order->user_id}}">{{$order->user->name}}</option>

                                        @endforeach
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Driver Name</label>
                                       <select name="driver_id" class="form-control">
                                        <option value="">-pilih-</option>
                                        @foreach ($receipt as $receipts )
                                        <option value="{{$receipts->id}}">{{$receipts->name}}</option>

                                        @endforeach
                                       </select>
                                    </div>

                                    {{-- <div class="form-group mb-0">
                                        <label>Address</label>
                                        <textarea class="form-control"
                                            data-height="150"
                                            name="address"></textarea>
                                    </div> --}}
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
