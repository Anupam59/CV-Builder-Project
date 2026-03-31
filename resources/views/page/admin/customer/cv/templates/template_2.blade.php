{{-- Template 2: Classic Professional (Top-to-Bottom) --}}
@php
    $s = $s ?? [];
    $isBn = $isBn ?? false;
    $name = $s['name'] ?? '';
    $d = $s['detail'] ?? [];
@endphp

<div
    style="font-family: Georgia, serif; background: #fff; padding: 40px; max-width: 800px; margin: 0 auto; border: 1px solid #e5e7eb;">

    {{-- Header --}}
    <div style="text-align: center; border-bottom: 3px double #b45309; padding-bottom: 20px; margin-bottom: 24px;">
        <div style="font-size: 28px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #1c1917;">
            {{ $name }}</div>
        @if ($d['profession'] ?? null)
            <div style="font-size: 14px; color: #b45309; margin-top: 4px; letter-spacing: 1px;">{{ $d['profession'] }}
            </div>
        @endif
        <div style="font-size: 12px; color: #6b7280; margin-top: 8px;">
            {{ $s['phone'] ?? '' }}
            @if (($s['phone'] ?? null) && ($s['email'] ?? null))
                &nbsp;|&nbsp;
            @endif
            {{ $s['email'] ?? '' }}
            @if ($s['address'] ?? null)
                &nbsp;|&nbsp; {{ $s['address'] }}
            @endif
        </div>
        @if (($d['linkedin'] ?? null) || ($d['github'] ?? null) || ($d['website'] ?? null))
            <div style="font-size: 11px; color: #9ca3af; margin-top: 4px;">
                @if ($d['website'] ?? null)
                    {{ $d['website'] }}
                @endif
                @if ($d['linkedin'] ?? null)
                    &nbsp;|&nbsp; {{ $d['linkedin'] }}
                @endif
                @if ($d['github'] ?? null)
                    &nbsp;|&nbsp; {{ $d['github'] }}
                @endif
            </div>
        @endif
    </div>

    {{-- Profile Summary --}}
    @if ($d['profile_summary'] ?? null)
        <div style="margin-bottom: 20px;">
            <div
                style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                {{ $isBn ? 'উদ্দেশ্য' : 'Objective' }}
            </div>
            <p style="font-size: 13px; color: #374151; line-height: 1.7; text-align: justify;">
                {{ $d['profile_summary'] }}</p>
        </div>
    @endif

    {{-- Personal Details Table --}}
    @if ($d)
        @php
            $personalData = array_filter([
                $isBn ? 'বাবার নাম' : "Father's Name" => $d['father_name'] ?? null,
                $isBn ? 'মায়ের নাম' : "Mother's Name" => $d['mother_name'] ?? null,
                $isBn ? 'জন্ম তারিখ' : 'Date of Birth' => $d['date_of_birth'] ?? null,
                $isBn ? 'জাতীয়তা' : 'Nationality' => $d['nationality'] ?? null,
                $isBn ? 'ধর্ম' : 'Religion' => $d['religion'] ?? null,
                $isBn ? 'লিঙ্গ' : 'Gender' => isset($d['gender']) ? ucfirst($d['gender']) : null,
                $isBn ? 'বৈবাহিক অবস্থা' : 'Marital Status' => isset($d['marital_status'])
                    ? ucfirst($d['marital_status'])
                    : null,
                $isBn ? 'এনআইডি' : 'NID' => $d['nid_number'] ?? null,
            ]);
        @endphp
        @if ($personalData)
            <div style="margin-bottom: 20px;">
                <div
                    style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                    {{ $isBn ? 'ব্যক্তিগত তথ্য' : 'Personal Information' }}
                </div>
                <table style="width: 100%; border-collapse: collapse;">
                    @foreach (array_chunk($personalData, 2, true) as $row)
                        <tr>
                            @foreach ($row as $lbl => $val)
                                <td
                                    style="width: 25%; font-size: 12px; font-weight: 700; color: #6b7280; padding: 3px 8px 3px 0;">
                                    {{ $lbl }}</td>
                                <td style="width: 25%; font-size: 12px; color: #1c1917; padding: 3px 16px 3px 0;">:
                                    {{ $val }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
    @endif

    {{-- Education --}}
    @if (!empty($s['educations']))
        <div style="margin-bottom: 20px;">
            <div
                style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                {{ $isBn ? 'শিক্ষাগত যোগ্যতা' : 'Educational Qualification' }}
            </div>
            <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                <thead>
                    <tr style="background: #fff7ed;">
                        <th style="text-align: left; padding: 6px 8px; border: 1px solid #fed7aa; color: #92400e;">
                            {{ $isBn ? 'ডিগ্রি' : 'Degree' }}</th>
                        <th style="text-align: left; padding: 6px 8px; border: 1px solid #fed7aa; color: #92400e;">
                            {{ $isBn ? 'প্রতিষ্ঠান' : 'Institute' }}</th>
                        <th style="text-align: left; padding: 6px 8px; border: 1px solid #fed7aa; color: #92400e;">
                            {{ $isBn ? 'ফলাফল' : 'Result' }}</th>
                        <th style="text-align: left; padding: 6px 8px; border: 1px solid #fed7aa; color: #92400e;">
                            {{ $isBn ? 'সাল' : 'Year' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($s['educations'] as $edu)
                        <tr>
                            <td style="padding: 6px 8px; border: 1px solid #fde8c8; color: #1c1917;">
                                {{ $edu['degree'] }}@if ($edu['field_of_study'] ?? null)
                                    <br><span
                                        style="color: #6b7280; font-size: 11px;">{{ $edu['field_of_study'] }}</span>
                                @endif
                            </td>
                            <td style="padding: 6px 8px; border: 1px solid #fde8c8; color: #374151;">
                                {{ $edu['institute'] }}</td>
                            <td style="padding: 6px 8px; border: 1px solid #fde8c8; color: #374151;">
                                {{ $edu['result'] ?? '—' }}</td>
                            <td style="padding: 6px 8px; border: 1px solid #fde8c8; color: #374151;">
                                {{ $edu['end_year'] ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Experience --}}
    @if (!empty($s['experiences']))
        <div style="margin-bottom: 20px;">
            <div
                style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                {{ $isBn ? 'কর্মঅভিজ্ঞতা' : 'Work Experience' }}
            </div>
            @foreach ($s['experiences'] as $exp)
                <div style="margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="font-weight: 700; font-size: 13px; color: #1c1917;">{{ $exp['job_title'] }},
                            {{ $exp['company_name'] }}</span>
                        <span
                            style="font-size: 11px; color: #6b7280; font-style: italic;">{{ $exp['start_date'] ?? '' }}{{ $exp['start_date'] ?? null ? ' – ' : '' }}{{ $exp['end_date'] ?? '' }}</span>
                    </div>
                    @if ($exp['description'] ?? null)
                        <p style="font-size: 12px; color: #4b5563; margin-top: 4px; line-height: 1.6;">
                            {{ $exp['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- Skills & Languages in 2 columns --}}
    @if (!empty($s['skills']) || !empty($s['languages']))
        <div style="display: flex; gap: 24px; margin-bottom: 20px;">
            @if (!empty($s['skills']))
                <div style="flex: 1;">
                    <div
                        style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                        {{ $isBn ? 'দক্ষতা' : 'Skills' }}
                    </div>
                    @foreach ($s['skills'] as $skill)
                        <div style="font-size: 12px; color: #374151; padding: 2px 0;">
                            • {{ $skill['name'] }}@if ($skill['level'] ?? null)
                                <span style="color: #b45309;">({{ ucfirst($skill['level']) }})</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            @if (!empty($s['languages']))
                <div style="flex: 1;">
                    <div
                        style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                        {{ $isBn ? 'ভাষা' : 'Languages' }}
                    </div>
                    @foreach ($s['languages'] as $lang)
                        <div style="font-size: 12px; color: #374151; padding: 2px 0;">
                            • {{ $lang['name'] }}@if ($lang['proficiency'] ?? null)
                                <span style="color: #b45309;">({{ ucfirst($lang['proficiency']) }})</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Certifications --}}
    @if (!empty($s['certifications']))
        <div style="margin-bottom: 20px;">
            <div
                style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: #b45309; margin-bottom: 8px; border-bottom: 1px solid #fed7aa; padding-bottom: 4px;">
                {{ $isBn ? 'সার্টিফিকেট' : 'Certifications' }}
            </div>
            @foreach ($s['certifications'] as $cert)
                <div style="font-size: 12px; color: #374151; margin-bottom: 4px;">
                    • <strong>{{ $cert['title'] }}</strong>
                    @if ($cert['organization'] ?? null)
                        — {{ $cert['organization'] }}
                    @endif
                    @if ($cert['issue_date'] ?? null)
                        ({{ $cert['issue_date'] }})
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</div>
