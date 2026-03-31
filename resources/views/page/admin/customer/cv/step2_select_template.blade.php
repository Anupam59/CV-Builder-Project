@extends('layout.admin.adminLayout')
@section('page_title', 'Create CV')
@section('page_subtitle', 'Step 2: Choose Template')

@section('content')
<div class="row g-6">

    {{-- Left: Template Selector --}}
    <div class="col-xl-4">

        {{-- Step Indicator --}}
        <div class="d-flex flex-column gap-3 mb-6">
            <div class="d-flex align-items-center gap-3">
                <span class="w-30px h-30px rounded-circle bg-success d-flex align-items-center justify-content-center text-white fw-bolder fs-8">✓</span>
                <span class="text-muted fs-7">Customer Selected: <strong class="text-dark">{{ $customer->name }}</strong></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="w-30px h-30px rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">2</span>
                <span class="fw-bold text-primary">Choose Template</span>
            </div>
            <div class="d-flex align-items-center gap-3 opacity-50">
                <span class="w-30px h-30px rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white fw-bolder fs-8">3</span>
                <span class="text-muted">Review & Save</span>
            </div>
        </div>

        <div class="card card-flush">
            <div class="card-header pt-6">
                <div class="card-title"><h3>Select Template</h3></div>
            </div>
            <div class="card-body pt-4">

                {{-- Language Select --}}
                <div class="mb-6">
                    <label class="form-label fw-bold">CV Language</label>
                    <div class="d-flex gap-3">
                        <label class="cursor-pointer flex-grow-1">
                            <input type="radio" name="lang_select" value="en" class="d-none lang-radio"
                                {{ $language === 'en' ? 'checked' : '' }}>
                            <div class="lang-card border rounded p-3 text-center {{ $language === 'en' ? 'border-primary bg-light-primary' : '' }}">
                                <div class="fw-bold fs-7">English</div>
                            </div>
                        </label>
                        <label class="cursor-pointer flex-grow-1">
                            <input type="radio" name="lang_select" value="bn" class="d-none lang-radio"
                                {{ $language === 'bn' ? 'checked' : '' }}>
                            <div class="lang-card border rounded p-3 text-center {{ $language === 'bn' ? 'border-primary bg-light-primary' : '' }}">
                                <div class="fw-bold fs-7">বাংলা</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Template Cards --}}
                @foreach($templates as $key => $tpl)
                    <div class="template-option mb-3 cursor-pointer" data-template="{{ $key }}">
                        <div class="border rounded p-4 d-flex align-items-center gap-4
                            {{ $selected === $key ? 'border-primary bg-light-primary' : 'border-gray-200' }}"
                            style="transition: all 0.2s">
                            <div class="w-40px h-50px rounded flex-shrink-0 d-flex align-items-center justify-content-center"
                                style="background: {{ $tpl['preview_bg'] }}; border: 2px solid {{ $tpl['accent'] }}">
                                <div style="width:20px; height:4px; background:{{ $tpl['accent'] }}; border-radius:2px"></div>
                            </div>
                            <div>
                                <div class="fw-bolder fs-7 text-dark">{{ $tpl['name'] }}</div>
                                <div class="text-muted fs-8">{{ $tpl['description'] }}</div>
                            </div>
                            @if($selected === $key)
                                <span class="ms-auto badge badge-primary">Selected</span>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- Go to Step 3 --}}
                <form method="GET" action="{{ route('admin.cvs.step3') }}" id="step2Form" class="mt-6">
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <input type="hidden" name="template_name" id="selectedTemplate" value="{{ $selected }}">
                    <input type="hidden" name="language" id="selectedLanguage" value="{{ $language }}">
                    <button type="submit" class="btn btn-primary w-100">
                        Next: Review Data →
                    </button>
                </form>
                <a href="{{ route('admin.cvs.step1') }}" class="btn btn-light w-100 mt-2">← Back</a>

            </div>
        </div>
    </div>

    {{-- Right: Live Preview --}}
    <div class="col-xl-8">
        <div class="card card-flush" style="min-height: 600px;">
            <div class="card-header pt-6">
                <div class="card-title">
                    <h3>Live Preview</h3>
                    <span class="badge badge-light-primary ms-3" id="previewTemplateName">
                        {{ $templates[$selected]['name'] }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0" id="previewContainer">
                <div class="p-4" style="transform-origin: top left; transform: scale(0.75); width: 133%;">
                    @include('page.admin.customer.cv.templates.' . $selected, ['s' => $preview, 'isBn' => $language === 'bn'])
                </div>
            </div>
        </div>
    </div>

</div>

<script>
const templates = @json($templates);
const preview   = @json($preview);
let currentLang = '{{ $language }}';

// Template click
document.querySelectorAll('.template-option').forEach(el => {
    el.addEventListener('click', function () {
        const tpl = this.dataset.template;
        document.getElementById('selectedTemplate').value = tpl;
        document.querySelectorAll('.template-option > div').forEach(d => {
            d.classList.remove('border-primary', 'bg-light-primary');
            d.classList.add('border-gray-200');
            d.querySelector('.badge')?.remove();
        });
        const card = this.querySelector('div');
        card.classList.add('border-primary', 'bg-light-primary');
        card.classList.remove('border-gray-200');

        // Update preview badge
        document.getElementById('previewTemplateName').textContent = templates[tpl].name;

        // Reload preview via AJAX
        loadPreview(tpl, currentLang);
    });
});

// Language click
document.querySelectorAll('.lang-radio').forEach(radio => {
    radio.addEventListener('change', function () {
        currentLang = this.value;
        document.getElementById('selectedLanguage').value = currentLang;
        document.querySelectorAll('.lang-card').forEach(c => {
            c.classList.remove('border-primary', 'bg-light-primary');
        });
        this.nextElementSibling.classList.add('border-primary', 'bg-light-primary');

        const tpl = document.getElementById('selectedTemplate').value;
        loadPreview(tpl, currentLang);
    });
});

function loadPreview(template, lang) {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '<div class="d-flex align-items-center justify-content-center" style="height:400px"><div class="spinner-border text-primary"></div></div>';

    fetch(`{{ route('admin.cvs.preview') }}?customer_id={{ $customer->id }}&template_name=${template}&language=${lang}`)
        .then(r => r.text())
        .then(html => {
            container.innerHTML = `<div class="p-4" style="transform-origin:top left;transform:scale(0.75);width:133%">${html}</div>`;
        })
        .catch(() => {
            container.innerHTML = '<div class="text-center text-muted p-10">Preview failed. Please try again.</div>';
        });
}
</script>
@endsection
