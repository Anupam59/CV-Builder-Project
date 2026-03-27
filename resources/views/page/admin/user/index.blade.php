@extends('layout.admin.adminLayout')

@section('page_title', 'Users')
@section('page_subtitle', 'Manage all users')

@push('toolbar_filter')
    <div class="m-0">
        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923
                        13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805
                        19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408
                        10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                </svg>
            </span>
            Filter
        </a>

        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-750px" data-kt-menu="true">
            <div class="px-7 py-5">
                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
            </div>
            <div class="separator border-gray-200"></div>
            <form method="GET" action="{{ route('admin.users.index') }}">
                <div class="row px-7 py-5">

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Name:</label>
                        <input type="text" name="name" value="{{ request('name') }}"
                            class="form-control form-control-solid" placeholder="Search by name">
                    </div>

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Email:</label>
                        <input type="text" name="email" value="{{ request('email') }}"
                            class="form-control form-control-solid" placeholder="Search by email">
                    </div>

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Phone:</label>
                        <input type="text" name="phone" value="{{ request('phone') }}"
                            class="form-control form-control-solid" placeholder="Search by phone">
                    </div>

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Status:</label>
                        <select name="is_active" class="form-select form-select-solid">
                            <option value="">All</option>
                            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Account Type:</label>
                        <select name="account_type" class="form-select form-select-solid">
                            <option value="">All</option>
                            <option value="free" {{ request('account_type') === 'free' ? 'selected' : '' }}>Free</option>
                            <option value="premium" {{ request('account_type') === 'premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 mb-10">
                        <label class="form-label fw-bold">Role:</label>
                        <select name="role" class="form-select form-select-solid">
                            <option value="">All</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="personal" {{ request('role') === 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="professional" {{ request('role') === 'professional' ? 'selected' : '' }}>Professional</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.users.index') }}"
                            class="btn btn-sm btn-light btn-active-light-primary me-2">Reset</a>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
@endpush

@push('toolbar_actions')
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                    transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
            </svg>
        </span>
        New User
    </a>
@endpush

@section('content')
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                data-kt-check="true" data-kt-check-target=".user-check">
                                        </div>
                                    </th>
                                    <th class="min-w-30px">SL</th>
                                    <th class="min-w-200px">Name</th>
                                    <th class="min-w-200px">Email / Phone</th>
                                    <th class="min-w-120px">Role</th>
                                    <th class="min-w-120px">Account Type</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input user-check" type="checkbox"
                                                    value="{{ $user->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-bold fs-7">
                                                {{ $users->firstItem() + $loop->index }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="symbol-label bg-light-primary text-primary fw-bolder fs-6">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="text-dark fw-bolder text-hover-primary fs-6">
                                                        {{ $user->name }}
                                                    </a>
                                                    <span class="text-muted fw-bold d-block fs-7">
                                                        Joined {{ $user->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bolder d-block fs-6">{{ $user->email }}</span>
                                            <span class="text-muted fw-bold d-block fs-7">
                                                {{ $user->phone ?? '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $roleColors = [
                                                    'admin' => 'danger',
                                                    'personal' => 'primary',
                                                    'professional' => 'success',
                                                ];
                                                $roleColor = $roleColors[$user->role] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-light-{{ $roleColor }} fw-bolder fs-8 px-2 py-1">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $user->account_type === 'premium' ? 'warning' : 'info' }} fw-bolder fs-8 px-2 py-1">
                                                {{ ucfirst($user->account_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($user->is_active)
                                                <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1">Active</span>
                                            @else
                                                <span class="badge badge-light-danger fw-bolder fs-8 px-2 py-1">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                    title="Edit">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3"
                                                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                fill="currentColor"></path>
                                                            <path
                                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                                        title="Delete">
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.5"
                                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.5"
                                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-10">
                                            No users found.
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
                            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} results
                        </span>
                    </div>
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        {{ $users->withQueryString()->links('components.admin.common.paginate') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
