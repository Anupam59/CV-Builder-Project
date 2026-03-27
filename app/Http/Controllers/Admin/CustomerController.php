<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * শুধু professional role এর user access পাবে
     * প্রতিটা method এর শুরুতে call করতে হবে
     */
    private function authorizeCustomerAccess(): void
    {
        if (auth()->user()->role !== 'professional') {
            abort(403, 'Only professional users can access customer management.');
        }
    }

    /**
     * এই professional এর সাথে attached সব customer list
     */
    public function index()
    {
        $this->authorizeCustomerAccess();

        $customers = auth()->user()
            ->customers()
            ->withPivot('created_at')
            ->latest('customer_user.created_at')
            ->paginate(15);

        return view('page.admin.customer.index', compact('customers'));
    }

    /**
     * Step 1: শুধু phone number input form
     */
    public function searchForm()
    {
        $this->authorizeCustomerAccess();

        return view('page.admin.customer.search');
    }

    /**
     * Step 2: Phone দিয়ে search করো
     * - পাওয়া গেলে → confirm page দেখাও
     * - না পেলে  → full create form দেখাও
     */
    public function searchByPhone(Request $request)
    {
        $this->authorizeCustomerAccess();

        $request->validate([
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $phone    = $request->phone;
        $customer = Customer::where('phone', $phone)->first();

        if ($customer) {
            $alreadyAttached = auth()->user()
                ->customers()
                ->where('customers.id', $customer->id)
                ->exists();

            return view('page.admin.customer.found', compact('customer', 'alreadyAttached'));
        }

        return view('page.admin.customer.create', compact('phone'));
    }

    /**
     * Step 3A: Existing customer → এই user এর সাথে attach করো
     */
    public function attach(Request $request)
    {
        $this->authorizeCustomerAccess();

        $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
        ]);

        $customer = Customer::findOrFail($request->customer_id);

        // syncWithoutDetaching → duplicate entry হবে না
        auth()->user()->customers()->syncWithoutDetaching([$customer->id]);

        return redirect()
            ->route('admin.customers.show', $customer->id)
            ->with('success', 'Customer successfully added to your list.');
    }

    /**
     * Step 3B: নতুন customer create করো এবং attach করো
     */
    public function store(CustomerRequest $request)
    {
        // race condition এর জন্য আবার check
        $existing = Customer::where('phone', $request->phone)->first();

        if ($existing) {
            return redirect()
                ->route('admin.customers.search')
                ->with('warning', 'A customer with this phone number already exists.')
                ->withInput();
        }

        $customer = Customer::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        auth()->user()->customers()->attach($customer->id);

        return redirect()
            ->route('admin.customers.show', $customer->id)
            ->with('success', 'Customer created and added to your list.');
    }

    /**
     * Customer detail + তার সব CV
     */
    public function show(Customer $customer)
    {
        $this->authorizeCustomerAccess();

        $isAttached = auth()->user()
            ->customers()
            ->where('customers.id', $customer->id)
            ->exists();

        if (!$isAttached) {
            abort(403, 'You do not have access to this customer.');
        }

        $cvs = $customer->cvs()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('page.admin.customer.show', compact('customer', 'cvs'));
    }
}
