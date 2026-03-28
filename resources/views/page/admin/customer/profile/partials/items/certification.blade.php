<div class="d-flex align-items-start justify-content-between p-4 mb-3 bg-light rounded">
    <div class="flex-grow-1">
        <div class="text-dark fw-bolder fs-6 mb-1">{{ $item->title }}</div>
        @if ($item->organization)
            <div class="text-dark fw-bold fs-7 mb-1">{{ $item->organization }}</div>
        @endif
        <div class="text-muted fs-8">
            @if ($item->issue_date)
                Issued: {{ $item->issue_date->format('M Y') }}
            @endif
            @if ($item->expiry_date)
                · Expires: {{ $item->expiry_date->format('M Y') }}
            @endif
            @if ($item->credential_id)
                · ID: <span class="fw-bold">{{ $item->credential_id }}</span>
            @endif
        </div>
    </div>
    <div class="d-flex gap-2 ms-4 flex-shrink-0">
        <a href="{{ route('admin.customers.profile.certification.edit', [$customer->id, $item->id]) }}"
            class="btn btn-sm btn-icon btn-light btn-active-color-primary" title="Edit">
            <i class="fas fa-pen fs-7"></i>
        </a>
        <form method="POST"
            action="{{ route('admin.customers.profile.certification.destroy', [$customer->id, $item->id]) }}"
            onsubmit="return confirm('Delete this certification?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger" title="Delete">
                <i class="fas fa-trash fs-7"></i>
            </button>
        </form>
    </div>
</div>
