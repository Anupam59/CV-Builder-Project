@extends('layout.admin.adminLayout')

@section('page_title', 'CV Preview')
@section('page_subtitle', $cv->title ?? 'CV')

@push('toolbar_actions')
    <a href="{{ route('admin.customers.show', $cv->customer_id) }}" class="btn btn-sm btn-light">← Back</a>
@endpush

@section('content')
    @php
        $s = $cv->snapshot;
        $isBn = $s['language'] === 'bn';
    @endphp

    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header pt-6">
                    <div class="card-title">
                        <div>
                            <h2 class="mb-1">{{ $cv->title }}</h2>
                            <span class="badge badge-light-{{ $isBn ? 'warning' : 'info' }} fs-8">
                                {{ $isBn ? 'বাংলা' : 'English' }} CV
                            </span>
                            <span class="text-muted fs-8 ms-3">
                                Created: {{ $cv->created_at->format('d M Y, h:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <form method="POST" action="{{ route('admin.cvs.destroy', $cv->id) }}"
                            onsubmit="return confirm('Delete this CV?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light-danger">Delete CV</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">

                    {{-- Personal Info --}}
                    <div class="text-center mb-8">
                        <h3 class="fs-2 fw-bolder mb-1">{{ $s['name'] }}</h3>
                        @if ($s['detail']['profession'] ?? null)
                            <div class="text-muted fs-6 mb-2">{{ $s['detail']['profession'] }}</div>
                        @endif
                        <div class="text-muted fs-7">
                            {{ $s['phone'] }}
                            @if ($s['email'])
                                · {{ $s['email'] }}
                            @endif
                            @if ($s['address'])
                                · {{ $s['address'] }}
                            @endif
                        </div>
                        @if (($s['detail']['website'] ?? null) || ($s['detail']['linkedin'] ?? null) || ($s['detail']['github'] ?? null))
                            <div class="text-muted fs-8 mt-1">
                                @if ($s['detail']['website'] ?? null)
                                    <a href="{{ $s['detail']['website'] }}" class="me-3">🌐 Website</a>
                                @endif
                                @if ($s['detail']['linkedin'] ?? null)
                                    <a href="{{ $s['detail']['linkedin'] }}" class="me-3">LinkedIn</a>
                                @endif
                                @if ($s['detail']['github'] ?? null)
                                    <a href="{{ $s['detail']['github'] }}">GitHub</a>
                                @endif
                            </div>
                        @endif
                    </div>

                    {{-- Profile Summary --}}
                    @if ($s['detail']['profile_summary'] ?? null)
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-3">
                                {{ $isBn ? 'প্রোফাইল সারাংশ' : 'Profile Summary' }}
                            </div>
                            <p class="text-dark fs-7">{{ $s['detail']['profile_summary'] }}</p>
                        </div>
                    @endif

                    {{-- Personal Details --}}
                    @if ($s['detail'] ?? null)
                        @php
                            $personalFields = array_filter([
                                $isBn ? 'বাবার নাম' : "Father's Name" => $s['detail']['father_name'] ?? null,
                                $isBn ? 'মায়ের নাম' : "Mother's Name" => $s['detail']['mother_name'] ?? null,
                                $isBn ? 'জন্ম তারিখ' : 'Date of Birth' => $s['detail']['date_of_birth'] ?? null,
                                $isBn ? 'লিঙ্গ' : 'Gender' => $s['detail']['gender']
                                    ? ucfirst($s['detail']['gender'])
                                    : null,
                                $isBn ? 'বৈবাহিক অবস্থা' : 'Marital Status' => $s['detail']['marital_status']
                                    ? ucfirst($s['detail']['marital_status'])
                                    : null,
                                $isBn ? 'জাতীয়তা' : 'Nationality' => $s['detail']['nationality'] ?? null,
                                $isBn ? 'ধর্ম' : 'Religion' => $s['detail']['religion'] ?? null,
                                $isBn ? 'এনআইডি' : 'NID' => $s['detail']['nid_number'] ?? null,
                            ]);
                        @endphp
                        @if ($personalFields)
                            <div class="mb-7">
                                <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-3">
                                    {{ $isBn ? 'ব্যক্তিগত তথ্য' : 'Personal Details' }}
                                </div>
                                <div class="row g-3">
                                    @foreach ($personalFields as $label => $value)
                                        <div class="col-sm-6">
                                            <span class="text-muted fs-8">{{ $label }}: </span>
                                            <span class="text-dark fw-bold fs-7">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Education --}}
                    @if (!empty($s['educations']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-4">
                                {{ $isBn ? 'শিক্ষাগত যোগ্যতা' : 'Education' }}
                            </div>
                            @foreach ($s['educations'] as $edu)
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fw-bold text-dark fs-6">{{ $edu['degree'] }}</span>
                                            @if ($edu['field_of_study'])
                                                <span class="text-muted fs-7"> in {{ $edu['field_of_study'] }}</span>
                                            @endif
                                        </div>
                                        <div class="text-muted fs-8">
                                            {{ $edu['start_year'] ?? '' }} @if ($edu['start_year'] || $edu['end_year'])
                                                –
                                            @endif {{ $edu['end_year'] ?? '' }}
                                        </div>
                                    </div>
                                    <div class="text-primary fs-7">{{ $edu['institute'] }}</div>
                                    @if ($edu['result'])
                                        <div class="text-muted fs-8">Result: {{ $edu['result'] }}</div>
                                    @endif
                                    @if ($edu['description'])
                                        <div class="text-muted fs-8 mt-1">{{ $edu['description'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Experience --}}
                    @if (!empty($s['experiences']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-4">
                                {{ $isBn ? 'কর্মঅভিজ্ঞতা' : 'Experience' }}
                            </div>
                            @foreach ($s['experiences'] as $exp)
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="fw-bold text-dark fs-6">{{ $exp['job_title'] }}</span>
                                            <span class="text-muted fs-7"> · {{ $exp['company_name'] }}</span>
                                        </div>
                                        <div class="text-muted fs-8">
                                            {{ $exp['start_date'] ?? '' }} @if ($exp['start_date'])
                                                –
                                            @endif {{ $exp['end_date'] ?? '' }}
                                        </div>
                                    </div>
                                    @if ($exp['employment_type'])
                                        <div class="text-muted fs-8">{{ ucfirst($exp['employment_type']) }}</div>
                                    @endif
                                    @if ($exp['description'])
                                        <div class="text-muted fs-8 mt-1">{{ $exp['description'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Skills --}}
                    @if (!empty($s['skills']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-3">
                                {{ $isBn ? 'দক্ষতা' : 'Skills' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($s['skills'] as $skill)
                                    <span class="badge badge-light-primary fs-8 px-3 py-2">
                                        {{ $skill['name'] }}
                                        @if ($skill['level'])
                                            <span class="ms-1 opacity-75">({{ ucfirst($skill['level']) }})</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Languages --}}
                    @if (!empty($s['languages']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-3">
                                {{ $isBn ? 'ভাষা' : 'Languages' }}
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($s['languages'] as $lang)
                                    <span class="badge badge-light-info fs-8 px-3 py-2">
                                        {{ $lang['name'] }}
                                        @if ($lang['proficiency'])
                                            <span class="ms-1 opacity-75">({{ ucfirst($lang['proficiency']) }})</span>
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Projects --}}
                    @if (!empty($s['projects']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-4">
                                {{ $isBn ? 'প্রকল্পসমূহ' : 'Projects' }}
                            </div>
                            @foreach ($s['projects'] as $project)
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark fs-6">{{ $project['title'] }}</span>
                                        @if ($project['project_url'])
                                            <a href="{{ $project['project_url'] }}" target="_blank"
                                                class="text-primary fs-8">Link</a>
                                        @endif
                                    </div>
                                    @if ($project['role'])
                                        <div class="text-muted fs-7">{{ $project['role'] }}</div>
                                    @endif
                                    @if ($project['technologies'])
                                        <div class="text-muted fs-8">{{ $project['technologies'] }}</div>
                                    @endif
                                    @if ($project['description'])
                                        <div class="text-muted fs-8 mt-1">{{ $project['description'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Certifications --}}
                    @if (!empty($s['certifications']))
                        <div class="mb-7">
                            <div class="fw-bolder text-dark fs-6 border-bottom pb-2 mb-4">
                                {{ $isBn ? 'সার্টিফিকেট' : 'Certifications' }}
                            </div>
                            @foreach ($s['certifications'] as $cert)
                                <div class="mb-3">
                                    <span class="fw-bold text-dark fs-7">{{ $cert['title'] }}</span>
                                    @if ($cert['organization'])
                                        <span class="text-muted fs-8"> · {{ $cert['organization'] }}</span>
                                    @endif
                                    @if ($cert['issue_date'])
                                        <span class="text-muted fs-8"> · {{ $cert['issue_date'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
