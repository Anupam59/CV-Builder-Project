{{--
    Reusable section partial
    Variables: $title, $icon, $color, $createRoute, $items, $empty, $template, $customer
--}}
<div class="card">
    <div class="card-header pt-6 pb-4">
        <div class="card-title">
            <i class="{{ $icon }} text-{{ $color }} me-2 fs-4"></i>
            <h3 class="mb-0">{{ $title }}</h3>
            <span class="badge badge-light-{{ $color }} ms-3">{{ $items->count() }}</span>
        </div>
        <div class="card-toolbar">
            <a href="{{ $createRoute }}" class="btn btn-sm btn-light-{{ $color }}">
                + Add {{ rtrim($title, 's') }}
            </a>
        </div>
    </div>
    <div class="card-body pt-4">
        @if ($items->isEmpty())
            <div class="text-center text-muted py-8">
                <i class="{{ $icon }} fs-3x opacity-25 d-block mb-3"></i>
                {{ $empty }}
            </div>
        @else
            @foreach ($items as $item)
                @include('page.admin.customer.profile.partials.items.' . $template, [
                    'item' => $item,
                    'customer' => $customer,
                ])
            @endforeach
        @endif
    </div>
</div>
