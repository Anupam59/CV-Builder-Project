@extends('layout.admin.adminLayout')

@section('page_title', 'CVs')
@section('page_subtitle', 'All CVs')

@section('content')
    <div class="card">
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-30px">SL</th>
                            <th class="min-w-200px">CV Title</th>
                            <th class="min-w-150px">Customer</th>
                            <th class="min-w-80px">Language</th>
                            <th class="min-w-120px">Created</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cvs as $cv)
                            <tr>
                                <td class="text-muted fs-7">{{ $cvs->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="{{ route('admin.cvs.show', $cv->id) }}"
                                        class="text-dark fw-bolder text-hover-primary fs-6">
                                        {{ $cv->title ?? 'Untitled CV' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.show', $cv->customer_id) }}"
                                        class="text-primary fw-bold fs-7">
                                        {{ $cv->customer->name }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $cv->language === 'bn' ? 'warning' : 'info' }}">
                                        {{ $cv->language === 'bn' ? 'বাংলা' : 'English' }}
                                    </span>
                                </td>
                                <td class="text-muted fs-7">{{ $cv->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.cvs.show', $cv->id) }}"
                                            class="btn btn-sm btn-icon btn-light btn-active-color-primary">
                                            <i class="fas fa-eye fs-7"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.cvs.destroy', $cv->id) }}"
                                            onsubmit="return confirm('Delete this CV?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger">
                                                <i class="fas fa-trash fs-7"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-10">No CVs created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row py-4 px-4">
            <div class="col-md-7 d-flex align-items-center justify-content-md-end">
                {{ $cvs->links('components.admin.common.paginate') }}
            </div>
        </div>
    </div>
@endsection
