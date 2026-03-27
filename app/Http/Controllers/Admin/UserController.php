<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function authorizeUserManagement(): void
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'You are not authorized to manage users.');
        }
    }

    public function index(Request $request)
    {
        $this->authorizeUserManagement();
        $users = User::query()
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', '%' . $request->name . '%'))
            ->when($request->filled('email'), fn($q) => $q->where('email', 'like', '%' . $request->email . '%'))
            ->when($request->filled('phone'), fn($q) => $q->where('phone', 'like', '%' . $request->phone . '%'))
            ->when($request->filled('is_active'), fn($q) => $q->where('is_active', $request->is_active))
            ->when($request->filled('account_type'), fn($q) => $q->where('account_type', $request->account_type))
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->latest()
            ->paginate(15);

        return view('page.admin.user.index', compact('users'));
    }

    public function create()
    {
        $this->authorizeUserManagement();

        return view('page.admin.user.create');
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'account_type' => $request->account_type,
            'is_active'    => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorizeUserManagement();

        return view('page.admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'role'         => $request->role,
            'account_type' => $request->account_type,
            'is_active'    => $request->boolean('is_active'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
