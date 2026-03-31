<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CvRequest;
use App\Models\Cv;
use App\Models\CvSnapshot;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CvController extends Controller
{
    // ── Authorization ─────────────────────────────────────────────

    private function authorizeAccess(): void
    {
        if (auth()->user()->role !== 'professional') {
            abort(403, 'Only professional users can manage CVs.');
        }
    }

    private function authorizeCustomer(Customer $customer): void
    {
        $attached = auth()->user()
            ->customers()
            ->where('customers.id', $customer->id)
            ->exists();

        if (!$attached) {
            abort(403, 'You do not have access to this customer.');
        }
    }

    private function authorizeCv(Cv $cv): void
    {
        if ($cv->user_id !== auth()->id()) {
            abort(403);
        }
    }

    // ── CV List ───────────────────────────────────────────────────

    public function index()
    {
        $this->authorizeAccess();

        $cvs = Cv::where('user_id', auth()->id())
            ->with('customer')
            ->latest()
            ->paginate(15);

        return view('page.admin.customer.cv.index', compact('cvs'));
    }

    // ══════════════════════════════════════════════════════════════
    // STEP 1 — Customer Select
    // ══════════════════════════════════════════════════════════════

    public function step1()
    {
        $this->authorizeAccess();

        $customers = auth()->user()
            ->customers()
            ->withPivot('created_at')
            ->latest('customer_user.created_at')
            ->get();

        return view('page.admin.customer.cv.step1_select_customer', compact('customers'));
    }

    // ══════════════════════════════════════════════════════════════
    // STEP 2 — Template Select + Live Preview
    // ══════════════════════════════════════════════════════════════

    public function step2(Request $request)
    {
        $this->authorizeAccess();

        $request->validate(['customer_id' => ['required', 'exists:customers,id']]);

        $customer = Customer::findOrFail($request->customer_id);
        $this->authorizeCustomer($customer);

        $customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $templates  = Cv::availableTemplates();
        $language   = $request->get('language', 'en');
        $selected   = $request->get('template_name', 'template_1');

        // Preview এর জন্য snapshot তৈরি করো (save করা হবে না)
        $preview = $this->buildSnapshot($customer, $language);

        return view('page.admin.customer.cv.step2_select_template', compact(
            'customer',
            'templates',
            'selected',
            'language',
            'preview'
        ));
    }

    // ══════════════════════════════════════════════════════════════
    // STEP 3 — Data Review (include/exclude)
    // ══════════════════════════════════════════════════════════════

    public function step3(Request $request)
    {
        $this->authorizeAccess();

        $request->validate([
            'customer_id'   => ['required', 'exists:customers,id'],
            'template_name' => ['required', 'string'],
            'language'      => ['required', 'in:en,bn'],
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $this->authorizeCustomer($customer);

        $customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $templateName = $request->template_name;
        $language     = $request->language;
        $templates    = Cv::availableTemplates();

        return view('page.admin.customer.cv.step3_review_data', compact(
            'customer',
            'templateName',
            'language',
            'templates'
        ));
    }

    // ══════════════════════════════════════════════════════════════
    // STORE — Final Save with Snapshot
    // ══════════════════════════════════════════════════════════════

    public function store(CvRequest $request): RedirectResponse
    {
        $this->authorizeAccess();

        $customer = Customer::findOrFail($request->customer_id);
        $this->authorizeCustomer($customer);

        $customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $lang     = $request->language;
        $include  = $request->input('include', []);

        // Snapshot build করো — include/exclude apply করো
        $snapshot = $this->buildSnapshot($customer, $lang, $include);

        // CV create করো
        $cv = Cv::create([
            'user_id'       => auth()->id(),
            'customer_id'   => $customer->id,
            'title'         => $request->title ?? ($customer->name . ' - CV'),
            'language'      => $lang,
            'template_name' => $request->template_name,
            'snapshot'      => $snapshot,
            'is_locked'     => true, // save হলেই lock
        ]);

        // Version 1 snapshot save করো
        CvSnapshot::create([
            'cv_id'         => $cv->id,
            'created_by'    => auth()->id(),
            'template_name' => $request->template_name,
            'snapshot'      => $snapshot,
            'version'       => 1,
        ]);

        return redirect()
            ->route('admin.cvs.show', $cv->id)
            ->with('success', 'CV created and saved successfully.');
    }

    // ══════════════════════════════════════════════════════════════
    // SHOW — Render with Template
    // ══════════════════════════════════════════════════════════════

    public function show(Cv $cv)
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        $cv->load('snapshots', 'customer');
        $snapshot = $cv->snapshot;
        $template = $cv->template_name;

        return view('page.admin.customer.cv.show', compact('cv', 'snapshot', 'template'));
    }

    // ══════════════════════════════════════════════════════════════
    // EDIT — Load snapshot into editable form
    // ══════════════════════════════════════════════════════════════

    public function edit(Cv $cv)
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        $customer = $cv->customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $templates    = Cv::availableTemplates();
        $snapshot     = $cv->snapshot; // existing snapshot load
        $templateName = $cv->template_name;
        $language     = $cv->language;

        return view('page.admin.customer.cv.edit', compact(
            'cv',
            'customer',
            'templates',
            'snapshot',
            'templateName',
            'language'
        ));
    }

    // ══════════════════════════════════════════════════════════════
    // UPDATE — New snapshot, preserve old version
    // ══════════════════════════════════════════════════════════════

    public function update(CvRequest $request, Cv $cv): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        $customer = $cv->customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $lang    = $request->language;
        $include = $request->input('include', []);

        // নতুন snapshot তৈরি করো
        $newSnapshot = $this->buildSnapshot($customer, $lang, $include);

        // নতুন version number
        $nextVersion = $cv->getNextVersion();

        // পুরানো snapshot history তে save করো (already আছে)
        // নতুন version save করো
        CvSnapshot::create([
            'cv_id'         => $cv->id,
            'created_by'    => auth()->id(),
            'template_name' => $request->template_name,
            'snapshot'      => $newSnapshot,
            'version'       => $nextVersion,
        ]);

        // CV update করো — নতুন snapshot দিয়ে
        $cv->update([
            'title'         => $request->title ?? $cv->title,
            'language'      => $lang,
            'template_name' => $request->template_name,
            'snapshot'      => $newSnapshot,
            'is_locked'     => true,
        ]);

        return redirect()
            ->route('admin.cvs.show', $cv->id)
            ->with('success', 'CV updated successfully. Version ' . $nextVersion . ' saved.');
    }

    // ── Delete ────────────────────────────────────────────────────

    public function destroy(Cv $cv): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        $cv->delete(); // snapshots cascade delete হবে

        return redirect()
            ->route('admin.cvs.index')
            ->with('success', 'CV deleted.');
    }

    // ── Snapshot Version History ──────────────────────────────────

    public function history(Cv $cv)
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        $snapshots = $cv->snapshots()->with('creator')->get();
        $templates = Cv::availableTemplates();

        return view('page.admin.customer.cv.history', compact('cv', 'snapshots', 'templates'));
    }

    // ── Restore a specific version ────────────────────────────────

    public function restore(Cv $cv, CvSnapshot $cvSnapshot): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCv($cv);

        if ($cvSnapshot->cv_id !== $cv->id) {
            abort(404);
        }

        // Restore করো — নতুন version হিসেবে save করো
        $nextVersion = $cv->getNextVersion();

        CvSnapshot::create([
            'cv_id'         => $cv->id,
            'created_by'    => auth()->id(),
            'template_name' => $cvSnapshot->template_name,
            'snapshot'      => $cvSnapshot->snapshot,
            'version'       => $nextVersion,
        ]);

        $cv->update([
            'template_name' => $cvSnapshot->template_name,
            'snapshot'      => $cvSnapshot->snapshot,
            'language'      => $cvSnapshot->snapshot['language'] ?? 'en',
        ]);

        return redirect()
            ->route('admin.cvs.show', $cv->id)
            ->with('success', 'CV restored to version ' . $cvSnapshot->version . '.');
    }

    // ══════════════════════════════════════════════════════════════
    // PRIVATE: Snapshot Builder
    // ══════════════════════════════════════════════════════════════

    private function buildSnapshot(Customer $customer, string $lang, array $include = []): array
    {
        // include array empty মানে সব include করো
        $includeAll = empty($include);

        $snapshot = [
            'language' => $lang,
            'name'     => $customer->name,
            'phone'    => $customer->phone,
            'email'    => $customer->email,
            'address'  => $customer->address,
        ];

        // Personal Detail
        if ($includeAll || !empty($include['personal_detail'])) {
            $snapshot['detail'] = $customer->detail ? [
                'father_name'     => $this->pick($customer->detail, 'father_name', $lang),
                'mother_name'     => $this->pick($customer->detail, 'mother_name', $lang),
                'date_of_birth'   => $customer->detail->date_of_birth?->format('d M Y'),
                'gender'          => $customer->detail->gender,
                'marital_status'  => $customer->detail->marital_status,
                'nationality'     => $this->pick($customer->detail, 'nationality', $lang),
                'religion'        => $this->pick($customer->detail, 'religion', $lang),
                'nid_number'      => $customer->detail->nid_number,
                'profession'      => $this->pick($customer->detail, 'profession', $lang),
                'profile_summary' => $this->pick($customer->detail, 'profile_summary', $lang),
                'website'         => $customer->detail->website,
                'linkedin'        => $customer->detail->linkedin,
                'github'          => $customer->detail->github,
            ] : null;
        }

        // Educations
        if ($includeAll || !empty($include['educations'])) {
            $snapshot['educations'] = $customer->educations->map(fn($e) => [
                'degree'         => $this->pick($e, 'degree', $lang),
                'field_of_study' => $this->pick($e, 'field_of_study', $lang),
                'institute'      => $this->pick($e, 'institute', $lang),
                'result'         => $e->result,
                'start_year'     => $e->start_year,
                'end_year'       => $e->end_year,
                'description'    => $this->pick($e, 'description', $lang),
            ])->toArray();
        }

        // Experiences
        if ($includeAll || !empty($include['experiences'])) {
            $snapshot['experiences'] = $customer->experiences->map(fn($e) => [
                'job_title'       => $this->pick($e, 'job_title', $lang),
                'company_name'    => $this->pick($e, 'company_name', $lang),
                'employment_type' => $e->employment_type,
                'start_date'      => $e->start_date?->format('M Y'),
                'end_date'        => $e->is_current ? 'Present' : $e->end_date?->format('M Y'),
                'is_current'      => $e->is_current,
                'description'     => $this->pick($e, 'description', $lang),
            ])->toArray();
        }

        // Skills
        if ($includeAll || !empty($include['skills'])) {
            $snapshot['skills'] = $customer->skills->map(fn($s) => [
                'name'  => $this->pick($s, 'name', $lang),
                'level' => $s->level,
            ])->toArray();
        }

        // Projects
        if ($includeAll || !empty($include['projects'])) {
            $snapshot['projects'] = $customer->projects->map(fn($p) => [
                'title'        => $this->pick($p, 'title', $lang),
                'role'         => $this->pick($p, 'role', $lang),
                'technologies' => $this->pick($p, 'technologies', $lang),
                'project_url'  => $p->project_url,
                'description'  => $this->pick($p, 'description', $lang),
            ])->toArray();
        }

        // Languages
        if ($includeAll || !empty($include['languages'])) {
            $snapshot['languages'] = $customer->languages->map(fn($l) => [
                'name'        => $this->pick($l, 'name', $lang),
                'proficiency' => $l->proficiency,
            ])->toArray();
        }

        // Certifications
        if ($includeAll || !empty($include['certifications'])) {
            $snapshot['certifications'] = $customer->certifications->map(fn($c) => [
                'title'         => $this->pick($c, 'title', $lang),
                'organization'  => $this->pick($c, 'organization', $lang),
                'issue_date'    => $c->issue_date?->format('M Y'),
                'expiry_date'   => $c->expiry_date?->format('M Y'),
                'credential_id' => $c->credential_id,
            ])->toArray();
        }

        return $snapshot;
    }

    /**
     * bn field থাকলে bn নেবে, না থাকলে en fallback
     */
    private function pick($model, string $field, string $lang): ?string
    {
        if ($lang === 'bn') {
            return $model->{$field . '_bn'} ?? $model->{$field} ?? null;
        }
        return $model->{$field} ?? null;
    }



    public function preview(Request $request)
    {
        $this->authorizeAccess();

        $request->validate([
            'customer_id'   => ['required', 'exists:customers,id'],
            'template_name' => ['required', 'string'],
            'language'      => ['required', 'in:en,bn'],
        ]);

        $customer = Customer::findOrFail($request->customer_id);
        $this->authorizeCustomer($customer);

        $customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        $preview  = $this->buildSnapshot($customer, $request->language);
        $template = $request->template_name;
        $isBn     = $request->language === 'bn';

        return view('page.admin.customer.cv.templates.' . $template, [
            's'    => $preview,
            'isBn' => $isBn,
        ]);
    }
}

// এই method CvController class এর ভেতরে add করুন (closing brace এর আগে)
// ── AJAX Preview ────────────────────────────────────────────────
