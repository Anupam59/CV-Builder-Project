@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', 'Customer Found')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.search') }}" class="btn btn-sm btn-light btn-active-primary">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="currentColor"></path>
                <path opacity="0.3" d="M9.6 20L3 12L9.6 4V20Z" fill="currentColor"></path>
            </svg>
        </span>
        Search Again
    </a>
@endpush

@section('content')
    <div class="row gy-5 g-xl-8 justify-content-center">
        <div class="col-xl-6 col-lg-8">

            {{-- Already attached notice --}}
            @if ($alreadyAttached)
                <div class="alert alert-info d-flex align-items-center p-5 mb-5">
                    <i class="fas fa-info-circle fs-2 text-info me-3"></i>
                    <div>This customer is already in your list. You can view their profile or create a new CV.</div>
                </div>
            @endif

            {{-- Customer Info Card --}}
            <div class="card card-flush mb-6">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-1 me-2 text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5915 8.22897 11.0559 8.51412 11.3456L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29074 15.771 8.82641 15.4859 8.53664C15.1948 8.24141 14.7183 8.24141 14.4272 8.53664L11.2503 11.3042C11.1343 11.4196 10.6766 11.4196 10.5606 11.3042Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <h2>Customer Found!</h2>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="bg-light rounded p-4">
                                <div class="text-muted fs-7 fw-bold mb-1">Name</div>
                                <div class="text-dark fw-bolder fs-5">{{ $customer->name }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light rounded p-4">
                                <div class="text-muted fs-7 fw-bold mb-1">Phone</div>
                                <div class="text-dark fw-bolder fs-5">{{ $customer->phone }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light rounded p-4">
                                <div class="text-muted fs-7 fw-bold mb-1">Email</div>
                                <div class="text-dark fw-bold fs-6">{{ $customer->email ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-light rounded p-4">
                                <div class="text-muted fs-7 fw-bold mb-1">Address</div>
                                <div class="text-dark fw-bold fs-6">{{ $customer->address ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            @if ($alreadyAttached)
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.customers.show', $customer->id) }}"
                        class="btn btn-primary flex-grow-1">
                        View Customer Profile
                    </a>
                    <a href="{{ route('admin.cvs.create', ['customer_id' => $customer->id]) }}"
                        class="btn btn-success flex-grow-1">
                        Create New CV
                    </a>
                </div>
            @else
                <div class="card card-flush border border-dashed border-primary">
                    <div class="card-body py-6 text-center">
                        <p class="text-dark fs-6 fw-bold mb-6">
                            Do you want to add this customer to your list?
                        </p>
                        <form method="POST" action="{{ route('admin.customers.attach') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('admin.customers.search') }}"
                                    class="btn btn-light btn-lg px-10">
                                    No, Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-10">
                                    Yes, Add to My List
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
