<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Administrator']);
    }

    /**
     * Display the users management page for admin
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all users with pagination
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display form to create a new user (admin only)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'address' => 'required|string',
            'role' => 'required|in:Administrator,Member,Trainer,Receptionist',
            'status' => 'required|in:Active,Inactive',
        ]);
        
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'role' => $request->role,
            'status' => $request->status,
            'registrationDate' => now(),
            'email_verified_at' => now(), // Admin-created users are verified by default
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    /**
     * Display form to edit an existing user (admin only)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update an existing user (admin only)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'role' => 'required|in:Administrator,Member,Trainer,Receptionist',
            'status' => 'required|in:Active,Inactive',
        ]);
        
        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
            'status' => $request->status,
        ]);
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);
            
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    /**
     * Delete a user (admin only)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Set deletion date instead of actually deleting (soft delete)
        $user->update([
            'status' => 'Inactive',
            'deletionDate' => now(),
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User deactivated successfully');
    }
}