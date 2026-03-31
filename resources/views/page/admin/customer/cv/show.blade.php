@extends('layout.admin.adminLayout')
@section('page_title', 'CV')
@section('page_subtitle', $cv->title)

@push('toolbar_actions')
    @if ($cv->is_locked)
        <a href="{{ route('admin.cvs.edit', $cv->id) }}" class="btn btn-sm btn-primary me-2">
            <i class="fas fa-pen me-1"></i> Edit CV
        </a>
    @endif
    <a href="{{ route('admin.cvs.history', $cv->id) }}" class="btn btn-sm btn-light-info me-2">
        <i class="fas fa-history me-1"></i> Version History
    </a>
    <a href="{{ route('admin.customers.show', $cv->customer_id) }}" class="btn btn-sm btn-light">← Back</a>
@endpush

@section('content')
    <div class="row g-5">

        {{-- CV Meta Info --}}
        <div class="col-12">
            <div class="card card-flush">
                <div class="card-body py-4 d-flex align-items-center gap-6 flex-wrap">
                    <div>
                        <span class="text-muted fs-8">Template</span>
                        <div class="fw-bold text-dark fs-6">
                            {{ Cv::availableTemplates()[$cv->template_name]['name'] ?? $cv->template_name }}</div>
                    </div>
                    <div class="separator separator-vertical h-30px"></div>
                    <div>
                        <span class="text-muted fs-8">Language</span>
                        <div>
                            <span class="badge badge-light-{{ $cv->language === 'bn' ? 'warning' : 'info' }}">
                                {{ $cv->language === 'bn' ? 'বাংলা' : 'English' }}
                            </span>
                        </div>
                    </div>
                    <div class="separator separator-vertical h-30px"></div>
                    <div>
                        <span class="text-muted fs-8">Status</span>
                        <div>
                            <span class="badge badge-light-{{ $cv->is_locked ? 'success' : 'warning' }}">
                                {{ $cv->is_locked ? '🔒 Locked' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    <div class="separator separator-vertical h-30px"></div>
                    <div>
                        <span class="text-muted fs-8">Versions</span>
                        <div class="fw-bold text-dark">{{ $cv->snapshots->count() }}</div>
                    </div>
                    <div class="separator separator-vertical h-30px"></div>
                    <div>
                        <span class="text-muted fs-8">Created</span>
                        <div class="text-dark fw-bold fs-7">{{ $cv->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CV Preview --}}
        <div class="col-12">
            <div class="card card-flush">
                <div class="card-header pt-6">
                    <div class="card-title">
                        <h3>CV Preview</h3>
                    </div>
                </div>
                <div class="card-body">
                    @include('page.admin.customer.cv.templates.' . $cv->template_name, [
                        's' => $cv->snapshot,
                        'isBn' => $cv->language === 'bn',
                    ])
                </div>
            </div>
        </div>

    </div>
@endsection
