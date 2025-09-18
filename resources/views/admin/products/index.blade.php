@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products Management')

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h2 class="text-xl font-semibold text-earth-800">All Products</h2>
            <p class="text-earth-600">Manage your Ayurvedic product catalog</p>
        </div>
        
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search products..." 
                       class="pl-10 pr-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-earth-400"></i>
            </div>
            
            <select class="px-4 py-2 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
            <a href="{{ route('admin.products.create') }}" class="btn-3d px-6 py-2">
                <i class="fas fa-plus mr-2"></i>Add New Product
            </a>
        </div>
    </div>
</div>

<!-- Products Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="glass rounded-2xl p-6 border border-primary-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-primary-500">
                <i class="fas fa-spa text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">Total Products</p>
                <p class="text-2xl font-bold text-primary-600">{{ $products->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="glass rounded-2xl p-6 border border-green-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-semibold text-earth-600">In Stock</p>
                <p class="text-2xl font-bold text-green-600">{{ $products->where('quantity', '>', 0)->count() }}</p>
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
</div>

<div class="glass rounded-3xl shadow-xl overflow-hidden border border-primary-200">
    <div class="px-6 py-4 bg-gradient-to-r from-primary-50 to-secondary-50 border-b border-primary-200">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold gradient-text">Product Catalog</h3>
            
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-primary-500 text-white rounded-full text-sm font-semibold hover:bg-primary-600 transition-colors">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                
                <button class="px-4 py-2 bg-secondary-500 text-white rounded-full text-sm font-semibold hover:bg-secondary-600 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-earth-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-earth-200">
                @forelse($products as $product)
                    <tr class="hover:bg-primary-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($product->images && count($product->images) > 0)
                                        <img class="h-12 w-12 rounded-2xl object-cover border-2 border-primary-200" src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-primary-200 to-secondary-200 flex items-center justify-center border-2 border-primary-200">
                                            <i class="fas fa-spa text-primary-600"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-earth-800">{{ $product->name }}</div>
                                    <div class="text-xs text-earth-600">{{ $product->main_category }}</div>
                                    <div class="text-xs text-earth-500">SKU: {{ $product->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-primary-100 text-primary-800 border border-primary-200">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-earth-800">
                                @if($product->discounted_price)
                                    <span class="text-lg font-bold text-secondary-600">${{ number_format($product->discounted_price, 2) }}</span>
                                    <div class="text-xs text-earth-500 line-through">${{ number_format($product->price, 2) }}</div>
                                    <div class="text-xs text-green-600 font-semibold">{{ $product->discount_percentage }}% OFF</div>
                                @else
                                    <span class="text-lg font-bold text-earth-700">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->quantity > 5)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i>{{ $product->quantity }} in stock
                                </span>
                            @elseif($product->quantity > 0)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $product->quantity }} left
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-times-circle mr-1"></i>Out of stock
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active ?? true)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-toggle-on mr-1"></i>Active
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-toggle-off mr-1"></i>Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.show', $product) }}" 
                                   class="w-8 h-8 bg-primary-100 hover:bg-primary-200 text-primary-600 rounded-full flex items-center justify-center transition-colors duration-200" 
                                   title="View Product">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="w-8 h-8 bg-secondary-100 hover:bg-secondary-200 text-secondary-600 rounded-full flex items-center justify-center transition-colors duration-200" 
                                   title="Edit Product">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors duration-200" 
                                            title="Delete Product">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-24 h-24 bg-gradient-to-br from-primary-200 to-secondary-200 rounded-3xl flex items-center justify-center mb-4">
                                    <i class="fas fa-spa text-4xl text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-earth-600 mb-2">No Products Found</h3>
                                <p class="text-earth-500 mb-6">Start building your Ayurvedic product catalog</p>
                                <a href="{{ route('admin.products.create') }}" class="btn-3d px-6 py-3">
                                    <i class="fas fa-plus mr-2"></i>Add Your First Product
                                </a>
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

<script>
// Search functionality
document.querySelector('input[placeholder="Search products..."]').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const productName = row.querySelector('td:first-child .text-sm')?.textContent.toLowerCase() || '';
        const category = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
        
        if (productName.includes(searchTerm) || category.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Category filter
document.querySelector('select').addEventListener('change', function(e) {
    const selectedCategory = e.target.value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const categorySpan = row.querySelector('td:nth-child(2) span');
        if (!categorySpan) return;
        
        const categoryText = categorySpan.textContent.trim();
        
        if (!selectedCategory || categoryText.includes(selectedCategory)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Enhanced delete confirmation
document.querySelectorAll('form[method="POST"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const productName = this.closest('tr').querySelector('.text-sm').textContent;
        
        if (confirm(`Are you sure you want to delete "${productName}"?\n\nThis action cannot be undone and will permanently remove the product from your catalog.`)) {
            this.submit();
        }
    });
});

// Tooltip functionality for action buttons
document.querySelectorAll('[title]').forEach(element => {
    element.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
    });
    
    element.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});

// Export functionality
document.querySelector('button[title="Export"]')?.addEventListener('click', function() {
    // This would typically trigger an export
    alert('Export functionality coming soon!');
});

// Filter functionality
document.querySelector('button[title="Filter"]')?.addEventListener('click', function() {
    // This would typically open a filter modal
    alert('Advanced filter functionality coming soon!');
});
</script>
@endsection
