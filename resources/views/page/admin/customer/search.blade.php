@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', 'Add Customer')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-light btn-active-primary">
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
        <div class="col-xl-6 col-lg-8">

            @if (session('warning'))
                <div class="alert alert-warning d-flex align-items-center p-5 mb-5">
                    <i class="fas fa-exclamation-triangle fs-2 text-warning me-3"></i>
                    <div>{{ session('warning') }}</div>
                </div>
            @endif

            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-1 me-2 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.1453 19.2624 14.1453 18.0624 15.3453Z" fill="currentColor"></path>
                                <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38845 13.7193 7.04534 12.0624 7.04534C10.4056 7.04534 9.06241 8.38845 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <h2>Search Customer by Phone</h2>
                    </div>
                </div>

                <div class="card-body pt-5">
                    <p class="text-muted fs-6 mb-8">
                        Enter the customer's phone number. If the customer already exists in the system, you can reuse their information. Otherwise, you'll be asked to fill in the full details.
                    </p>

                    <form method="POST" action="{{ route('admin.customers.search.phone') }}">
                        @csrf

                        <div class="fv-row mb-8">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Phone Number</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-solid form-control-lg @error('phone') is-invalid @enderror"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="e.g. 01712345678"
                                autofocus>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <span class="svg-icon svg-icon-3 me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M14.2929 4.70711C13.9024 4.31658 13.9024 3.68342 14.2929 3.29289L15.7071 1.87868C16.0976 1.48815 16.7308 1.48815 17.1213 1.87868L22.1213 6.87868C22.5118 7.26921 22.5118 7.90237 22.1213 8.29289L20.7071 9.70711C20.3166 10.0976 19.6834 10.0976 19.2929 9.70711L14.2929 4.70711Z" fill="currentColor"></path>
                                        <path d="M3.70711 19.2929C3.31658 18.9024 3.31658 18.2692 3.70711 17.8787L13.2929 8.29289C13.6834 7.90237 14.3166 7.90237 14.7071 8.29289L16.1213 9.70711C16.5118 10.0976 16.5118 10.7308 16.1213 11.1213L6.53553 20.7071C6.145 21.0976 5.51184 21.0976 5.12132 20.7071L3.70711 19.2929Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M1 5H9C9.55228 5 10 5.44771 10 6C10 6.55228 9.55228 7 9 7H1C0.447715 7 0 6.55228 0 6C0 5.44771 0.447715 5 1 5Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M1 11H5C5.55228 11 6 11.4477 6 12C6 12.5523 5.55228 13 5 13H1C0.447715 13 0 12.5523 0 12C0 11.4477 0.447715 11 1 11Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                Search Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
