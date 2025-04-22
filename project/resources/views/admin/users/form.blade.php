@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden max-w-2xl mx-auto">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h3>
        </div>
        
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" class="p-6">
            @csrf
            @isset($user) @method('PUT') @endisset

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname', $user->firstname ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname ?? '') }}" required>
                </div>

                <div class="form-group md:col-span-2">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="input-field" required>
                        @foreach(['Administrator', 'Trainer', 'Receptionist', 'Member'] as $role)
                        <option value="{{ $role }}" {{ (old('role', $user->role ?? '') == $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="input-field" required>
                        <option value="Active" {{ (old('status', $user->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ (old('status', $user->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group md:col-span-2">
                    <label>Password</label>
                    <input type="password" name="password" {{ isset($user) ? '' : 'required' }}>
                    <p class="text-sm text-gray-500 mt-1">Leave blank to keep current password</p>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection