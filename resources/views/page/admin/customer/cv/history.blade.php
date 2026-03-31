@extends('layout.admin.adminLayout')
@section('page_title', 'CV History')
@section('page_subtitle', 'Version History')

@push('toolbar_actions')
    <a href="{{ route('admin.cvs.show', $cv->id) }}" class="btn btn-sm btn-light">← Back to CV</a>
@endpush

@section('content')
    <div class="card">
        <div class="card-header pt-6">
            <div class="card-title">
                <h3>{{ $cv->title }} — All Versions</h3>
            </div>
        </div>
        <div class="card-body">
            @foreach ($snapshots as $snap)
                <div class="d-flex align-items-center justify-content-between p-5 mb-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-5">
                        <div
                            class="w-45px h-45px rounded-circle bg-light-primary d-flex align-items-center justify-content-center fw-bolder fs-5 text-primary">
                            v{{ $snap->version }}
                        </div>
                        <div>
                            <div class="fw-bold text-dark fs-6">Version {{ $snap->version }}</div>
                            <div class="text-muted fs-8">
                                Template: {{ $templates[$snap->template_name]['name'] ?? $snap->template_name }}
                                · By: {{ $snap->creator->name }}
                                · {{ $snap->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        @if ($cv->snapshot !== $snap->snapshot)
                            <form method="POST" action="{{ route('admin.cvs.restore', [$cv->id, $snap->id]) }}"
                                onsubmit="return confirm('Restore to version {{ $snap->version }}?')">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-light-primary">Restore</button>
                            </form>
                        @else
                            <span class="badge badge-light-success">Current</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
