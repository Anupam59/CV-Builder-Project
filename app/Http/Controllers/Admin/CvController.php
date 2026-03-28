<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CvRequest;
use App\Models\Cv;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;

class CvController extends Controller
{
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

    /**
     * CV list — এই professional এর সব CV
     */
    public function index()
    {
        $this->authorizeAccess();

        $cvs = Cv::where('user_id', auth()->id())
            ->with('customer')
            ->latest()
            ->paginate(15);

        return view('page.admin.customer.cv.index', compact('cvs'));
    }

    /**
     * CV create form
     * URL: /admin/cvs/create?customer_id=X
     * এখানে customer এর সব data দেখাবে
     * User select করবে language (en/bn) + title দেবে
     * Save করলে snapshot নেবে
     */
    public function create()
    {
        $this->authorizeAccess();

        $customerId = request('customer_id');
        $customer   = Customer::findOrFail($customerId);

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

        return view('page.admin.customer.cv.create', compact('customer'));
    }

    /**
     * CV save — snapshot তৈরি করে save করো
     */
    public function store(CvRequest $request): RedirectResponse
    {
        $this->authorizeAccess();

        $customer = Customer::findOrFail($request->customer_id);
        $this->authorizeCustomer($customer);

        $lang = $request->language; // 'en' or 'bn'

        $customer->load([
            'detail',
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        // ── Snapshot তৈরি করো ────────────────────────────────────
        $snapshot = [
            'language' => $lang,

            // Basic Info
            'name'    => $customer->name,
            'phone'   => $customer->phone,
            'email'   => $customer->email,
            'address' => $customer->address,

            // Personal Detail
            'detail' => $customer->detail ? [
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
            ] : null,

            // Educations
            'educations' => $customer->educations->map(fn($e) => [
                'degree'         => $this->pick($e, 'degree', $lang),
                'field_of_study' => $this->pick($e, 'field_of_study', $lang),
                'institute'      => $this->pick($e, 'institute', $lang),
                'result'         => $e->result,
                'start_year'     => $e->start_year,
                'end_year'       => $e->end_year,
                'description'    => $this->pick($e, 'description', $lang),
            ])->toArray(),

            // Experiences
            'experiences' => $customer->experiences->map(fn($e) => [
                'job_title'       => $this->pick($e, 'job_title', $lang),
                'company_name'    => $this->pick($e, 'company_name', $lang),
                'employment_type' => $e->employment_type,
                'start_date'      => $e->start_date?->format('M Y'),
                'end_date'        => $e->is_current ? 'Present' : $e->end_date?->format('M Y'),
                'is_current'      => $e->is_current,
                'description'     => $this->pick($e, 'description', $lang),
            ])->toArray(),

            // Skills
            'skills' => $customer->skills->map(fn($s) => [
                'name'  => $this->pick($s, 'name', $lang),
                'level' => $s->level,
            ])->toArray(),

            // Projects
            'projects' => $customer->projects->map(fn($p) => [
                'title'        => $this->pick($p, 'title', $lang),
                'role'         => $this->pick($p, 'role', $lang),
                'technologies' => $this->pick($p, 'technologies', $lang),
                'project_url'  => $p->project_url,
                'description'  => $this->pick($p, 'description', $lang),
            ])->toArray(),

            // Languages
            'languages' => $customer->languages->map(fn($l) => [
                'name'        => $this->pick($l, 'name', $lang),
                'proficiency' => $l->proficiency,
            ])->toArray(),

            // Certifications
            'certifications' => $customer->certifications->map(fn($c) => [
                'title'         => $this->pick($c, 'title', $lang),
                'organization'  => $this->pick($c, 'organization', $lang),
                'issue_date'    => $c->issue_date?->format('M Y'),
                'expiry_date'   => $c->expiry_date?->format('M Y'),
                'credential_id' => $c->credential_id,
            ])->toArray(),
        ];

        $cv = Cv::create([
            'user_id'     => auth()->id(),
            'customer_id' => $customer->id,
            'title'       => $request->title ?? ($customer->name . ' - CV'),
            'language'    => $lang,
            'snapshot'    => $snapshot,
        ]);

        return redirect()
            ->route('admin.cvs.show', $cv->id)
            ->with('success', 'CV created successfully.');
    }

    /**
     * CV preview
     */
    public function show(Cv $cv)
    {
        $this->authorizeAccess();

        if ($cv->user_id !== auth()->id()) {
            abort(403);
        }

        return view('page.admin.customer.cv.show', compact('cv'));
    }

    /**
     * CV delete
     */
    public function destroy(Cv $cv): RedirectResponse
    {
        $this->authorizeAccess();

        if ($cv->user_id !== auth()->id()) {
            abort(403);
        }

        $cv->delete();

        return redirect()
            ->route('admin.cvs.index')
            ->with('success', 'CV deleted.');
    }

    /**
     * Language field pick helper
     * bn field থাকলে bn নেবে, না থাকলে en fallback
     */
    private function pick($model, string $field, string $lang): ?string
    {
        if ($lang === 'bn') {
            return $model->{$field . '_bn'} ?? $model->{$field} ?? null;
        }
        return $model->{$field} ?? null;
    }
}
