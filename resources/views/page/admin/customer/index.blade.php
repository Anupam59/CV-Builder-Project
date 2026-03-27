@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', 'Your Customer List')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.search') }}" class="btn btn-sm btn-primary">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
            </svg>
        </span>
        Add Customer
    </a>
@endpush

@section('content')
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <span class="svg-icon svg-icon-2hx svg-icon-success me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                            <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5915 8.22897 11.0559 8.51412 11.3456L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29074 15.771 8.82641 15.4859 8.53664C15.1948 8.24141 14.7183 8.24141 14.4272 8.53664L11.2503 11.3042C11.1343 11.4196 10.6766 11.4196 10.5606 11.3042Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="card mb-5 mb-xl-8">
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-30px">SL</th>
                                    <th class="min-w-200px">Customer</th>
                                    <th class="min-w-150px">Phone</th>
                                    <th class="min-w-150px">Email</th>
                                    <th class="min-w-80px">CVs</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>
                                            <span class="text-muted fw-bold fs-7">
                                                {{ $customers->firstItem() + $loop->index }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="symbol-label bg-light-info text-info fw-bolder fs-6">
                                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="{{ route('admin.customers.show', $customer->id) }}"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">
                                                        {{ $customer->name }}
                                                    </a>
                                                    <span class="text-muted fw-bold d-block fs-7">
                                                        Added {{ $customer->pivot->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold fs-6">{{ $customer->phone }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold fs-7">{{ $customer->email ?? '—' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-primary fw-bolder fs-8 px-2 py-1">
                                                {{ $customer->cvs->where('user_id', auth()->id())->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                <a href="{{ route('admin.customers.show', $customer->id) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                    title="View">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a href="{{ '#' }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-success btn-sm"
                                                    title="Create CV">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                                rx="1" transform="rotate(-90 11.364 20.364)"
                                                                fill="currentColor"></rect>
                                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                                fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-10">
                                            No customers yet.
                                            <a href="{{ route('admin.customers.search') }}" class="text-primary ms-1">Add your first customer →</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row py-4 px-4">
                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                        <span class="text-muted fs-7">
                            Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }} of {{ $customers->total() }} customers
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        {{ $customers->links('components.admin.common.paginate') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
