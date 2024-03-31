@extends('layouts.app')

@section('title', 'New Driver')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Add Driver</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Driver</a></div>
                   {{-- <div class="breadcrumb-item">New User</div> --}}
                </div>
            </div>

            <div class="section-body">

                        <div class="card">
                            <form action="{{route('driver.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Add Driver</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text"
                                            class="form-control @error('name')
                                            is-invalid
                                            @enderror"
                                            name="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email"
                                            class="form-control @error('email')
                                            is-invalid
                                            @enderror"
                                            name="email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password"
                                            class="form-control @error('password')
                                            is-invalid
                                            @enderror"
                                            name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="phone" class="form-control" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kendaraan</label>
                                        <input type="jenis_kendaraan" class="form-control" name="jenis_kendaraan">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Kendaraan</label>
                                        <input type="nomor_kendaraan" class="form-control" name="nomor_kendaraan">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <input type="text" class="form-control" name="gender">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="location">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="font-weight-bold">Driver Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                        <!-- error message untuk title -->
                                        @error('image')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="my-2">
                                        <label class="font-weight-bold">Driver Image</label>
                                        <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                      </div>
                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="admin"
                                                class="selectgroup-input"
                                                checked="">
                                            <span class="selectgroup-button">Admin</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="driver"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">Driver</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio"
                                                name="roles"
                                                value="mahasiswa"
                                                class="selectgroup-input">
                                            <span class="selectgroup-button">User</span>
                                        </label>
                                    </div>
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
