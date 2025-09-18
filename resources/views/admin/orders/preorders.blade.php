@extends('layouts.admin')

@section('title', 'Pre-orders Management')
@section('page-title', 'Pre-orders Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-xl font-semibold text-earth-800">Pre-orders</h2>
            <p class="text-earth-600">Manage customer pre-orders for out-of-stock products</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search pre-orders..." 
                       class="pl-10 pr-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
            </div>
            
            <button class="btn-3d px-6 py-2">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>
</div>

<!-- Pre-orders Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 border border-orange-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-orange-500">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Total Pre-orders</p>
                <p class="text-2xl font-bold text-orange-600">{{ $preorders->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-blue-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500">
                <i class="fas fa-box text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Products</p>
                <p class="text-2xl font-bold text-blue-600">{{ $preorders->pluck('product_id')->unique()->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-green-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500">
                <i class="fas fa-dollar-sign text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Potential Revenue</p>
                <p class="text-2xl font-bold text-green-600">${{ number_format($preorders->sum(function($order) { return $order->total_amount; }), 2) }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-purple-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Customers</p>
                <p class="text-2xl font-bold text-purple-600">{{ $preorders->pluck('customer_email')->unique()->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Pre-orders Table -->
<div class="glass rounded-3xl shadow-xl overflow-hidden border border-primary-200">
    <div class="px-6 py-4 bg-gradient-to-r from-primary-50 to-secondary-50 border-b border-primary-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold gradient-text">Pre-order Requests</h3>
            
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-primary-500 text-white rounded-full text-sm font-semibold hover:bg-primary-600 transition-colors">
                    <i class="fas fa-bell mr-2"></i>Notify All
                </button>
                
                <button class="px-4 py-2 bg-secondary-500 text-white rounded-full text-sm font-semibold hover:bg-secondary-600 transition-colors">
                    <i class="fas fa-check-double mr-2"></i>Convert to Orders
                </button>
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-earth-200">
            <thead class="bg-earth-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">
                        <input type="checkbox" class="rounded border-earth-300 text-primary-600 focus:ring-primary-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Pre-order</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-earth-200">
                @forelse($preorders as $preorder)
                    <tr class="hover:bg-primary-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="rounded border-earth-300 text-primary-600 focus:ring-primary-500" value="{{ $preorder->id }}">
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-sm">
                                    #{{ substr($preorder->order_number, -3) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-earth-800">#{{ $preorder->order_number }}</p>
                                    <p class="text-xs text-earth-600">Pre-order</p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-semibold text-earth-800">{{ $preorder->customer_name }}</p>
                                <p class="text-xs text-earth-600">{{ $preorder->customer_email }}</p>
                                @if($preorder->customer_phone)
                                    <p class="text-xs text-earth-500">{{ $preorder->customer_phone }}</p>
                                @endif
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-spa text-white"></i>
                                </div>
                                <div>
                                    @foreach($preorder->orderItems as $item)
                                        <p class="text-sm font-semibold text-earth-800">{{ $item->product->name ?? 'Product' }}</p>
                                        <p class="text-xs text-earth-600">{{ $item->product->category->name ?? 'Category' }}</p>
                                        @if($item->product && $item->product->quantity <= 0)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Out of Stock
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                In Stock
                                            </span>
                                        @endif
                                        @break
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-earth-800">
                                {{ $preorder->orderItems->sum('quantity') }} items
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-earth-800">${{ number_format($preorder->total_amount, 2) }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-earth-600">
                            <div>{{ $preorder->created_at->format('M d, Y') }}</div>
                            <div class="text-xs">{{ $preorder->created_at->diffForHumans() }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $canFulfill = $preorder->orderItems->every(function($item) {
                                    return $item->product && $item->product->quantity >= $item->quantity;
                                });
                            @endphp
                            
                            @if($canFulfill)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    Ready to Ship
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 border border-orange-200">
                                    Waiting for Stock
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.orders.show', $preorder) }}" 
                                   class="text-primary-600 hover:text-primary-800 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($canFulfill)
                                    <form method="POST" action="{{ route('admin.orders.update-status', $preorder) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-800 transition-colors" 
                                                title="Convert to Order">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <button class="text-secondary-600 hover:text-secondary-800 transition-colors" 
                                        title="Send Notification"
                                        onclick="sendNotification({{ $preorder->id }})">
                                    <i class="fas fa-bell"></i>
                                </button>
                                
                                <button class="text-red-600 hover:text-red-800 transition-colors" 
                                        title="Cancel Pre-order"
                                        onclick="cancelPreorder({{ $preorder->id }})">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-clock text-4xl text-earth-400 mb-4"></i>
                                <h3 class="text-lg font-semibold text-earth-600 mb-2">No Pre-orders Found</h3>
                                <p class="text-earth-500">Pre-orders will appear here when customers order out-of-stock products</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($preorders->hasPages())
        <div class="px-6 py-4 bg-earth-50 border-t border-earth-200">
            {{ $preorders->links() }}
        </div>
    @endif
</div>

<!-- Bulk Actions Modal -->
<div id="bulkActionsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="glass rounded-3xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold gradient-text mb-4">Bulk Actions</h3>
        
        <div class="space-y-4">
            <button class="w-full btn-3d py-3" onclick="bulkNotify()">
                <i class="fas fa-bell mr-2"></i>Send Notifications
            </button>
            
            <button class="w-full btn-ayurveda py-3" onclick="bulkConvert()">
                <i class="fas fa-check-double mr-2"></i>Convert to Orders
            </button>
            
            <button class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-2xl transition-colors" onclick="bulkCancel()">
                <i class="fas fa-times mr-2"></i>Cancel Pre-orders
            </button>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
            <button onclick="closeBulkModal()" class="px-4 py-2 text-earth-600 hover:text-earth-800">Cancel</button>
        </div>
    </div>
</div>

<script>
function sendNotification(preorderId) {
    if (confirm('Send stock availability notification to customer?')) {
        // AJAX call to send notification
        fetch(`/admin/preorders/${preorderId}/notify`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Notification sent successfully!');
            } else {
                alert('Failed to send notification.');
            }
        });
    }
}

function cancelPreorder(preorderId) {
    if (confirm('Are you sure you want to cancel this pre-order?')) {
        // AJAX call to cancel preorder
        fetch(`/admin/preorders/${preorderId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to cancel pre-order.');
            }
        });
    }
}

function bulkNotify() {
    const selected = getSelectedPreorders();
    if (selected.length === 0) {
        alert('Please select pre-orders first.');
        return;
    }
    
    if (confirm(`Send notifications for ${selected.length} pre-orders?`)) {
        // Bulk notification logic
        console.log('Bulk notify:', selected);
        closeBulkModal();
    }
}

function bulkConvert() {
    const selected = getSelectedPreorders();
    if (selected.length === 0) {
        alert('Please select pre-orders first.');
        return;
    }
    
    if (confirm(`Convert ${selected.length} pre-orders to regular orders?`)) {
        // Bulk convert logic
        console.log('Bulk convert:', selected);
        closeBulkModal();
    }
}

function bulkCancel() {
    const selected = getSelectedPreorders();
    if (selected.length === 0) {
        alert('Please select pre-orders first.');
        return;
    }
    
    if (confirm(`Cancel ${selected.length} pre-orders? This action cannot be undone.`)) {
        // Bulk cancel logic
        console.log('Bulk cancel:', selected);
        closeBulkModal();
    }
}

function getSelectedPreorders() {
    return Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
        .map(cb => cb.value)
        .filter(val => val);
}

function closeBulkModal() {
    document.getElementById('bulkActionsModal').classList.add('hidden');
}

// Show bulk actions when checkboxes are selected
document.addEventListener('change', function(e) {
    if (e.target.type === 'checkbox') {
        const selected = getSelectedPreorders();
        if (selected.length > 0) {
            // Show bulk actions button or modal
        }
    }
});
</script>
@endsection
