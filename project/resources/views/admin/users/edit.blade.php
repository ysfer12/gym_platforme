@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-orange-500 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                User Management
                            </h1>
                            <p class="mt-1 text-white text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manage your organization's users and permissions
                            </p>
                        </div>
                        <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-orange-600 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Container -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Validation Errors -->
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button @click="show = false" class="inline-flex bg-red-50 rounded-full p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- User Edit Form Card -->
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-3 mr-4 shadow-md">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <span class="w-1 h-4 bg-orange-500 rounded-sm mr-2"></span>
                                    Edit User Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Update personal details and role assignment</p>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="px-6 py-5">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <!-- First Name -->
                                <div class="sm:col-span-3">
                                    <label for="firstname" class="block text-sm font-medium text-gray-700">First name</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $user->firstname) }}" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200" required>
                                    </div>
                                    @error('firstname')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="sm:col-span-3">
                                    <label for="lastname" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200" required>
                                    </div>
                                    @error('lastname')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="sm:col-span-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" autocomplete="email" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200" required>
                                    </div>
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password - Optional on edit -->
                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password
                                        <span class="text-sm text-gray-500">(leave blank to keep current)</span>
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input type="password" name="password" id="password" autocomplete="new-password" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200">
                                    </div>
                                    @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div class="sm:col-span-3">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="sm:col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <textarea id="address" name="address" rows="3" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                    @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="sm:col-span-3">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                        </div>
                                        <select id="role" name="role" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200" required>
                                            <option value="Administrator" {{ old('role', $user->role) == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                            <option value="Trainer" {{ old('role', $user->role) == 'Trainer' ? 'selected' : '' }}>Trainer</option>
                                            <option value="Receptionist" {{ old('role', $user->role) == 'Receptionist' ? 'selected' : '' }}>Receptionist</option>
                                            <option value="Member" {{ old('role', $user->role) == 'Member' ? 'selected' : '' }}>Member</option>
                                        </select>
                                    </div>
                                    @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="sm:col-span-3">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <select id="status" name="status" class="pl-10 shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md transition-colors duration-200" required>
                                            <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="{{ route('admin.users') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Member-specific Information (when editing a member) -->
                @if($user->role == 'Member')
                <div class="mt-6 bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-3 mr-4 shadow-md">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <span class="w-1 h-4 bg-blue-500 rounded-sm mr-2"></span>
                                    Membership Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Subscription and attendance details</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <dl>
                            <!-- Active Subscription -->
                            <div class="bg-white px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-700">Membership Plan</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                                    <div>
                                        @if(isset($activeSubscription))
                                            <div class="flex items-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                                                    Active
                                                </span>
                                                <span class="font-medium">{{ $activeSubscription->type }}</span>
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                Expires: {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                No active membership
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('admin.subscriptions.create', ['user_id' => $user->id]) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                        <svg class="mr-1 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Subscription
                                    </a>
                                </dd>
                            </div>

                            <!-- Attendance Statistics -->
                            <div class="bg-gray-50 px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-700">Attendance (Last 30 days)</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="bg-orange-100 text-orange-800 text-xs font-semibold p-2 rounded-full mr-2">
                                            {{ $attendanceCount ?? 0 }}
                                        </span>
                                        <span>sessions this month</span>
                                    </div>
                                    <a href="{{ route('admin.attendances.index', ['user_id' => $user->id]) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg class="mr-1 -ml-1 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Details
                                    </a>
                                </dd>
                            </div>

                            <!-- Registration Date -->
                            <div class="bg-white px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-700">Member Since</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $user->registrationDate ? \Carbon\Carbon::parse($user->registrationDate)->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                @endif

                <!-- Trainer-specific Information (when editing a trainer) -->
                @if($user->role == 'Trainer')
                <div class="mt-6 bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-3 mr-4 shadow-md">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <span class="w-1 h-4 bg-purple-500 rounded-sm mr-2"></span>
                                    Trainer Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Sessions and performance details</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <dl>
                            <!-- Upcoming Sessions -->
                            <div class="bg-white px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-700">Upcoming Sessions</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="bg-purple-100 text-purple-800 text-xs font-semibold p-2 rounded-full mr-2">
                                            {{ $upcomingSessions ?? 0 }}
                                        </span>
                                        <span>scheduled sessions</span>
                                    </div>
                                    <a href="{{ route('admin.sessions.index', ['trainer_id' => $user->id]) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                                        <svg class="mr-1 -ml-1 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Sessions
                                    </a>
                                </dd>
                            </div>

                            <!-- Specialization Field (Example additional field) -->
                            <div class="bg-gray-50 px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-700">Specialization</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span>{{ $user->specialization ?? 'Not specified' }}</span>
                                    </div>
                                </dd>
                            </div>

                            <!-- Total Sessions Led -->
                            <div class="bg-white px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-700">Total Sessions Led</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold p-2 rounded-full mr-2">
                                            {{ $totalSessions ?? 0 }}
                                        </span>
                                        <span>sessions completed</span>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>

@section('scripts')
<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const openSidebarButton = document.getElementById('open-sidebar');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const closeMenuButtons = document.querySelectorAll('#close-mobile-menu, #close-mobile-menu-x');

        function toggleMobileMenu(open) {
            if (open) {
                mobileMenu.classList.remove('hidden', '-translate-x-full');
                mobileMenuOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            }
        }

        if (openSidebarButton) {
            openSidebarButton.addEventListener('click', () => toggleMobileMenu(true));
        }

        closeMenuButtons.forEach(button => {
            button.addEventListener('click', () => toggleMobileMenu(false));
        });

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', () => toggleMobileMenu(false));
        }
    });
</script>
@endsection

@endsection