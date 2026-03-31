@extends('layout.admin.adminLayout')

@section('page_title', 'Customers')
@section('page_subtitle', $customer->name)

@push('toolbar_actions')
    <a href="{{ route('admin.customers.profile.show', $customer->id) }}" class="btn btn-sm btn-primary me-2">
        <i class="fas fa-user-edit me-1"></i> Manage Profile
    </a>
    <a href="{{ route('admin.cvs.step1', ['customer_id' => $customer->id]) }}" class="btn btn-sm btn-success me-2">
        <i class="fas fa-file-alt me-1"></i> Create CV
    </a>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-light">← Back</a>
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
                    <div class="d-flex align-items-center mb-7">
                        <div class="symbol symbol-65px me-5">
                            <span class="symbol-label bg-light-info text-info fw-bolder fs-2">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <div class="text-dark fw-bolder fs-4">{{ $customer->name }}</div>
                            <div class="text-muted fs-7">
                                @if ($customer->detail?->profession)
                                    {{ $customer->detail->profession }}
                                @else
                                    Customer
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="d-flex flex-column gap-4">
                        <div>
                            <div class="text-muted fs-8 mb-0">Phone</div>
                            <div class="text-dark fw-bold fs-6">{{ $customer->phone }}</div>
                        </div>
                        <div>
                            <div class="text-muted fs-8 mb-0">Email</div>
                            <div class="text-dark fw-bold fs-6">{{ $customer->email ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="text-muted fs-8 mb-0">Address</div>
                            <div class="text-dark fw-bold fs-6">{{ $customer->address ?? '—' }}</div>
                        </div>
                        @if ($customer->detail)
                            <div>
                                <div class="text-muted fs-8 mb-0">Date of Birth</div>
                                <div class="text-dark fw-bold fs-6">
                                    {{ $customer->detail->date_of_birth?->format('d M Y') ?? '—' }}
                                </div>
                            </div>
                            <div>
                                <div class="text-muted fs-8 mb-0">Nationality</div>
                                <div class="text-dark fw-bold fs-6">
                                    {{ $customer->detail->nationality ?? '—' }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="separator my-5"></div>

                    <div class="d-flex justify-content-between text-center">
                        <div>
                            <div class="text-dark fw-bolder fs-3">
                                {{ $cvs->count() }}
                            </div>
                            <div class="text-muted fs-7">CVs</div>
                        </div>
                        <div>
                            <div class="text-dark fw-bolder fs-3">
                                {{ $customer->users->count() }}
                            </div>
                            <div class="text-muted fs-7">Professionals</div>
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
                        <h3>CVs</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.cvs.step1', ['customer_id' => $customer->id]) }}"
                            class="btn btn-sm btn-primary">+ New CV</a>
                    </div>
                </div>
                <div class="card-body pt-3">
                    @forelse ($cvs as $cv)
                        <div class="d-flex align-items-center p-4 mb-3 bg-light rounded">
                            <div class="flex-grow-1">
                                <div class="text-dark fw-bolder fs-6">
                                    {{ $cv->title ?? 'Untitled CV' }}
                                </div>
                                <div class="text-muted fs-8">
                                    <span class="badge badge-light-{{ $cv->language === 'bn' ? 'warning' : 'info' }} me-2">
                                        {{ $cv->language === 'bn' ? 'বাংলা' : 'English' }}
                                    </span>
                                    {{ $cv->created_at->format('d M Y, h:i A') }}
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.cvs.show', $cv->id) }}"
                                    class="btn btn-sm btn-light btn-active-color-primary">View</a>
                                <form method="POST" action="{{ route('admin.cvs.destroy', $cv->id) }}"
                                    onsubmit="return confirm('Delete this CV?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light btn-active-color-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-10">
                            No CVs yet.
                            <a href="{{ route('admin.cvs.step1', ['customer_id' => $customer->id]) }}"
                                class="text-primary ms-1">Create first CV →</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
@endsection
