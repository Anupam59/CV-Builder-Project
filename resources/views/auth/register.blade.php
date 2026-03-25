@extends('layout.admin.authLayout')

@section('page_title', 'Create an Account')

@section('content')

    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('admin.register') }}" novalidate="novalidate" id="kt_sign_up_form">
        @csrf

        <!--begin::Heading-->
        <div class="mb-10 text-center">
            <h1 class="text-dark mb-3">Create an Account</h1>
            <div class="text-gray-400 fw-bold fs-4">Already have an account?
                <a href="{{ route('admin.login') }}" class="link-primary fw-bolder">Sign in here</a>
            </div>
        </div>
        <!--end::Heading-->

        <!--begin::Google Button-->
        <button type="button" class="btn btn-light-primary fw-bolder w-100 mb-10">
            <img alt="Google" src="{{ asset('assets/image/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />
            Sign in with Google
        </button>
        <!--end::Google Button-->

        <!--begin::Separator-->
        <div class="d-flex align-items-center mb-10">
            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
            <span class="fw-bold text-gray-400 fs-7 mx-2">OR</span>
            <div class="border-bottom border-gray-300 mw-50 w-100"></div>
        </div>
        <!--end::Separator-->

        <!--begin::Input group - Name-->
        <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6" for="name">Full Name</label>
            <input
                id="name"
                class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group - Email-->
        <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6" for="email">Email</label>
            <input
                id="email"
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
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
                <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
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
        <div class="fv-row mb-5">
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
            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
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

