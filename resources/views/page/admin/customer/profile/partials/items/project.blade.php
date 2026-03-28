<div class="d-flex align-items-start justify-content-between p-4 mb-3 bg-light rounded">
    <div class="flex-grow-1">
        <div class="d-flex align-items-center gap-3 mb-1">
            <span class="text-dark fw-bolder fs-6">{{ $item->title }}</span>
            @if ($item->project_url)
                <a href="{{ $item->project_url }}" target="_blank" class="text-primary fs-8">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            @endif
        </div>
        @if ($item->role)
            <div class="text-danger fw-bold fs-7 mb-1">{{ $item->role }}</div>
        @endif
        @if ($item->technologies)
            <div class="text-muted fs-8 mb-1">
                <i class="fas fa-code me-1"></i>{{ $item->technologies }}
            </div>
        @endif
        @if ($item->description)
            <p class="text-muted fs-8 mt-2 mb-0">{{ $item->description }}</p>
        @endif
    </div>
    <div class="d-flex gap-2 ms-4 flex-shrink-0">
        <a href="{{ route('admin.customers.profile.project.edit', [$customer->id, $item->id]) }}"
            class="btn btn-sm btn-icon btn-light btn-active-color-primary" title="Edit">
            <i class="fas fa-pen fs-7"></i>
        </a>
        <form method="POST" action="{{ route('admin.customers.profile.project.destroy', [$customer->id, $item->id]) }}"
            onsubmit="return confirm('Delete this project?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger" title="Delete">
                <i class="fas fa-trash fs-7"></i>
            </button>
        </form>
    </div>
</div>
