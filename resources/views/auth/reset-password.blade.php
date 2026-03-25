@extends('layout.admin.authLayout')

@section('page_title', 'Setup New Password')

@section('content')

    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('admin.password.store') }}" novalidate="novalidate" id="kt_new_password_form">
        @csrf

        {{-- Hidden token --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}" />

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Setup New Password</h1>
            <div class="text-gray-400 fw-bold fs-4">Already reset your password?
                <a href="{{ route('admin.login') }}" class="link-primary fw-bolder">Sign in here</a>
            </div>
        </div>
        <!--end::Heading-->

        <!--begin::Input group - Email-->
        <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6" for="email">Email</label>
            <input
                id="email"
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
            />
            @error('email')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group - Password-->
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <div class="mb-1">
                <label class="form-label fw-bolder text-dark fs-6" for="password">New Password</label>
                <div class="position-relative mb-3">
                    <input
                        id="password"
                        class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                          data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--begin::Meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
            @error('password')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group - Confirm Password-->
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-dark fs-6" for="password_confirmation">Confirm Password</label>
            <input
                id="password_confirmation"
                class="form-control form-control-lg form-control-solid"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            @error('password_confirmation')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->

    </form>
    <!--end::Form-->

@endsection

