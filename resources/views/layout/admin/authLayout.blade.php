<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }} - @yield('page_title', 'Authentication')</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/global/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @stack('styles')
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication-->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('assets/image/illustrations/sketchy-1/14.png') }})">

            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

                <!--begin::Logo-->
                <a href="{{ url('/') }}" class="mb-12">
                    <img alt="{{ config('app.name') }}" src="{{ asset('assets/image/logos/logo-1.svg') }}"
                        class="h-40px" />
                </a>
                <!--end::Logo-->

                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    @yield('content')
                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="#" class="text-muted text-hover-primary px-2">About</a>
                    <a href="#" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="#" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>
            </div>
            <!--end::Footer-->

        </div>
        <!--end::Authentication-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>
    <!--begin::Global Javascript Bundle-->
    <script src="{{ asset('assets/js/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/global/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    @stack('scripts')
</body>
<!--end::Body-->

</html>
