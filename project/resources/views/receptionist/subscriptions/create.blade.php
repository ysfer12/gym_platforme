@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">Create New Subscription</h1>
                        <a href="{{ route('receptionist.subscriptions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subscriptions
                        </a>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <form action="{{ route('receptionist.subscriptions.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Member Selection with Create New Button -->
                                    <div class="col-span-2">
                                        <div class="flex justify-between items-center">
                                            <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                            <button type="button" onclick="document.getElementById('createMemberModal').classList.remove('hidden')" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <svg class="-ml-0.5 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                New Member
                                            </button>
                                        </div>
                                        <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>
                                                    {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Subscription Type -->
                                    <div>
                                        <label for="type" class="block text-sm font-medium text-gray-700">Subscription Type</label>
                                        <select id="type" name="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a type</option>
                                            <option value="Basic" {{ old('type') == 'Basic' ? 'selected' : '' }}>Basic</option>
                                            <option value="Premium" {{ old('type') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="Elite" {{ old('type') == 'Elite' ? 'selected' : '' }}>Elite</option>
                                        </select>
                                        @error('type')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Duration -->
                                    <div>
                                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (months)</label>
                                        <select id="duration" name="duration" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>1 Month</option>
                                            <option value="3" {{ old('duration') == 3 ? 'selected' : '' }}>3 Months</option>
                                            <option value="6" {{ old('duration') == 6 ? 'selected' : '' }}>6 Months</option>
                                            <option value="12" {{ old('duration') == 12 ? 'selected' : '' }}>12 Months</option>
                                        </select>
                                        @error('duration')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Start Date -->
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('start_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('end_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="status" name="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Payment Method -->
                                    <div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <select id="payment_method" name="payment_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">None</option>
                                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                            <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        </select>
                                        @error('payment_method')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Removing Transaction Number input field since it's automatically generated -->
                                    <!-- <div class="hidden">
                                        <input type="hidden" name="transaction_number" id="transaction_number" value="">
                                    </div> -->

                                    <!-- Max Sessions Count -->
                                    <div>
                                        <label for="max_sessions_count" class="block text-sm font-medium text-gray-700">Max Sessions (Leave blank for unlimited)</label>
                                        <input type="number" name="max_sessions_count" id="max_sessions_count" min="0" value="{{ old('max_sessions_count') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('max_sessions_count')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Sessions Left -->
                                    <div>
                                        <label for="sessions_left" class="block text-sm font-medium text-gray-700">Sessions Left</label>
                                        <input type="number" name="sessions_left" id="sessions_left" min="0" value="{{ old('sessions_left') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('sessions_left')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Trainer Zone Access -->
                                    <div class="col-span-2">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="trainer_zone_access" name="trainer_zone_access" type="checkbox" value="1" {{ old('trainer_zone_access') ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="trainer_zone_access" class="font-medium text-gray-700">Trainer Zone Access</label>
                                                <p class="text-gray-500">Allow member to access the trainer zone and premium equipment</p>
                                            </div>
                                        </div>
                                        @error('trainer_zone_access')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Create Subscription
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Member Modal -->
<div id="createMemberModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="createMemberForm" action="{{ route('receptionist.members.store') }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Create New Member
                            </h3>
                            <div class="mt-4">
                                <!-- Member form fields -->
                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" name="firstname" id="firstname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" name="lastname" id="lastname" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <input type="text" name="address" id="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    
                                    <!-- Password fields can be auto-generated by the system -->
                                    <input type="hidden" name="redirect_to_subscription" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Create Member
                    </button>
                    <button type="button" onclick="document.getElementById('createMemberModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Calculate End Date JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const durationSelect = document.getElementById('duration');
        
        function calculateEndDate() {
            const startDate = new Date(startDateInput.value);
            const duration = parseInt(durationSelect.value);
            
            if (startDate && !isNaN(duration)) {
                const endDate = new Date(startDate);
                endDate.setMonth(endDate.getMonth() + duration);
                
                // Format date as YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');
                
                endDateInput.value = `${year}-${month}-${day}`;
            }
        }
        
        // Calculate end date when start date or duration changes
        startDateInput.addEventListener('change', calculateEndDate);
        durationSelect.addEventListener('change', calculateEndDate);
        
        // Set initial end date
        if (startDateInput.value) {
            calculateEndDate();
        }
        
        // Handle pricing based on subscription type and duration
        const typeSelect = document.getElementById('type');
        const priceInput = document.getElementById('price');
        
        function updatePrice() {
            const type = typeSelect.value;
            const duration = parseInt(durationSelect.value);
            
            // Example pricing logic - adjust according to your business rules
            let basePrice = 0;
            
            if (type === 'Basic') basePrice = 30;
            else if (type === 'Premium') basePrice = 50;
            else if (type === 'Elite') basePrice = 80;
            
            // Apply discount for longer durations
            let discount = 1;
            if (duration === 3) discount = 0.95; // 5% discount for 3 months
            else if (duration === 6) discount = 0.9; // 10% discount for 6 months
            else if (duration === 12) discount = 0.85; // 15% discount for 12 months
            
            // Calculate total price
            if (basePrice > 0) {
                const totalPrice = (basePrice * duration * discount).toFixed(2);
                priceInput.value = totalPrice;
            }
        }
        
        typeSelect.addEventListener('change', updatePrice);
        durationSelect.addEventListener('change', updatePrice);
        
        // Update price on initial load if type is already selected
        if (typeSelect.value) {
            updatePrice();
        }
    });
</script>
@endsection