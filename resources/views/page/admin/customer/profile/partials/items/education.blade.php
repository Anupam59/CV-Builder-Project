<div class="d-flex align-items-start justify-content-between p-4 mb-3 bg-light rounded">
    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-3 mb-1">
            <span class="text-dark fw-bolder fs-6">{{ $item->degree }}</span>
            @if ($item->field_of_study)
                <span class="text-muted fs-7">in {{ $item->field_of_study }}</span>
            @endif
        </div>
        <div class="text-primary fw-bold fs-7 mb-1">{{ $item->institute }}</div>
        <div class="text-muted fs-8">
            @if ($item->start_year || $item->end_year)
                {{ $item->start_year ?? '?' }} – {{ $item->end_year ?? 'Present' }}
            @endif
            @if ($item->result)
                · Result: <strong>{{ $item->result }}</strong>
            @endif
        </div>
        @if ($item->description)
            <p class="text-muted fs-8 mt-2 mb-0">{{ $item->description }}</p>
        @endif
    </div>
    <div class="d-flex gap-2 ms-4 flex-shrink-0">
        <a href="{{ route('admin.customers.profile.education.edit', [$customer->id, $item->id]) }}"
            class="btn btn-sm btn-icon btn-light btn-active-color-primary" title="Edit">
            <i class="fas fa-pen fs-7"></i>
        </a>
        <form method="POST"
            action="{{ route('admin.customers.profile.education.destroy', [$customer->id, $item->id]) }}"
            onsubmit="return confirm('Delete this education record?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger" title="Delete">
                <i class="fas fa-trash fs-7"></i>
            </button>
        </form>
    </div>
</div>
