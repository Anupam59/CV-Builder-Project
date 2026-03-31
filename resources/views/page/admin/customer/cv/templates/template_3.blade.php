{{-- Template 3: Creative Bold --}}
@php
    $s = $s ?? [];
    $isBn = $isBn ?? false;
    $name = $s['name'] ?? '';
    $d = $s['detail'] ?? [];
@endphp

<div style="font-family: 'Segoe UI', sans-serif; background: #fff; border: 1px solid #e5e7eb;">

    {{-- Top Banner --}}
    <div
        style="background: linear-gradient(135deg, #166534 0%, #15803d 50%, #16a34a 100%); padding: 32px 36px; position: relative;">
        <div style="display: flex; align-items: flex-end; gap: 20px;">
            <div
                style="width: 90px; height: 90px; border-radius: 12px; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 900; color: #fff; border: 3px solid rgba(255,255,255,0.5); flex-shrink: 0;">
                {{ strtoupper(substr($name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size: 30px; font-weight: 900; color: #fff; letter-spacing: -0.5px; line-height: 1;">
                    {{ $name }}</div>
                @if ($d['profession'] ?? null)
                    <div style="font-size: 14px; color: #bbf7d0; margin-top: 4px; font-weight: 500;">
                        {{ $d['profession'] }}</div>
                @endif
                <div
                    style="font-size: 12px; color: #86efac; margin-top: 6px; display: flex; gap: 12px; flex-wrap: wrap;">
                    @if ($s['phone'] ?? null)
                        <span>📞 {{ $s['phone'] }}</span>
                    @endif
                    @if ($s['email'] ?? null)
                        <span>✉ {{ $s['email'] }}</span>
                    @endif
                    @if ($s['address'] ?? null)
                        <span>📍 {{ $s['address'] }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 0;">

        {{-- Left Column --}}
        <div
            style="width: 260px; min-width: 260px; padding: 24px 20px; background: #f0fdf4; border-right: 1px solid #dcfce7;">

            {{-- Personal --}}
            @if ($d)
                <div style="margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; gap-6px; margin-bottom: 12px;">
                        <span
                            style="display: inline-block; width: 4px; height: 16px; background: #16a34a; border-radius: 2px; margin-right: 8px;"></span>
                        <span
                            style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #15803d;">{{ $isBn ? 'ব্যক্তিগত' : 'Personal' }}</span>
                    </div>
                    @foreach ([
        $isBn ? 'বাবার নাম' : 'Father' => $d['father_name'] ?? null,
        $isBn ? 'মায়ের নাম' : 'Mother' => $d['mother_name'] ?? null,
        $isBn ? 'জন্ম তারিখ' : 'DOB' => $d['date_of_birth'] ?? null,
        $isBn ? 'লিঙ্গ' : 'Gender' => isset($d['gender']) ? ucfirst($d['gender']) : null,
        $isBn ? 'জাতীয়তা' : 'Nationality' => $d['nationality'] ?? null,
        $isBn ? 'ধর্ম' : 'Religion' => $d['religion'] ?? null,
        $isBn ? 'বৈবাহিক' : 'Marital' => isset($d['marital_status']) ? ucfirst($d['marital_status']) : null,
    ] as $lbl => $val)
                        @if ($val)
                            <div style="font-size: 11px; margin-bottom: 5px; display: flex; gap: 4px;">
                                <span style="color: #6b7280; min-width: 70px;">{{ $lbl }}</span>
                                <span style="color: #1c1917; font-weight: 600;">{{ $val }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Skills --}}
            @if (!empty($s['skills']))
                <div style="margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <span
                            style="display: inline-block; width: 4px; height: 16px; background: #16a34a; border-radius: 2px; margin-right: 8px;"></span>
                        <span
                            style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #15803d;">{{ $isBn ? 'দক্ষতা' : 'Skills' }}</span>
                    </div>
                    @foreach ($s['skills'] as $skill)
                        <div style="margin-bottom: 8px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 3px;">
                                <span
                                    style="font-size: 12px; font-weight: 600; color: #1c1917;">{{ $skill['name'] }}</span>
                                @if ($skill['level'] ?? null)
                                    <span
                                        style="font-size: 10px; color: #16a34a;">{{ ucfirst($skill['level']) }}</span>
                                @endif
                            </div>
                            @php $pct = ['beginner'=>33,'intermediate'=>66,'expert'=>100][$skill['level'] ?? ''] ?? 50; @endphp
                            <div style="background: #dcfce7; border-radius: 10px; height: 5px;">
                                <div
                                    style="background: #16a34a; width: {{ $pct }}%; height: 5px; border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Languages --}}
            @if (!empty($s['languages']))
                <div style="margin-bottom: 24px;">
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <span
                            style="display: inline-block; width: 4px; height: 16px; background: #16a34a; border-radius: 2px; margin-right: 8px;"></span>
                        <span
                            style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #15803d;">{{ $isBn ? 'ভাষা' : 'Languages' }}</span>
                    </div>
                    @foreach ($s['languages'] as $lang)
                        <div style="font-size: 12px; color: #374151; margin-bottom: 4px;">
                            ◆ {{ $lang['name'] }}@if ($lang['proficiency'] ?? null)
                                <span style="color: #16a34a; font-size: 10px;">
                                    {{ ucfirst($lang['proficiency']) }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Online --}}
            @if (($d['website'] ?? null) || ($d['linkedin'] ?? null) || ($d['github'] ?? null))
                <div>
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <span
                            style="display: inline-block; width: 4px; height: 16px; background: #16a34a; border-radius: 2px; margin-right: 8px;"></span>
                        <span
                            style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #15803d;">Links</span>
                    </div>
                    @if ($d['website'] ?? null)
                        <div style="font-size: 11px; color: #15803d; margin-bottom: 4px;">🌐 {{ $d['website'] }}</div>
                    @endif
                    @if ($d['linkedin'] ?? null)
                        <div style="font-size: 11px; color: #15803d; margin-bottom: 4px;">in {{ $d['linkedin'] }}</div>
                    @endif
                    @if ($d['github'] ?? null)
                        <div style="font-size: 11px; color: #15803d; margin-bottom: 4px;">⌥ {{ $d['github'] }}</div>
                    @endif
                </div>
            @endif

        </div>

        {{-- Right Column --}}
        <div style="flex: 1; padding: 24px 28px;">

            @php
                function tplSection(string $title, string $accent = '#16a34a'): string
                {
                    return "<div style='font-size:13px;font-weight:800;text-transform:uppercase;letter-spacing:1px;color:{$accent};margin-bottom:12px;display:flex;align-items:center;gap:8px;'><span style='flex:1;height:2px;background:{$accent};opacity:.3;'></span>{$title}<span style='flex:1;height:2px;background:{$accent};opacity:.3;'></span></div>";
                }
            @endphp

            {{-- Profile Summary --}}
            @if ($d['profile_summary'] ?? null)
                <div style="margin-bottom: 20px; background: #f0fdf4; border-radius: 8px; padding: 14px 16px;">
                    {!! tplSection($isBn ? 'সারাংশ' : 'Summary') !!}
                    <p style="font-size: 13px; color: #374151; line-height: 1.7; margin: 0;">
                        {{ $d['profile_summary'] }}</p>
                </div>
            @endif

            {{-- Experience --}}
            @if (!empty($s['experiences']))
                <div style="margin-bottom: 20px;">
                    {!! tplSection($isBn ? 'কর্মঅভিজ্ঞতা' : 'Experience') !!}
                    @foreach ($s['experiences'] as $exp)
                        <div
                            style="margin-bottom: 14px; padding: 12px; border-radius: 6px; background: #fafafa; border-left: 3px solid #16a34a;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <div style="font-weight: 700; font-size: 13px; color: #1c1917;">
                                        {{ $exp['job_title'] }}</div>
                                    <div style="font-size: 12px; color: #16a34a; font-weight: 600;">
                                        {{ $exp['company_name'] }}</div>
                                </div>
                                <div style="text-align: right;">
                                    <div
                                        style="font-size: 11px; color: #6b7280; background: #dcfce7; padding: 2px 8px; border-radius: 20px;">
                                        {{ $exp['start_date'] ?? '' }}{{ $exp['start_date'] ?? null ? ' – ' : '' }}{{ $exp['end_date'] ?? '' }}
                                    </div>
                                </div>
                            </div>
                            @if ($exp['description'] ?? null)
                                <p
                                    style="font-size: 12px; color: #6b7280; margin-top: 6px; margin-bottom: 0; line-height: 1.5;">
                                    {{ $exp['description'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Education --}}
            @if (!empty($s['educations']))
                <div style="margin-bottom: 20px;">
                    {!! tplSection($isBn ? 'শিক্ষা' : 'Education') !!}
                    @foreach ($s['educations'] as $edu)
                        <div
                            style="margin-bottom: 10px; padding: 10px 12px; border-radius: 6px; background: #fafafa; border-left: 3px solid #16a34a;">
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <span
                                        style="font-weight: 700; font-size: 13px; color: #1c1917;">{{ $edu['degree'] }}</span>
                                    @if ($edu['field_of_study'] ?? null)
                                        <span style="font-size: 12px; color: #6b7280;"> in
                                            {{ $edu['field_of_study'] }}</span>
                                    @endif
                                    <div style="font-size: 12px; color: #16a34a;">{{ $edu['institute'] }}</div>
                                </div>
                                <div style="text-align: right; font-size: 11px; color: #9ca3af;">
                                    {{ $edu['end_year'] ?? '' }}
                                    @if ($edu['result'] ?? null)
                                        <br><span style="color: #16a34a; font-weight: 600;">{{ $edu['result'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Projects --}}
            @if (!empty($s['projects']))
                <div style="margin-bottom: 20px;">
                    {!! tplSection($isBn ? 'প্রকল্প' : 'Projects') !!}
                    @foreach ($s['projects'] as $proj)
                        <div
                            style="margin-bottom: 10px; padding: 10px 12px; border-radius: 6px; border: 1px solid #dcfce7;">
                            <div
                                style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 3px;">
                                <span
                                    style="font-weight: 700; font-size: 13px; color: #1c1917;">{{ $proj['title'] }}</span>
                                @if ($proj['project_url'] ?? null)
                                    <a href="{{ $proj['project_url'] }}"
                                        style="font-size: 10px; color: #16a34a; background: #dcfce7; padding: 2px 6px; border-radius: 4px;">Link</a>
                                @endif
                            </div>
                            @if ($proj['technologies'] ?? null)
                                <div style="font-size: 11px; color: #16a34a; margin-bottom: 3px;">🔧
                                    {{ $proj['technologies'] }}</div>
                            @endif
                            @if ($proj['description'] ?? null)
                                <div style="font-size: 12px; color: #6b7280; line-height: 1.5;">
                                    {{ $proj['description'] }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Certifications --}}
            @if (!empty($s['certifications']))
                <div>
                    {!! tplSection($isBn ? 'সার্টিফিকেট' : 'Certifications') !!}
                    @foreach ($s['certifications'] as $cert)
                        <div
                            style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px; padding: 6px 10px; border-radius: 4px; background: #f0fdf4;">
                            <span style="color: #16a34a; font-size: 14px;">🏅</span>
                            <div>
                                <span
                                    style="font-weight: 600; font-size: 12px; color: #1c1917;">{{ $cert['title'] }}</span>
                                @if ($cert['organization'] ?? null)
                                    <span style="font-size: 11px; color: #6b7280;"> ·
                                        {{ $cert['organization'] }}</span>
                                @endif
                                @if ($cert['issue_date'] ?? null)
                                    <span style="font-size: 11px; color: #9ca3af;"> · {{ $cert['issue_date'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
