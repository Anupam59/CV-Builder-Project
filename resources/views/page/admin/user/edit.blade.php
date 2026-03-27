@extends('layout.admin.adminLayout')

@section('page_title', 'Users')
@section('page_subtitle', 'Edit User')

@push('toolbar_actions')
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light btn-active-primary">
        <span class="svg-icon svg-icon-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="currentColor"></path>
                <path opacity="0.3" d="M9.6 20L3 12L9.6 4V20Z" fill="currentColor"></path>
            </svg>
        </span>
        Back to List
    </a>
@endpush

@section('content')
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">
            <div class="card card-flush h-lg-100">
                <div class="card-header pt-7">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-1 me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                    fill="currentColor"></path>
                                <path opacity="0.3"
                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        <h2>Edit User — <span class="text-muted fs-5 fw-normal">{{ $user->name }}</span></h2>
                    </div>
                </div>

                <div class="card-body pt-5">
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5915 8.22897 11.0559 8.51412 11.3456L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29074 15.771 8.82641 15.4859 8.53664C15.1948 8.24141 14.7183 8.24141 14.4272 8.53664L11.2503 11.3042C11.1343 11.4196 10.6766 11.4196 10.5606 11.3042Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Validation Errors</h4>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="form">
                        @csrf
                        @method('PUT')

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Name</span>
                                    </label>
                                    <input type="text"
                                        class="form-control form-control-solid @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Email</span>
                                    </label>
                                    <input type="email"
                                        class="form-control form-control-solid @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $user->email) }}"
                                        placeholder="Enter email address">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>Phone</span>
                                    </label>
                                    <input type="text"
                                        class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone', $user->phone) }}"
                                        placeholder="Enter phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>New Password</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="Leave blank to keep current password"></i>
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-solid @error('password') is-invalid @enderror"
                                        name="password" placeholder="Leave blank to keep current">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Role</span>
                                    </label>
                                    <select name="role"
                                        class="form-select form-select-solid @error('role') is-invalid @enderror">
                                        <option value="">Select role</option>
                                        <option value="admin"
                                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="personal"
                                            {{ old('role', $user->role) === 'personal' ? 'selected' : '' }}>Personal
                                        </option>
                                        <option value="professional"
                                            {{ old('role', $user->role) === 'professional' ? 'selected' : '' }}>
                                            Professional</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span class="required">Account Type</span>
                                    </label>
                                    <select name="account_type"
                                        class="form-select form-select-solid @error('account_type') is-invalid @enderror">
                                        <option value="">Select type</option>
                                        <option value="free"
                                            {{ old('account_type', $user->account_type) === 'free' ? 'selected' : '' }}>
                                            Free</option>
                                        <option value="premium"
                                            {{ old('account_type', $user->account_type) === 'premium' ? 'selected' : '' }}>
                                            Premium</option>
                                    </select>
                                    @error('account_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>Status</span>
                                    </label>
                                    <div
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid mt-3">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator mb-6"></div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light me-3">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update User</span>
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
