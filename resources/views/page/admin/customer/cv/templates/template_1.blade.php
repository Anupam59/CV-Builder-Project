{{--
    Template 1: Modern Clean (Sidebar Layout)
    Variable: $s = snapshot array, $isBn = boolean
--}}
@php
    $s = $s ?? [];
    $isBn = $isBn ?? false;
    $name = $s['name'] ?? '';
    $d = $s['detail'] ?? [];
@endphp

<div
    style="font-family: 'Segoe UI', sans-serif; display: flex; min-height: 900px; background: #fff; border: 1px solid #e5e7eb;">
    {{-- Sidebar --}}
    <div style="width: 280px; min-width: 280px; background: #1e3a5f; color: #fff; padding: 32px 24px;">

        {{-- Avatar Initial --}}
        <div
            style="width: 80px; height: 80px; border-radius: 50%; background: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin-bottom: 16px;">
            {{ strtoupper(substr($name, 0, 1)) }}
        </div>

        <div style="font-size: 22px; font-weight: 700; margin-bottom: 4px;">{{ $name }}</div>
        <div style="font-size: 13px; color: #93c5fd; margin-bottom: 24px;">{{ $d['profession'] ?? '' }}</div>

        {{-- Contact --}}
        <div style="margin-bottom: 24px;">
            <div
                style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #93c5fd; margin-bottom: 10px; border-bottom: 1px solid #2d5a8e; padding-bottom: 6px;">
                {{ $isBn ? 'যোগাযোগ' : 'Contact' }}
            </div>
            @if ($s['phone'] ?? null)
                <div style="font-size: 12px; margin-bottom: 6px;">📞 {{ $s['phone'] }}</div>
            @endif
            @if ($s['email'] ?? null)
                <div style="font-size: 12px; margin-bottom: 6px;">✉ {{ $s['email'] }}</div>
            @endif
            @if ($s['address'] ?? null)
                <div style="font-size: 12px; margin-bottom: 6px;">📍 {{ $s['address'] }}</div>
            @endif
            @if ($d['website'] ?? null)
                <div style="font-size: 12px; margin-bottom: 6px;">🌐 {{ $d['website'] }}</div>
            @endif
            @if ($d['linkedin'] ?? null)
                <div style="font-size: 12px; margin-bottom: 6px;">in {{ $d['linkedin'] }}</div>
            @endif
        </div>

        {{-- Personal Info --}}
        @if ($d)
            <div style="margin-bottom: 24px;">
                <div
                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #93c5fd; margin-bottom: 10px; border-bottom: 1px solid #2d5a8e; padding-bottom: 6px;">
                    {{ $isBn ? 'ব্যক্তিগত তথ্য' : 'Personal' }}
                </div>
                @foreach ([
        $isBn ? 'জন্ম তারিখ' : 'DOB' => $d['date_of_birth'] ?? null,
        $isBn ? 'জাতীয়তা' : 'Nationality' => $d['nationality'] ?? null,
        $isBn ? 'ধর্ম' : 'Religion' => $d['religion'] ?? null,
        $isBn ? 'লিঙ্গ' : 'Gender' => isset($d['gender']) ? ucfirst($d['gender']) : null,
        $isBn ? 'বৈবাহিক অবস্থা' : 'Marital' => isset($d['marital_status']) ? ucfirst($d['marital_status']) : null,
        $isBn ? 'বাবার নাম' : 'Father' => $d['father_name'] ?? null,
        $isBn ? 'মায়ের নাম' : 'Mother' => $d['mother_name'] ?? null,
    ] as $lbl => $val)
                    @if ($val)
                        <div style="font-size: 11px; margin-bottom: 5px; color: #cbd5e1;">
                            <span style="color: #93c5fd;">{{ $lbl }}:</span> {{ $val }}
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Skills --}}
        @if (!empty($s['skills']))
            <div style="margin-bottom: 24px;">
                <div
                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #93c5fd; margin-bottom: 10px; border-bottom: 1px solid #2d5a8e; padding-bottom: 6px;">
                    {{ $isBn ? 'দক্ষতা' : 'Skills' }}
                </div>
                @foreach ($s['skills'] as $skill)
                    <div style="margin-bottom: 6px;">
                        <div style="font-size: 12px; color: #e2e8f0; margin-bottom: 3px;">{{ $skill['name'] }}</div>
                        @php $lvl = ['beginner'=>33,'intermediate'=>66,'expert'=>100][$skill['level'] ?? ''] ?? 0; @endphp
                        @if ($lvl)
                            <div style="background: #2d5a8e; border-radius: 4px; height: 4px;">
                                <div
                                    style="background: #3b82f6; width: {{ $lvl }}%; height: 4px; border-radius: 4px;">
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Languages --}}
        @if (!empty($s['languages']))
            <div>
                <div
                    style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #93c5fd; margin-bottom: 10px; border-bottom: 1px solid #2d5a8e; padding-bottom: 6px;">
                    {{ $isBn ? 'ভাষা' : 'Languages' }}
                </div>
                @foreach ($s['languages'] as $lang)
                    <div style="font-size: 12px; color: #cbd5e1; margin-bottom: 4px;">
                        {{ $lang['name'] }} @if ($lang['proficiency'])
                            <span style="color: #93c5fd;">({{ ucfirst($lang['proficiency']) }})</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- Main Content --}}
    <div style="flex: 1; padding: 32px 28px;">

        {{-- Profile Summary --}}
        @if ($d['profile_summary'] ?? null)
            <div
                style="margin-bottom: 24px; padding: 16px; background: #f0f4ff; border-left: 4px solid #3b5bdb; border-radius: 4px;">
                <div
                    style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #3b5bdb; margin-bottom: 6px;">
                    {{ $isBn ? 'সারাংশ' : 'Profile Summary' }}
                </div>
                <div style="font-size: 13px; color: #374151; line-height: 1.6;">{{ $d['profile_summary'] }}</div>
            </div>
        @endif

        {{-- Experience --}}
        @if (!empty($s['experiences']))
            <div style="margin-bottom: 24px;">
                <div
                    style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #1e3a5f; border-bottom: 2px solid #3b5bdb; padding-bottom: 6px; margin-bottom: 14px;">
                    {{ $isBn ? 'কর্মঅভিজ্ঞতা' : 'Experience' }}
                </div>
                @foreach ($s['experiences'] as $exp)
                    <div style="margin-bottom: 14px; padding-left: 12px; border-left: 2px solid #dbeafe;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 2px;">
                            <span
                                style="font-weight: 700; font-size: 14px; color: #111;">{{ $exp['job_title'] }}</span>
                            <span
                                style="font-size: 11px; color: #6b7280;">{{ $exp['start_date'] ?? '' }}{{ $exp['start_date'] ?? null ? ' – ' : '' }}{{ $exp['end_date'] ?? '' }}</span>
                        </div>
                        <div style="font-size: 13px; color: #3b5bdb; margin-bottom: 4px;">{{ $exp['company_name'] }}
                        </div>
                        @if ($exp['description'] ?? null)
                            <div style="font-size: 12px; color: #6b7280; line-height: 1.5;">{{ $exp['description'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Education --}}
        @if (!empty($s['educations']))
            <div style="margin-bottom: 24px;">
                <div
                    style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #1e3a5f; border-bottom: 2px solid #3b5bdb; padding-bottom: 6px; margin-bottom: 14px;">
                    {{ $isBn ? 'শিক্ষা' : 'Education' }}
                </div>
                @foreach ($s['educations'] as $edu)
                    <div style="margin-bottom: 12px; padding-left: 12px; border-left: 2px solid #dbeafe;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 2px;">
                            <span style="font-weight: 700; font-size: 14px; color: #111;">{{ $edu['degree'] }}
                                @if ($edu['field_of_study'] ?? null)
                                    <span style="font-weight: 400; color: #6b7280;"> in
                                        {{ $edu['field_of_study'] }}</span>
                                @endif
                            </span>
                            <span
                                style="font-size: 11px; color: #6b7280;">{{ $edu['start_year'] ?? '' }}{{ $edu['start_year'] ?? null ? ' – ' : '' }}{{ $edu['end_year'] ?? '' }}</span>
                        </div>
                        <div style="font-size: 13px; color: #3b5bdb; margin-bottom: 2px;">{{ $edu['institute'] }}</div>
                        @if ($edu['result'] ?? null)
                            <div style="font-size: 12px; color: #6b7280;">Result: {{ $edu['result'] }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Projects --}}
        @if (!empty($s['projects']))
            <div style="margin-bottom: 24px;">
                <div
                    style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #1e3a5f; border-bottom: 2px solid #3b5bdb; padding-bottom: 6px; margin-bottom: 14px;">
                    {{ $isBn ? 'প্রকল্পসমূহ' : 'Projects' }}
                </div>
                @foreach ($s['projects'] as $proj)
                    <div style="margin-bottom: 12px; padding-left: 12px; border-left: 2px solid #dbeafe;">
                        <div style="font-weight: 700; font-size: 14px; color: #111; margin-bottom: 2px;">
                            {{ $proj['title'] }}
                            @if ($proj['project_url'] ?? null)
                                <a href="{{ $proj['project_url'] }}"
                                    style="font-size: 11px; color: #3b5bdb; margin-left: 6px;">🔗</a>
                            @endif
                        </div>
                        @if ($proj['technologies'] ?? null)
                            <div style="font-size: 12px; color: #6b7280; margin-bottom: 2px;">
                                {{ $proj['technologies'] }}</div>
                        @endif
                        @if ($proj['description'] ?? null)
                            <div style="font-size: 12px; color: #6b7280; line-height: 1.5;">{{ $proj['description'] }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Certifications --}}
        @if (!empty($s['certifications']))
            <div>
                <div
                    style="font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #1e3a5f; border-bottom: 2px solid #3b5bdb; padding-bottom: 6px; margin-bottom: 14px;">
                    {{ $isBn ? 'সার্টিফিকেট' : 'Certifications' }}
                </div>
                @foreach ($s['certifications'] as $cert)
                    <div style="margin-bottom: 8px; padding-left: 12px; border-left: 2px solid #dbeafe;">
                        <span style="font-weight: 700; font-size: 13px; color: #111;">{{ $cert['title'] }}</span>
                        @if ($cert['organization'] ?? null)
                            <span style="font-size: 12px; color: #6b7280;"> · {{ $cert['organization'] }}</span>
                        @endif
                        @if ($cert['issue_date'] ?? null)
                            <span style="font-size: 11px; color: #9ca3af;"> · {{ $cert['issue_date'] }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
