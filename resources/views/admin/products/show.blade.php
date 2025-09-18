@extends('layouts.admin')

@section('title', 'Product Details')
@section('page-title', $product->name)

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.products.index') }}" class="btn-ayurveda px-4 py-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Products
            </a>
            
            @if($product->quantity > 0)
                <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                    <i class="fas fa-check-circle mr-2"></i>In Stock ({{ $product->quantity }})
                </span>
            @else
                <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                    <i class="fas fa-times-circle mr-2"></i>Out of Stock
                </span>
            @endif
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn-3d px-6 py-2">
                <i class="fas fa-edit mr-2"></i>Edit Product
            </a>
            
            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-6 py-2 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </form>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Product Images & Main Info -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Product Images -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-images mr-3 text-primary-600"></i>Product Images
            </h3>
            
            @if($product->images && count($product->images) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($product->images as $index => $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover rounded-2xl border-2 border-earth-200 group-hover:scale-105 transition-transform duration-300">
                            @if($index === 0)
                                <div class="absolute top-3 left-3 bg-primary-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    Main Image
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                <button onclick="openImageModal('{{ asset('storage/' . $image) }}')" 
                                        class="opacity-0 group-hover:opacity-100 bg-white text-primary-600 px-4 py-2 rounded-full font-semibold transition-all duration-300">
                                    <i class="fas fa-expand mr-2"></i>View Full Size
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gradient-to-br from-primary-200 to-secondary-200 rounded-3xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-spa text-4xl text-primary-600"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-earth-600 mb-2">No Images Available</h4>
                    <p class="text-earth-500">Add images to showcase this product</p>
                </div>
            @endif
        </div>
        
        <!-- Product Description -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-align-left mr-3 text-secondary-600"></i>Product Description
            </h3>
            
            <div class="prose prose-earth max-w-none">
                <p class="text-earth-700 text-lg leading-relaxed">{{ $product->description }}</p>
            </div>
        </div>
        
        <!-- Product Analytics -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-earth-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-chart-bar mr-3 text-earth-600"></i>Product Analytics
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 bg-gradient-to-br from-primary-50 to-primary-100 rounded-2xl border border-primary-200">
                    <div class="text-3xl font-bold text-primary-600 mb-2">{{ $product->orderItems->sum('quantity') ?? 0 }}</div>
                    <div class="text-sm font-semibold text-earth-600">Total Sold</div>
                </div>
                
                <div class="text-center p-4 bg-gradient-to-br from-secondary-50 to-secondary-100 rounded-2xl border border-secondary-200">
                    <div class="text-3xl font-bold text-secondary-600 mb-2">${{ number_format(($product->orderItems->sum('quantity') ?? 0) * $product->price, 2) }}</div>
                    <div class="text-sm font-semibold text-earth-600">Revenue Generated</div>
                </div>
                
                <div class="text-center p-4 bg-gradient-to-br from-earth-50 to-earth-100 rounded-2xl border border-earth-200">
                    <div class="text-3xl font-bold text-earth-600 mb-2">{{ $product->created_at->diffInDays(now()) }}</div>
                    <div class="text-sm font-semibold text-earth-600">Days Active</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Details Sidebar -->
    <div class="space-y-8">
        <!-- Basic Information -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-info-circle mr-3 text-primary-600"></i>Product Details
            </h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">Product ID:</span>
                    <span class="text-earth-600">#{{ $product->id }}</span>
                </div>
                
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">SKU:</span>
                    <span class="text-earth-600 font-mono">{{ $product->slug }}</span>
                </div>
                
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">Category:</span>
                    <span class="inline-flex px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-sm font-semibold">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
                
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">Main Category:</span>
                    <span class="inline-flex px-3 py-1 bg-secondary-100 text-secondary-800 rounded-full text-sm font-semibold">
                        {{ $product->main_category }}
                    </span>
                </div>
                
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">Created:</span>
                    <span class="text-earth-600">{{ $product->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex justify-between items-center py-3">
                    <span class="font-semibold text-earth-700">Last Updated:</span>
                    <span class="text-earth-600">{{ $product->updated_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Pricing Information -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-dollar-sign mr-3 text-secondary-600"></i>Pricing
            </h3>
            
            <div class="space-y-4">
                <div class="text-center p-6 bg-gradient-to-br from-secondary-50 to-earth-50 rounded-2xl border border-secondary-200">
                    <div class="text-4xl font-bold gradient-text mb-2">
                        @if($product->discounted_price)
                            ${{ number_format($product->discounted_price, 2) }}
                        @else
                            ${{ number_format($product->price, 2) }}
                        @endif
                    </div>
                    <div class="text-sm font-semibold text-earth-600">Current Price</div>
                </div>
                
                @if($product->discounted_price)
                    <div class="flex justify-between items-center py-3 border-b border-earth-200">
                        <span class="font-semibold text-earth-700">Original Price:</span>
                        <span class="text-earth-500 line-through">${{ number_format($product->price, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3 border-b border-earth-200">
                        <span class="font-semibold text-earth-700">Discount:</span>
                        <span class="text-red-600 font-semibold">{{ $product->discount_percentage }}% OFF</span>
                    </div>
                    
                    <div class="flex justify-between items-center py-3">
                        <span class="font-semibold text-earth-700">You Save:</span>
                        <span class="text-green-600 font-semibold">${{ number_format($product->price - $product->discounted_price, 2) }}</span>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Inventory Status -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-earth-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-boxes mr-3 text-earth-600"></i>Inventory
            </h3>
            
            <div class="space-y-4">
                <div class="text-center p-6 bg-gradient-to-br from-earth-50 to-primary-50 rounded-2xl border border-earth-200">
                    <div class="text-4xl font-bold text-earth-600 mb-2">{{ $product->quantity }}</div>
                    <div class="text-sm font-semibold text-earth-600">Units in Stock</div>
                </div>
                
                <div class="flex justify-between items-center py-3 border-b border-earth-200">
                    <span class="font-semibold text-earth-700">Pre-orders:</span>
                    <span class="text-earth-600">
                        @if($product->allow_preorder)
                            <i class="fas fa-check text-green-500 mr-1"></i>Enabled
                        @else
                            <i class="fas fa-times text-red-500 mr-1"></i>Disabled
                        @endif
                    </span>
                </div>
                
                <div class="flex justify-between items-center py-3">
                    <span class="font-semibold text-earth-700">Status:</span>
                    @if($product->quantity > 5)
                        <span class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Well Stocked
                        </span>
                    @elseif($product->quantity > 0)
                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Out of Stock
                        </span>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
            <h3 class="text-2xl font-bold gradient-text mb-6">
                <i class="fas fa-bolt mr-3 text-primary-600"></i>Quick Actions
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('products.show', $product) }}" target="_blank" class="w-full btn-3d py-3 text-center block">
                    <i class="fas fa-external-link-alt mr-2"></i>View on Website
                </a>
                
                <button onclick="duplicateProduct({{ $product->id }})" class="w-full btn-ayurveda py-3">
                    <i class="fas fa-copy mr-2"></i>Duplicate Product
                </button>
                
                <button onclick="updateStock({{ $product->id }})" class="w-full bg-gradient-to-r from-earth-500 to-earth-600 hover:from-earth-600 hover:to-earth-700 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>Update Stock
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
    <div class="max-w-4xl max-h-screen p-4">
        <div class="relative">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full rounded-2xl">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-100 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}

function duplicateProduct(productId) {
    if (confirm('Create a duplicate of this product?')) {
        // AJAX call to duplicate product
        fetch(`/admin/products/${productId}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = `/admin/products/${data.newProductId}/edit`;
            } else {
                alert('Failed to duplicate product');
            }
        });
    }
}

function updateStock(productId) {
    const newStock = prompt('Enter new stock quantity:');
    if (newStock !== null && !isNaN(newStock) && newStock >= 0) {
        // AJAX call to update stock
        fetch(`/admin/products/${productId}/update-stock`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ quantity: parseInt(newStock) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update stock');
            }
        });
    }
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endsection
