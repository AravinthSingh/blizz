@extends('layouts.admin')

@section('title', 'Stock Check')
@section('page-title', 'Inventory & Stock Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-xl font-semibold text-earth-800">Stock Overview</h2>
            <p class="text-earth-600">Monitor product availability and inventory levels</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search products..." 
                       class="pl-10 pr-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
            </div>
            
            <select class="px-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
            <button class="btn-3d px-6 py-2" onclick="exportStock()">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>
</div>

<!-- Stock Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 border border-green-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">In Stock</p>
                <p class="text-2xl font-bold text-green-600">{{ $products->where('quantity', '>', 5)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-yellow-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500">
                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Low Stock</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $products->whereBetween('quantity', [1, 5])->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-red-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-500">
                <i class="fas fa-times-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Out of Stock</p>
                <p class="text-2xl font-bold text-red-600">{{ $products->where('quantity', 0)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-blue-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500">
                <i class="fas fa-box text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Total Products</p>
                <p class="text-2xl font-bold text-blue-600">{{ $products->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Stock Alerts -->
@if($lowStockProducts->count() > 0 || $outOfStockProducts->count() > 0)
    <div class="mb-8">
        <div class="glass rounded-3xl shadow-xl p-6 border border-red-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-red-700">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Stock Alerts
                </h3>
                <button class="btn-ayurveda px-4 py-2" onclick="bulkRestock()">
                    <i class="fas fa-plus mr-2"></i>Bulk Restock
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($outOfStockProducts->count() > 0)
                    <div class="bg-red-50 rounded-2xl p-4 border border-red-200">
                        <h4 class="font-semibold text-red-800 mb-3">
                            <i class="fas fa-times-circle mr-2"></i>Out of Stock ({{ $outOfStockProducts->count() }})
                        </h4>
                        <div class="space-y-2 max-h-32 overflow-y-auto">
                            @foreach($outOfStockProducts->take(5) as $product)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-red-700">{{ $product->name }}</span>
                                    <button onclick="quickRestock({{ $product->id }})" 
                                            class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            @endforeach
                            @if($outOfStockProducts->count() > 5)
                                <p class="text-xs text-red-600">+{{ $outOfStockProducts->count() - 5 }} more products</p>
                            @endif
                        </div>
                    </div>
                @endif
                
                @if($lowStockProducts->count() > 0)
                    <div class="bg-yellow-50 rounded-2xl p-4 border border-yellow-200">
                        <h4 class="font-semibold text-yellow-800 mb-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Low Stock ({{ $lowStockProducts->count() }})
                        </h4>
                        <div class="space-y-2 max-h-32 overflow-y-auto">
                            @foreach($lowStockProducts->take(5) as $product)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-yellow-700">{{ $product->name }}</span>
                                    <span class="text-yellow-600 font-semibold">{{ $product->quantity }} left</span>
                                </div>
                            @endforeach
                            @if($lowStockProducts->count() > 5)
                                <p class="text-xs text-yellow-600">+{{ $lowStockProducts->count() - 5 }} more products</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif

<!-- Stock Table -->
<div class="glass rounded-3xl shadow-xl overflow-hidden border border-primary-200">
    <div class="px-6 py-4 bg-gradient-to-r from-primary-50 to-secondary-50 border-b border-primary-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold gradient-text">Product Inventory</h3>
            
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-primary-500 text-white rounded-full text-sm font-semibold hover:bg-primary-600 transition-colors">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                
                <button class="px-4 py-2 bg-secondary-500 text-white rounded-full text-sm font-semibold hover:bg-secondary-600 transition-colors">
                    <i class="fas fa-sort mr-2"></i>Sort
                </button>
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-earth-200">
            <thead class="bg-earth-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Last Updated</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-earth-200">
                @forelse($products as $product)
                    <tr class="hover:bg-primary-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-2xl flex items-center justify-center mr-4">
                                    <i class="fas fa-spa text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-earth-800">{{ $product->name }}</p>
                                    <p class="text-xs text-earth-600">SKU: {{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-primary-100 text-primary-800">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-earth-800">${{ number_format($product->price, 2) }}</div>
                            @if($product->discounted_price)
                                <div class="text-xs text-earth-500 line-through">${{ number_format($product->discounted_price, 2) }}</div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <input type="number" value="{{ $product->quantity }}" 
                                       class="w-20 px-2 py-1 border border-earth-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500"
                                       onchange="updateStock({{ $product->id }}, this.value)">
                                <span class="text-sm text-earth-600">units</span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->quantity > 5)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i>In Stock
                                </span>
                            @elseif($product->quantity > 0)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-times-circle mr-1"></i>Out of Stock
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-earth-600">
                            <div>{{ $product->updated_at->format('M d, Y') }}</div>
                            <div class="text-xs">{{ $product->updated_at->diffForHumans() }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="quickRestock({{ $product->id }})" 
                                        class="text-primary-600 hover:text-primary-800 transition-colors" 
                                        title="Quick Restock">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                                
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="text-secondary-600 hover:text-secondary-800 transition-colors" 
                                   title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button onclick="viewStockHistory({{ $product->id }})" 
                                        class="text-earth-600 hover:text-earth-800 transition-colors" 
                                        title="Stock History">
                                    <i class="fas fa-history"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-box text-4xl text-earth-400 mb-4"></i>
                                <h3 class="text-lg font-semibold text-earth-600 mb-2">No Products Found</h3>
                                <p class="text-earth-500">Add products to start managing inventory</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
        <div class="px-6 py-4 bg-earth-50 border-t border-earth-200">
            {{ $products->links() }}
        </div>
    @endif
</div>

<!-- Quick Restock Modal -->
<div id="restockModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="glass rounded-3xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold gradient-text mb-4">Quick Restock</h3>
        
        <form id="restockForm">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-earth-700 mb-2">Product</label>
                <p id="restockProductName" class="text-earth-800 font-semibold"></p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-earth-700 mb-2">Current Stock</label>
                <p id="currentStock" class="text-earth-600"></p>
            </div>
            
            <div class="mb-6">
                <label for="addQuantity" class="block text-sm font-semibold text-earth-700 mb-2">Add Quantity</label>
                <input type="number" id="addQuantity" min="1" value="10"
                       class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeRestockModal()" 
                        class="px-6 py-3 text-earth-600 hover:text-earth-800 font-semibold">
                    Cancel
                </button>
                <button type="submit" class="btn-3d px-8 py-3">
                    <i class="fas fa-plus mr-2"></i>Add Stock
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let currentProductId = null;

function quickRestock(productId) {
    currentProductId = productId;
    // In a real app, you'd fetch product details via AJAX
    document.getElementById('restockProductName').textContent = 'Product Name';
    document.getElementById('currentStock').textContent = '0 units';
    document.getElementById('restockModal').classList.remove('hidden');
    document.getElementById('restockModal').classList.add('flex');
}

function closeRestockModal() {
    document.getElementById('restockModal').classList.add('hidden');
    document.getElementById('restockModal').classList.remove('flex');
    currentProductId = null;
}

function updateStock(productId, newQuantity) {
    // AJAX call to update stock
    fetch(`/admin/products/${productId}/update-stock`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI to reflect new stock level
            location.reload();
        } else {
            alert('Failed to update stock');
        }
    });
}

function bulkRestock() {
    if (confirm('Open bulk restock interface?')) {
        // Redirect to bulk restock page or open modal
        alert('Bulk restock feature coming soon!');
    }
}

function exportStock() {
    // Export stock data
    window.location.href = '/admin/stock/export';
}

function viewStockHistory(productId) {
    // Show stock history modal or redirect
    alert('Stock history feature coming soon!');
}

// Handle restock form submission
document.getElementById('restockForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const addQuantity = document.getElementById('addQuantity').value;
    
    if (currentProductId && addQuantity > 0) {
        fetch(`/admin/products/${currentProductId}/add-stock`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: parseInt(addQuantity) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeRestockModal();
                location.reload();
            } else {
                alert('Failed to add stock');
            }
        });
    }
});

// Close modal when clicking outside
document.getElementById('restockModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRestockModal();
    }
});
</script>
@endsection
