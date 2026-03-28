<div class="d-flex align-items-start justify-content-between p-4 mb-3 bg-light rounded">
    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-3 mb-1">
            <span class="text-dark fw-bolder fs-6">{{ $item->job_title }}</span>
            @if ($item->is_current)
                <span class="badge badge-light-success fs-9">Current</span>
            @endif
        </div>
        <div class="text-success fw-bold fs-7 mb-1">{{ $item->company_name }}</div>
        <div class="text-muted fs-8">
            @if ($item->employment_type)
                <span class="badge badge-light-secondary fs-9 me-2">{{ ucfirst($item->employment_type) }}</span>
            @endif
            @if ($item->start_date)
                {{ $item->start_date->format('M Y') }} –
                {{ $item->is_current ? 'Present' : ($item->end_date ? $item->end_date->format('M Y') : '?') }}
            @endif
        </div>
        @if ($item->description)
            <p class="text-muted fs-8 mt-2 mb-0">{{ $item->description }}</p>
        @endif
    </div>
    <div class="d-flex gap-2 ms-4 flex-shrink-0">
        <a href="{{ route('admin.customers.profile.experience.edit', [$customer->id, $item->id]) }}"
            class="btn btn-sm btn-icon btn-light btn-active-color-primary" title="Edit">
            <i class="fas fa-pen fs-7"></i>
        </a>
        <form method="POST"
            action="{{ route('admin.customers.profile.experience.destroy', [$customer->id, $item->id]) }}"
            onsubmit="return confirm('Delete this experience record?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger" title="Delete">
                <i class="fas fa-trash fs-7"></i>
            </button>
        </form>
    </div>
</div>
