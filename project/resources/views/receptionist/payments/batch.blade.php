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
                        <h1 class="text-2xl font-semibold text-gray-900">Batch Payment Processing</h1>
                        <a href="{{ route('receptionist.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Payments
                        </a>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Instructions Card -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Process Multiple Payments</h3>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p>Use this form to process payments for multiple subscriptions at once. Select the subscriptions you want to process, enter the payment details, and submit the form.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Batch Payment Form -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <form action="{{ route('receptionist.payments.batch.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6">
                                <!-- Payment Method and Date Section -->
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mb-6">
                                    <div>
                                        <label for="method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <select id="method" name="method" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a method</option>
                                            <option value="cash">Cash</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="debit_card">Debit Card</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="mobile_payment">Mobile Payment</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                                        <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                        <select id="status" name="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="pending">Pending</option>
                                            <option value="paid" selected>Paid</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Search Box -->
                                <div class="mb-6">
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search Members</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="Enter name, email or subscription ID">
                                        <button type="button" onclick="searchMembers()" class="inline-flex items-center px-3 py-2 border border-l-0 border-gray-300 bg-gray-50 text-gray-500 rounded-r-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Subscription Selection Table -->
                                <div class="overflow-x-auto border border-gray-200 rounded-md">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <div class="flex items-center">
                                                        <input id="select-all" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" onchange="toggleAll(this)">
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
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <input type="checkbox" name="subscriptions[]" value="{{ $subscription->id }}" 
                                                            data-amount="{{ $subscription->price }}"
                                                            class="subscription-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                                            onchange="updateTotal()">
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                <span class="text-indigo-700 font-semibold">{{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}</span>
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
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ ucfirst($subscription->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        ${{ number_format($subscription->price, 2) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        No pending subscriptions found. Use the search box to find members.
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
                                                    $<span id="total-amount">0.00</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Notes Field -->
                                <div class="mt-6">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Payment Notes</label>
                                    <textarea id="notes" name="notes" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Add any notes about this batch payment..."></textarea>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
        const checkboxes = document.getElementsByClassName('subscription-checkbox');
        for (let checkbox of checkboxes) {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('data-amount'));
            }
        }
        
        document.getElementById('total-amount').textContent = total.toFixed(2);
    }

    // Search members and subscriptions
    function searchMembers() {
        const searchTerm = document.getElementById('search').value.trim();
        if (searchTerm === '') return;

        // Here you would typically make an AJAX call to your backend
        // For demonstration, we'll just show an alert
        fetch(`{{ route('receptionist.payments.search') }}?term=${encodeURIComponent(searchTerm)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the table with search results
            const tableBody = document.getElementById('subscriptions-table-body');
            tableBody.innerHTML = '';
            
            if (data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No subscriptions found matching "${searchTerm}".
                        </td>
                    </tr>
                `;
                return;
            }
            
            // Add each subscription to the table
            data.forEach(subscription => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="subscriptions[]" value="${subscription.id}" 
                                data-amount="${subscription.price}"
                                class="subscription-checkbox h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                onchange="updateTotal()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-indigo-700 font-semibold">${subscription.user.firstname.charAt(0)}${subscription.user.lastname.charAt(0)}</span>
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
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                ${subscription.status.charAt(0).toUpperCase() + subscription.status.slice(1)}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
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
            alert('An error occurred while searching. Please try again.');
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateTotal();
    });
</script>
@endsection