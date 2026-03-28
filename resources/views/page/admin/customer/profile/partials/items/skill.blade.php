<div class="d-flex align-items-center justify-content-between p-3 mb-2 bg-light rounded">
    <div class="d-flex align-items-center gap-3">
        <span class="text-dark fw-bold fs-6">{{ $item->name }}</span>
        @if ($item->level)
            @php $levelColors = ['beginner'=>'info','intermediate'=>'warning','expert'=>'success']; @endphp
            <span class="badge badge-light-{{ $levelColors[$item->level] ?? 'secondary' }} fs-9">
                {{ ucfirst($item->level) }}
            </span>
        @endif
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.customers.profile.skill.edit', [$customer->id, $item->id]) }}"
            class="btn btn-sm btn-icon btn-light btn-active-color-primary" title="Edit">
            <i class="fas fa-pen fs-7"></i>
        </a>
        <form method="POST" action="{{ route('admin.customers.profile.skill.destroy', [$customer->id, $item->id]) }}"
            onsubmit="return confirm('Delete this skill?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-icon btn-light btn-active-color-danger" title="Delete">
                <i class="fas fa-trash fs-7"></i>
            </button>
        </form>
    </div>
</div>
