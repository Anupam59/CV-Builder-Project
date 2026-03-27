@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', $customer->name)

@push('toolbar_actions')
    <a href="{{ '#' }}" class="btn btn-sm btn-primary me-2">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
            </svg>
        </span>
        Create CV
    </a>
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
    <div class="row gy-5 g-xl-8">

        {{-- Customer Info --}}
        <div class="col-xl-4">
            <div class="card card-flush h-100">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <h3>Customer Info</h3>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="d-flex align-items-center mb-8">
                        <div class="symbol symbol-65px me-5">
                            <span class="symbol-label bg-light-info text-info fw-bolder fs-2">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <div class="text-dark fw-bolder fs-4">{{ $customer->name }}</div>
                            <div class="text-muted fs-7">Customer</div>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-center">
                            <span class="svg-icon svg-icon-2 text-muted me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10001 2.29999 5.30001L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30001C21.5 5.10001 21.3 5 21 5Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div>
                                <div class="text-muted fs-8 mb-0">Email</div>
                                <div class="text-dark fw-bold fs-6">{{ $customer->email ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="svg-icon svg-icon-2 text-muted me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div>
                                <div class="text-muted fs-8 mb-0">Phone</div>
                                <div class="text-dark fw-bold fs-6">{{ $customer->phone }}</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="svg-icon svg-icon-2 text-muted me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.1453 19.2624 14.1453 18.0624 15.3453Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38845 13.7193 7.04534 12.0624 7.04534C10.4056 7.04534 9.06241 8.38845 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div>
                                <div class="text-muted fs-8 mb-0">Address</div>
                                <div class="text-dark fw-bold fs-6">{{ $customer->address ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="separator my-5"></div>

                    <div class="d-flex justify-content-between text-center">
                        <div>
                            <div class="text-dark fw-bolder fs-3">{{ $cvs->count() }}</div>
                            <div class="text-muted fs-7">Your CVs</div>
                        </div>
                        <div>
                            <div class="text-dark fw-bolder fs-3">
                                {{ $customer->users->count() }}
                            </div>
                            <div class="text-muted fs-7">Professionals Using</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CV List --}}
        <div class="col-xl-8">
            <div class="card card-flush">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <h3>CVs for {{ $customer->name }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '#' }}" class="btn btn-sm btn-primary">
                            + New CV
                        </a>
                    </div>
                </div>
                <div class="card-body pt-3">
                    @forelse ($cvs as $cv)
                        <div class="d-flex align-items-center p-4 mb-3 bg-light-primary rounded">
                            <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                        fill="currentColor"></path>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="flex-grow-1">
                                <div class="text-dark fw-bolder fs-6">
                                    {{ $cv->title ?? 'Untitled CV' }}
                                </div>
                                <div class="text-muted fs-7">
                                    Created {{ $cv->created_at->format('d M Y, h:i A') }}
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ '#' }}"
                                    class="btn btn-sm btn-light btn-active-color-primary">View</a>
                                <a href="{{ '#' }}"
                                    class="btn btn-sm btn-light btn-active-color-warning">Edit</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-12">
                            <span class="svg-icon svg-icon-4x text-muted mb-4 d-block mx-auto" style="width:64px">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                        fill="currentColor"></path>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="fs-5 fw-bold mb-2">No CVs yet</div>
                            <div class="fs-7 mb-4">Create the first CV for this customer.</div>
                            <a href="{{ '#' }}" class="btn btn-primary btn-sm">Create CV</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection
