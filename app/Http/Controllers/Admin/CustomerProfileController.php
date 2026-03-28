<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileSectionRequest;
use App\Models\Certification;
use App\Models\Customer;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    // ── Authorization ─────────────────────────────────────────────

    private function authorizeAccess(): void
    {
        if (auth()->user()->role !== 'professional') {
            abort(403, 'Only professional users can manage customer profiles.');
        }
    }

    /**
     * এই customer এই professional এর list এ আছে কিনা check করো
     */
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

    // ── Profile Overview Page ─────────────────────────────────────

    /**
     * Customer এর সব profile data একসাথে দেখাও
     */
    public function show(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->load([
            'educations',
            'experiences',
            'skills',
            'projects',
            'languages',
            'certifications',
        ]);

        return view('page.admin.customer.profile.show', compact('customer'));
    }

    // ══════════════════════════════════════════════════════════════
    // EDUCATION
    // ══════════════════════════════════════════════════════════════

    public function educationCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.education.form', compact('customer'));
    }

    public function educationStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->educations()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Education added successfully.');
    }

    public function educationEdit(Customer $customer, Education $education)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($education->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.education.form', compact('customer', 'education'));
    }

    public function educationUpdate(ProfileSectionRequest $request, Customer $customer, Education $education): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($education->customer_id !== $customer->id, 404);

        $education->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Education updated successfully.');
    }

    public function educationDestroy(Customer $customer, Education $education): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($education->customer_id !== $customer->id, 404);

        $education->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Education deleted.');
    }

    // ══════════════════════════════════════════════════════════════
    // EXPERIENCE
    // ══════════════════════════════════════════════════════════════

    public function experienceCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.experience.form', compact('customer'));
    }

    public function experienceStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->experiences()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Experience added successfully.');
    }

    public function experienceEdit(Customer $customer, Experience $experience)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($experience->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.experience.form', compact('customer', 'experience'));
    }

    public function experienceUpdate(ProfileSectionRequest $request, Customer $customer, Experience $experience): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($experience->customer_id !== $customer->id, 404);

        $experience->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Experience updated successfully.');
    }

    public function experienceDestroy(Customer $customer, Experience $experience): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($experience->customer_id !== $customer->id, 404);

        $experience->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Experience deleted.');
    }

    // ══════════════════════════════════════════════════════════════
    // SKILL
    // ══════════════════════════════════════════════════════════════

    public function skillCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.skill.form', compact('customer'));
    }

    public function skillStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->skills()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Skill added successfully.');
    }

    public function skillEdit(Customer $customer, Skill $skill)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($skill->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.skill.form', compact('customer', 'skill'));
    }

    public function skillUpdate(ProfileSectionRequest $request, Customer $customer, Skill $skill): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($skill->customer_id !== $customer->id, 404);

        $skill->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Skill updated successfully.');
    }

    public function skillDestroy(Customer $customer, Skill $skill): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($skill->customer_id !== $customer->id, 404);

        $skill->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Skill deleted.');
    }

    // ══════════════════════════════════════════════════════════════
    // PROJECT
    // ══════════════════════════════════════════════════════════════

    public function projectCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.project.form', compact('customer'));
    }

    public function projectStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->projects()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Project added successfully.');
    }

    public function projectEdit(Customer $customer, Project $project)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($project->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.project.form', compact('customer', 'project'));
    }

    public function projectUpdate(ProfileSectionRequest $request, Customer $customer, Project $project): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($project->customer_id !== $customer->id, 404);

        $project->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Project updated successfully.');
    }

    public function projectDestroy(Customer $customer, Project $project): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($project->customer_id !== $customer->id, 404);

        $project->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Project deleted.');
    }

    // ══════════════════════════════════════════════════════════════
    // LANGUAGE
    // ══════════════════════════════════════════════════════════════

    public function languageCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.language.form', compact('customer'));
    }

    public function languageStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->languages()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Language added successfully.');
    }

    public function languageEdit(Customer $customer, Language $language)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($language->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.language.form', compact('customer', 'language'));
    }

    public function languageUpdate(ProfileSectionRequest $request, Customer $customer, Language $language): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($language->customer_id !== $customer->id, 404);

        $language->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Language updated successfully.');
    }

    public function languageDestroy(Customer $customer, Language $language): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($language->customer_id !== $customer->id, 404);

        $language->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Language deleted.');
    }

    // ══════════════════════════════════════════════════════════════
    // CERTIFICATION
    // ══════════════════════════════════════════════════════════════

    public function certificationCreate(Customer $customer)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        return view('page.admin.customer.profile.certification.form', compact('customer'));
    }

    public function certificationStore(ProfileSectionRequest $request, Customer $customer): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);

        $customer->certifications()->create($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Certification added successfully.');
    }

    public function certificationEdit(Customer $customer, Certification $certification)
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($certification->customer_id !== $customer->id, 404);

        return view('page.admin.customer.profile.certification.form', compact('customer', 'certification'));
    }

    public function certificationUpdate(ProfileSectionRequest $request, Customer $customer, Certification $certification): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($certification->customer_id !== $customer->id, 404);

        $certification->update($request->validated());

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Certification updated successfully.');
    }

    public function certificationDestroy(Customer $customer, Certification $certification): RedirectResponse
    {
        $this->authorizeAccess();
        $this->authorizeCustomer($customer);
        abort_if($certification->customer_id !== $customer->id, 404);

        $certification->delete();

        return redirect()
            ->route('admin.customers.profile.show', $customer->id)
            ->with('success', 'Certification deleted.');
    }
}
