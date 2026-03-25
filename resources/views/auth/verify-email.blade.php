@extends('layout.admin.authLayout')

@section('page_title', 'Verify Email')

@section('content')

    <!--begin::Heading-->
    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">Verify your Email</h1>
        <div class="text-gray-400 fw-bold fs-4">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
        </div>
    </div>
    <!--end::Heading-->

    {{-- Verification link sent status --}}
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-success me-3"></span>
            <div class="d-flex flex-column">
                <span>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
            </div>
        </div>
    @endif

    <!--begin::Actions-->
    <div class="d-flex flex-wrap justify-content-center gap-3">

        {{-- Resend Email --}}
        <form method="POST" action="{{ route('admin.verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                <span class="indicator-label">{{ __('Resend Verification Email') }}</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </form>

        {{-- Logout --}}
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-lg btn-light-primary fw-bolder">
                {{ __('Log Out') }}
            </button>
        </form>

    </div>
    <!--end::Actions-->

@endsection
