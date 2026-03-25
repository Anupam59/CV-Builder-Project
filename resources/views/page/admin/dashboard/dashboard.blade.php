@extends('layout.admin.adminLayout')

@section('page_title', 'Dashboard')
@section('page_subtitle', '#XRS-45670')


{{-- ========== FILTER BUTTON + DROPDOWN ========== --}}
@push('toolbar_filter')
    <div class="m-0">

        {{-- Filter toggle button --}}
        <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end">
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

        {{-- Filter Dropdown Box --}}
        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">

            <div class="px-7 py-5">
                <div class="fs-5 text-dark fw-bolder">Filter Options</div>
            </div>

            <div class="separator border-gray-200"></div>

            <div class="px-7 py-5">

                {{-- Status filter --}}
                <div class="mb-10">
                    <label class="form-label fw-bold">Status:</label>
                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option"
                        data-allow-clear="true">
                        <option></option>
                        <option value="1">Approved</option>
                        <option value="2">Pending</option>
                        <option value="3">In Process</option>
                        <option value="4">Rejected</option>
                    </select>
                </div>

                {{-- Member Type filter --}}
                <div class="mb-10">
                    <label class="form-label fw-bold">Member Type:</label>
                    <div class="d-flex">
                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                            <input class="form-check-input" type="checkbox" value="1" />
                            <span class="form-check-label">Author</span>
                        </label>
                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="2" checked />
                            <span class="form-check-label">Customer</span>
                        </label>
                    </div>
                </div>

                {{-- Notifications filter --}}
                <div class="mb-10">
                    <label class="form-label fw-bold">Notifications:</label>
                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" name="notifications" checked />
                        <label class="form-check-label">Enabled</label>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                        data-kt-menu-dismiss="true">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                </div>

            </div>
        </div>
        {{-- end Filter Dropdown --}}

    </div>
@endpush


{{-- ========== CREATE BUTTON ========== --}}
@push('toolbar_actions')
    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">
        Create
    </a>
@endpush


{{-- ========== PAGE CONTENT ========== --}}
@section('content')
    <div class="row gy-5 g-xl-8">
        <div class="col-xl-12">


            <div class="card card-xl-stretch mb-5 mb-xl-8">

                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Members Statistics</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Over 500 members</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_invite_friends">
                            + New Member
                        </a>
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                data-kt-check="true" data-kt-check-target=".widget-9-check" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Authors</th>
                                    <th class="min-w-150px">Company</th>
                                    <th class="min-w-150px">Progress</th>
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <!--end::Body-->

            </div>

        </div>
    </div>
@endsection
