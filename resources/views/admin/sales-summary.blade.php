@extends('layouts.admin')

@section('title', 'Sales Summary')
@section('page-title', 'Sales Summary')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Revenue Cards -->
    <div class="glass rounded-2xl shadow-lg p-6 border border-primary-200">
        <div class="flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-r from-primary-500 to-primary-600">
                <i class="fas fa-dollar-sign text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="mb-2 text-sm font-semibold text-earth-600">Total Revenue</p>
                <p class="text-2xl font-bold gradient-text">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl shadow-lg p-6 border border-secondary-200">
        <div class="flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-r from-secondary-500 to-secondary-600">
                <i class="fas fa-calendar-month text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="mb-2 text-sm font-semibold text-earth-600">This Month</p>
                <p class="text-2xl font-bold gradient-text">${{ number_format($monthlyRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl shadow-lg p-6 border border-earth-200">
        <div class="flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-r from-earth-500 to-earth-600">
                <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="mb-2 text-sm font-semibold text-earth-600">Growth Rate</p>
                <p class="text-2xl font-bold text-primary-600">+15.3%</p>
            </div>
        </div>
    </div>

    <div class="glass rounded-2xl shadow-lg p-6 border border-primary-200">
        <div class="flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-r from-purple-500 to-purple-600">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <div class="ml-4">
                <p class="mb-2 text-sm font-semibold text-earth-600">Customers</p>
                <p class="text-2xl font-bold gradient-text">{{ $ordersByStatus->sum() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Orders by Status Chart -->
    <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold gradient-text">Orders by Status</h3>
            <i class="fas fa-chart-pie text-2xl text-primary-600"></i>
        </div>
        
        <div class="space-y-4">
            @foreach($ordersByStatus as $status => $count)
                @php
                    $percentage = $ordersByStatus->sum() > 0 ? ($count / $ordersByStatus->sum()) * 100 : 0;
                    $statusColors = [
                        'pending' => 'bg-yellow-500',
                        'processing' => 'bg-blue-500', 
                        'shipped' => 'bg-purple-500',
                        'delivered' => 'bg-green-500',
                        'cancelled' => 'bg-red-500',
                        'completed' => 'bg-primary-500'
                    ];
                    $color = $statusColors[$status] ?? 'bg-gray-500';
                @endphp
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-4 h-4 rounded-full {{ $color }} mr-3"></div>
                        <span class="font-semibold text-earth-700 capitalize">{{ $status }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-earth-600">{{ $count }} orders</span>
                        <span class="font-bold text-primary-600">{{ number_format($percentage, 1) }}%</span>
                    </div>
                </div>
                
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="h-2 rounded-full {{ $color }}" style="width: {{ $percentage }}%"></div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Top Products -->
    <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold gradient-text">Top Selling Products</h3>
            <i class="fas fa-trophy text-2xl text-secondary-600"></i>
        </div>
        
        <div class="space-y-4">
            @forelse($topProducts as $index => $product)
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-2xl border border-primary-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="font-semibold text-earth-800">{{ $product->name }}</p>
                            <p class="text-sm text-earth-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-primary-600">{{ $product->order_items_count ?? 0 }} sold</p>
                        <p class="text-sm text-earth-600">Stock: {{ $product->quantity }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-chart-bar text-4xl text-earth-400 mb-4"></i>
                    <p class="text-earth-600">No sales data available yet</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Monthly Revenue Chart -->
<div class="mt-8">
    <div class="glass rounded-3xl shadow-xl p-8 border border-earth-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold gradient-text">Revenue Trends</h3>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-primary-500 text-white rounded-full text-sm font-semibold hover:bg-primary-600 transition-colors">
                    Monthly
                </button>
                <button class="px-4 py-2 bg-gray-200 text-earth-700 rounded-full text-sm font-semibold hover:bg-gray-300 transition-colors">
                    Weekly
                </button>
            </div>
        </div>
        
        <div class="h-64 flex items-end justify-between space-x-2">
            @for($i = 1; $i <= 12; $i++)
                @php
                    $height = rand(20, 90);
                    $amount = rand(1000, 5000);
                @endphp
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-full bg-gradient-to-t from-primary-500 to-secondary-500 rounded-t-lg hover:from-primary-600 hover:to-secondary-600 transition-all duration-300 cursor-pointer" 
                         style="height: {{ $height }}%"
                         title="Month {{ $i }}: ${{ number_format($amount) }}">
                    </div>
                    <span class="text-xs text-earth-600 mt-2">{{ date('M', mktime(0, 0, 0, $i, 1)) }}</span>
                </div>
            @endfor
        </div>
    </div>
</div>

<script>
    // Add some interactivity to charts
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars
        const progressBars = document.querySelectorAll('[style*="width:"]');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.transition = 'width 1s ease-in-out';
                bar.style.width = width;
            }, 100);
        });
    });
</script>
@endsection
