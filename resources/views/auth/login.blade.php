@extends('layout.admin.authLayout')

@section('page_title', 'Sign In')

@section('content')

    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('admin.login') }}" novalidate="novalidate" id="kt_sign_in_form">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Sign In to {{ config('app.name') }}</h1>
            <div class="text-gray-400 fw-bold fs-4">New Here?
                <a href="{{ route('admin.register') }}" class="link-primary fw-bolder">Create an Account</a>
            </div>
        </div>
        <!--end::Heading-->

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert alert-success mb-10">{{ session('status') }}</div>
        @endif

        <!--begin::Input group - Email-->
        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark" for="email">Email</label>
            <input id="email"
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email"
                name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group - Password-->
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0" for="password">Password</label>
                @if (Route::has('admin.password.request'))
                    <a href="{{ route('admin.password.request') }}" class="link-primary fs-6 fw-bolder">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <input id="password"
                class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Remember Me-->
        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid" for="remember_me">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                <span class="form-check-label fw-bold text-gray-700 fs-6">Remember me</span>
            </label>
        </div>
        <!--end::Remember Me-->

        <!--begin::Actions-->
        <div class="text-center">

            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">Continue</span>
                <span class="indicator-progress">
                    Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <!--end::Submit button-->

            <!--begin::Separator-->
            <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
            <!--end::Separator-->

            <!--begin::Google-->
            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                <img alt="Google" src="{{ asset('assets/image/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />
                Continue with Google
            </a>
            <!--end::Google-->

            <!--begin::Facebook-->
            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
                <img alt="Facebook" src="{{ asset('assets/image/svg/brand-logos/facebook-4.svg') }}" class="h-20px me-3" />
                Continue with Facebook
            </a>
            <!--end::Facebook-->

            <!--begin::Apple-->
            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
                <img alt="Apple" src="{{ asset('assets/image/svg/brand-logos/apple-black.svg') }}"
                    class="h-20px me-3" />
                Continue with Apple
            </a>
            <!--end::Apple-->

        </div>
        <!--end::Actions-->

    </form>
    <!--end::Form-->

@endsection


