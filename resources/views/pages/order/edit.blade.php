@extends('layouts.app')

@section('title', 'Edit Order')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kirim Order</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Order</a></div>
                    <div class="breadcrumb-item">Kirim Order</div>
                </div>
            </div>

            <div class="section-body">

                        <div class="card">
                            <form action="{{route('order.index', $order)}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="card-header">
                                    <h4>Kirim Order</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input type="text"
                                            class="form-control @error('user_id')
                                            is-invalid
                                            @enderror"
                                            name="user_id", value="{{$order->user_id}}">
                                            @error('user_id')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Nama Driver</label>
                                        <input type="no_watsapp"
                                            class="form-control @error('nama driver')
                                            is-invalid
                                            @enderror"
                                            name="nama driver" value="{{$order->nama_driver}}">
                                            @error('no_watsapp')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div> --}}


                                    <div class="form-group">
                                        <label>Location Driver</label>
                                        <input type="text"
                                            class="form-control"
                                            name="location driver" value="{{$order->location_driver}}">
                                    </div>
                                    <div>
                                        @foreach ($users as $user)
                                        <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="{{$user->roles()->driver}}">One</option>
                                        <option value="{{$user->roles()->driver}}">Two</option>
                                        <option value="{{$user->roles()->driver}}">Three</option>
                                        @endforeach
                                      </select></div>

                                {{-- <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="admin"
                                                class="selectgroup-input"
                                                @if ($order->roles =='admin')
                                                checked
                                                @endif>
                                            <span class="selectgroup-button">Admin</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="driver"
                                                class="selectgroup-input"
                                                @if ($order->roles =='driver')
                                                checked
                                                @endif>
                                            <span class="selectgroup-button">Driver</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="mahasiswa"
                                                class="selectgroup-input"
                                                @if ($order->roles =='mahasiswa')
                                                checked
                                                @endif>
                                            <span class="selectgroup-button">Mahasiswa</span>
                                        </label>
                                    </div>
                                </div>
                                    <div class="form-group mb-0">
                                        <label>Address</label>
                                        <textarea class="form-control"
                                            data-height="150"
                                            name="address">{{$order->address}}</textarea>
                                    </div>
                                </div> --}}
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
