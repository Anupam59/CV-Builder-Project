@extends('layout.admin.authLayout')

@section('page_title', 'Forgot Password')

@section('content')

    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('admin.password.email') }}" novalidate="novalidate"
        id="kt_password_reset_form">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Forgot Password?</h1>
            <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
        </div>
        <!--end::Heading-->

        {{-- Session Status --}}
        @if (session('status'))
            <div class="alert alert-success mb-10">{{ session('status') }}</div>
        @endif

        <!--begin::Input group - Email-->
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6" for="email">Email</label>
            <input id="email" class="form-control form-control-solid @error('email') is-invalid @enderror"
                type="email" name="email" value="{{ old('email') }}" required autofocus />
            @error('email')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <a href="{{ route('admin.login') }}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
        </div>
        <!--end::Actions-->

    </form>
    <!--end::Form-->

@endsection

