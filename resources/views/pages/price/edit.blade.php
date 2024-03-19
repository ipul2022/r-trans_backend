@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- <div class="section-header">
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">User</a></div>
                    <div class="breadcrumb-item">Edit User</div>
                </div>
            </div> --}}

            <div class="section-body">

                        <div class="card">
                            <form action="{{route('price.update', $price)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Price</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="price"
                                            class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                                            name="price" value="{{ $price->price }}">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>






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
