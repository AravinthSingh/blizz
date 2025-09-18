@extends('layouts.admin')

@section('title', 'Orders Management')
@section('page-title', 'Orders Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-xl font-semibold text-earth-800">All Orders</h2>
            <p class="text-earth-600">Manage customer orders and track their status</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search orders..." 
                       class="pl-10 pr-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
            </div>
            
            <select class="px-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>
</div>

<!-- Orders Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 border border-yellow-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Pending</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $orders->where('status', 'pending')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-blue-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500">
                <i class="fas fa-cog text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Processing</p>
                <p class="text-2xl font-bold text-blue-600">{{ $orders->where('status', 'processing')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-purple-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500">
                <i class="fas fa-shipping-fast text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Shipped</p>
                <p class="text-2xl font-bold text-purple-600">{{ $orders->where('status', 'shipped')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-green-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Delivered</p>
                <p class="text-2xl font-bold text-green-600">{{ $orders->where('status', 'delivered')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="glass rounded-3xl shadow-xl overflow-hidden border border-primary-200">
    <div class="px-6 py-4 bg-gradient-to-r from-primary-50 to-secondary-50 border-b border-primary-200">
        <h3 class="text-lg font-semibold gradient-text">Recent Orders</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-earth-200">
            <thead class="bg-earth-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Products</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-earth-200">
                @forelse($orders as $order)
                    <tr class="hover:bg-primary-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-sm">
                                    #{{ substr($order->order_number, -3) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-earth-800">#{{ $order->order_number }}</p>
                                    <p class="text-xs text-earth-600">{{ $order->orderItems->count() }} items</p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="text-sm font-semibold text-earth-800">{{ $order->customer_name }}</p>
                                <p class="text-xs text-earth-600">{{ $order->customer_email }}</p>
                                <p class="text-xs text-earth-500">{{ $order->customer_phone }}</p>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                @foreach($order->orderItems->take(2) as $item)
                                    <div class="flex items-center text-sm">
                                        <span class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center text-xs font-semibold text-primary-600 mr-2">
                                            {{ $item->quantity }}
                                        </span>
                                        <span class="text-earth-700 truncate">{{ $item->product->name ?? 'Product' }}</span>
                                    </div>
                                @endforeach
                                @if($order->orderItems->count() > 2)
                                    <p class="text-xs text-earth-500">+{{ $order->orderItems->count() - 2 }} more items</p>
                                @endif
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-earth-800">${{ number_format($order->total_amount, 2) }}</div>
                            <div class="text-xs text-earth-600">{{ $order->payment_method ?? 'Card' }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                                    'delivered' => 'bg-green-100 text-green-800 border-green-200',
                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    'completed' => 'bg-primary-100 text-primary-800 border-primary-200'
                                ];
                                $statusClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                            @endphp
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full border {{ $statusClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-earth-600">
                            <div>{{ $order->created_at->format('M d, Y') }}</div>
                            <div class="text-xs">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="text-primary-600 hover:text-primary-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <div class="relative group">
                                    <button class="text-secondary-600 hover:text-secondary-800 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Status Update Dropdown -->
                                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-earth-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                                        <div class="p-2">
                                            <p class="text-xs font-semibold text-earth-600 mb-2 px-2">Update Status</p>
                                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                    <button type="submit" 
                                                            class="w-full text-left px-3 py-2 text-sm text-earth-700 hover:bg-primary-50 rounded-lg transition-colors {{ $order->status === $status ? 'bg-primary-100 font-semibold' : '' }}">
                                                        {{ ucfirst($status) }}
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-shopping-cart text-4xl text-earth-400 mb-4"></i>
                                <h3 class="text-lg font-semibold text-earth-600 mb-2">No Orders Found</h3>
                                <p class="text-earth-500">Orders will appear here once customers start purchasing</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
        <div class="px-6 py-4 bg-earth-50 border-t border-earth-200">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
