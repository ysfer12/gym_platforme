@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Include admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-orange-500 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
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
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                        <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New User
                    </a>
                                </div>
            </div>

            <!-- Main Content Container -->
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm flex items-center" x-data="{ show: true }" x-show="show">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">
                            {{ session('success') }}
                        </p>
                    </div>
                    <div class="ml-auto">
                        <button @click="show = false" class="inline-flex bg-green-50 rounded-full p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition-colors duration-200">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Users Table Card -->
                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
                    <!-- Search & Filter Section -->
                    <div class="px-6 py-6 sm:px-8 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                            <div>
                                <h3 class="text-xl leading-6 font-semibold text-gray-900 flex items-center">
                                    <span class="w-1.5 h-5 bg-orange-500 rounded-sm mr-2"></span>
                                    All Users
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Manage members, trainers, and staff
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex items-center">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="search" 
                                        class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-all duration-200" 
                                        placeholder="Search users...">
                                </div>
                                <select id="role-filter" name="role" 
                                    class="rounded-lg border-gray-300 py-2 pl-3 pr-10 text-base focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                                    <option value="">All Roles</option>
                                    <option value="Administrator">Administrators</option>
                                    <option value="Trainer">Trainers</option>
                                    <option value="Receptionist">Receptionists</option>
                                    <option value="Member">Members</option>
                                </select>
                                <select id="status-filter" name="status" 
                                    class="rounded-lg border-gray-300 py-2 pl-3 pr-10 text-base focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                                    <option value="">All Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Joined Date
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                <tr class="hover:bg-orange-50 transition-colors duration-200">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold shadow-md">
                                                {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->firstname }} {{ $user->lastname }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->role == 'Administrator' ? 'bg-orange-100 text-orange-800' : 
                                               ($user->role == 'Trainer' ? 'bg-blue-100 text-blue-800' : 
                                               ($user->role == 'Receptionist' ? 'bg-green-100 text-green-800' : 
                                               'bg-purple-100 text-purple-800')) }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $user->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->registrationDate ? Carbon\Carbon::parse($user->registrationDate)->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 bg-gray-100 hover:bg-gray-200 p-1.5 rounded-full" title="View User Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-gray-400 hover:text-orange-500 transition-colors duration-200 bg-gray-100 hover:bg-orange-100 p-1.5 rounded-full" title="Edit User">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200 bg-gray-100 hover:bg-red-100 p-1.5 rounded-full" title="Delete User">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <p class="text-gray-500 font-medium">No users found</p>
                                            <p class="text-gray-400 text-sm mt-1">Try adjusting your search filters</p>
                                            <a href="{{ route('admin.users.create') }}" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-orange-500 hover:text-orange-700 font-medium">
                                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Add your first user
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 sm:px-8">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
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

    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const roleFilter = document.getElementById('role-filter');
        const statusFilter = document.getElementById('status-filter');

        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const role = roleFilter.value;
            const status = statusFilter.value;
            
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const userRole = row.querySelector('td:nth-child(3)').textContent.trim();
                const userStatus = row.querySelector('td:nth-child(4)').textContent.trim();
                
                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                const matchesRole = role === '' || userRole === role;
                const matchesStatus = status === '' || userStatus === status;
                
                if (matchesSearch && matchesRole && matchesStatus) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (roleFilter) roleFilter.addEventListener('change', applyFilters);
        if (statusFilter) statusFilter.addEventListener('change', applyFilters);
    });
</script>
@endsection
@endsection