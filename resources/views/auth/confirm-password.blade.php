@extends('layout.admin.authLayout')

@section('page_title', 'Confirm Password')

@section('content')

    <!--begin::Form-->
    <form class="form w-100" method="POST" action="{{ route('admin.password.confirm') }}" novalidate="novalidate">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Confirm Password</h1>
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
        </div>
        <!--end::Heading-->

        <!--begin::Input group - Password-->
        <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-dark fs-6" for="password">Password</label>
            <input
                id="password"
                class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            @error('password')
                <div class="fv-plugins-message-container mt-2">
                    <div class="fv-help-block text-danger">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                <span class="indicator-label">{{ __('Confirm') }}</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <!--end::Actions-->

    </form>
    <!--end::Form-->

@endsection
