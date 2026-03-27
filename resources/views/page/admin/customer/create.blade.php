@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', 'New Customer')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.search') }}" class="btn btn-sm btn-light btn-active-primary">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="currentColor"></path>
                <path opacity="0.3" d="M9.6 20L3 12L9.6 4V20Z" fill="currentColor"></path>
            </svg>
        </span>
        Back
    </a>
@endpush

@section('content')
    <div class="row gy-5 g-xl-8 justify-content-center">
        <div class="col-xl-7 col-lg-9">

            <div class="alert alert-primary d-flex align-items-center p-5 mb-5">
                <i class="fas fa-info-circle fs-2 text-primary me-3"></i>
                <div>
                    No customer found with phone <strong>{{ $phone }}</strong>. Please fill in the details to create a new customer.
                </div>
            </div>

            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-1 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path>
                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <h2>Create New Customer</h2>
                    </div>
                </div>

                <div class="card-body pt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                            <i class="fas fa-times-circle fs-2 text-danger me-3"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.customers.store') }}" class="form">
                        @csrf

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Name</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Customer full name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label">
                                <span class="required">Phone Number</span>
                            </label>
                            {{-- phone pre-filled and readonly --}}
                            <input type="text"
                                class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                name="phone"
                                value="{{ old('phone', $phone) }}"
                                readonly>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label">
                                        <span>Email</span>
                                        <span class="text-muted ms-1">(optional)</span>
                                    </label>
                                    <input type="email"
                                        class="form-control form-control-solid @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="customer@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label">
                                        <span>Address</span>
                                        <span class="text-muted ms-1">(optional)</span>
                                    </label>
                                    <input type="text"
                                        class="form-control form-control-solid @error('address') is-invalid @enderror"
                                        name="address"
                                        value="{{ old('address') }}"
                                        placeholder="Customer address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.customers.search') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Create Customer</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
