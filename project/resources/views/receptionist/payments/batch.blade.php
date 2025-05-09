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
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">Batch Payment Processing</h1>
                        </div>
                        <a href="{{ route('receptionist.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Payments
                        </a>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Instructions Card -->
                    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg mb-6 border border-gray-200">
                        <div class="px-4 py-5 sm:p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Process Multiple Payments</h3>
                            </div>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p>Use this form to process payments for multiple subscriptions at once. Select the subscriptions you want to process, enter the payment details, and submit the form.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Batch Payment Form -->
                    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg border border-gray-200">
                        <form action="{{ route('receptionist.payments.batch.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6">
                                <!-- Payment Method and Date Section -->
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mb-6">
                                    <div>
                                        <label for="method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </div>
                                            <select id="method" name="method" required class="pl-10 block w-full rounded-md border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Select a method</option>
                                                <option value="cash">Cash</option>
                                                <option value="credit_card">Credit Card</option>
                                                <option value="debit_card">Debit Card</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="mobile_payment">Mobile Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <select id="status" name="status" required class="pl-10 block w-full rounded-md border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected>Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Box -->
                                <div class="mb-6">
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search Members</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <div class="relative flex-grow focus-within:z-10">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <input type="text" name="search" id="search" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="Enter name, email or subscription ID">
                                        </div>
                                        <button type="button" onclick="searchMembers()" class="relative inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            <span class="ml-2">Search</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Subscription Selection Table -->
                                <div class="overflow-x-auto border border-gray-200 rounded-md shadow-sm mb-6">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex items-center">
                                                        <input id="select-all" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" onchange="toggleAll(this)">
                                                        <label for="select-all" class="ml-2">Select All</label>
                                                    </div>
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Member
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Subscription
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date Range
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Amount
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="subscriptions-table-body">
                                            @forelse($pendingSubscriptions ?? [] as $subscription)
                                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="checkbox" name="subscriptions[]" value="{{ $subscription->id }}" 
                                                            data-amount="{{ $subscription->price }}"
                                                            class="subscription-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                            onchange="updateTotal()">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                                                <span class="text-white font-semibold">{{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $subscription->user->firstname }} {{ $subscription->user->lastname }}
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    {{ $subscription->user->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $subscription->type }}</div>
                                                        <div class="text-sm text-gray-500">{{ $subscription->duration }} month(s)</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }} - 
                                                        {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ ucfirst($subscription->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        ${{ number_format($subscription->price, 2) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                        </svg>
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No pending subscriptions found</h3>
                                                        <p class="mt-1 text-sm text-gray-500">Use the search box to find members or subscriptions.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot class="bg-gray-50">
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                                    Total:
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    $<span id="total-amount" class="text-blue-600 font-bold">0.00</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Summary Card -->
                                <div class="bg-gray-50 rounded-lg border border-gray-200 shadow-sm p-4 mb-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <h4 class="text-md font-medium text-gray-900">Batch Summary</h4>
                                        </div>
                                        <span class="text-gray-500 text-sm"><span id="selected-count">0</span> subscriptions selected</span>
                                    </div>
                                    <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                        <div class="bg-white p-3 rounded-md border border-gray-200">
                                            <div class="text-xs text-gray-500">Total Amount</div>
                                            <div class="text-lg font-semibold text-blue-600">$<span id="summary-total">0.00</span></div>
                                        </div>
                                        <div class="bg-white p-3 rounded-md border border-gray-200">
                                            <div class="text-xs text-gray-500">Payment Method</div>
                                            <div class="text-md font-medium text-gray-900" id="summary-method">Not selected</div>
                                        </div>
                                        <div class="bg-white p-3 rounded-md border border-gray-200">
                                            <div class="text-xs text-gray-500">Payment Date</div>
                                            <div class="text-md font-medium text-gray-900" id="summary-date">{{ date('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes Field -->
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Payment Notes</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </div>
                                        <textarea id="notes" name="notes" rows="3" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Add any notes about this batch payment..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t border-gray-200">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    Process Batch Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle all checkboxes
    function toggleAll(source) {
        const checkboxes = document.getElementsByClassName('subscription-checkbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = source.checked;
        }
        updateTotal();
    }

    // Update total amount
    function updateTotal() {
        let total = 0;
        let count = 0;
        const checkboxes = document.getElementsByClassName('subscription-checkbox');
        for (let checkbox of checkboxes) {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('data-amount'));
                count++;
            }
        }
        
        // Update displayed totals
        document.getElementById('total-amount').textContent = total.toFixed(2);
        document.getElementById('summary-total').textContent = total.toFixed(2);
        document.getElementById('selected-count').textContent = count;
        
        // Update payment method in summary
        const methodSelect = document.getElementById('method');
        if (methodSelect.value) {
            const methodText = methodSelect.options[methodSelect.selectedIndex].text;
            document.getElementById('summary-method').textContent = methodText;
        } else {
            document.getElementById('summary-method').textContent = 'Not selected';
        }
        
        // Update date in summary
        const dateInput = document.getElementById('date');
        if (dateInput.value) {
            const dateObj = new Date(dateInput.value);
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            document.getElementById('summary-date').textContent = dateObj.toLocaleDateString('en-US', options);
        }
    }

    // Search members and subscriptions
    function searchMembers() {
        const searchTerm = document.getElementById('search').value.trim();
        if (searchTerm === '') return;

        // Show loading state
        const tableBody = document.getElementById('subscriptions-table-body');
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin mx-auto h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-700">Searching...</p>
                </td>
            </tr>
        `;

        // Make AJAX call
        fetch(`{{ route('receptionist.payments.search') }}?term=${encodeURIComponent(searchTerm)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the table with search results
            tableBody.innerHTML = '';
            
            if (data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No results found</h3>
                            <p class="mt-1 text-sm text-gray-500">No subscriptions found matching "${searchTerm}".</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            // Add each subscription to the table
            data.forEach(subscription => {
                tableBody.innerHTML += `
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="subscriptions[]" value="${subscription.id}" 
                                data-amount="${subscription.price}"
                                class="subscription-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                onchange="updateTotal()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                    <span class="text-white font-semibold">${subscription.user.firstname.charAt(0)}${subscription.user.lastname.charAt(0)}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        ${subscription.user.firstname} ${subscription.user.lastname}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ${subscription.user.email}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${subscription.type}</div>
                            <div class="text-sm text-gray-500">${subscription.duration} month(s)</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${new Date(subscription.start_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })} - 
                            ${new Date(subscription.end_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                ${subscription.status.charAt(0).toUpperCase() + subscription.status.slice(1)}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            $${parseFloat(subscription.price).toFixed(2)}
                        </td>
                    </tr>
                `;
            });
            
            // Update the total (which will be 0 since no checkboxes are checked yet)
            updateTotal();
        })
        .catch(error => {
            console.error('Error searching members:', error);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Something went wrong</h3>
                        <p class="mt-1 text-sm text-gray-500">An error occurred while searching. Please try again.</p>
                    </td>
                </tr>
            `;
        });
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Initial setup
        updateTotal();
        
        // Listen for method changes
        document.getElementById('method').addEventListener('change', updateTotal);
        
        // Listen for date changes
        document.getElementById('date').addEventListener('change', updateTotal);
        
        // Allow pressing Enter to search
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchMembers();
            }
        });
    });
</script>

<style>
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
@endsection