@extends('layouts.admin')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-earth-800">Create New Product</h2>
            <p class="text-earth-600">Add a new Ayurvedic product to your store</p>
        </div>
        
        <a href="{{ route('admin.products.index') }}" class="btn-ayurveda px-6 py-2">
            <i class="fas fa-arrow-left mr-2"></i>Back to Products
        </a>
    </div>
</div>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Product Information -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Basic Information -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
                <h3 class="text-2xl font-bold gradient-text mb-6">
                    <i class="fas fa-info-circle mr-3 text-primary-600"></i>Basic Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-spa mr-2 text-primary-600"></i>Product Name *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white @error('name') border-red-500 @enderror"
                               placeholder="Enter product name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category_id" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-tags mr-2 text-primary-600"></i>Category *
                        </label>
                        <select id="category_id" name="category_id" required
                                class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white @error('category_id') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="main_category" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-leaf mr-2 text-primary-600"></i>Main Category *
                        </label>
                        <select id="main_category" name="main_category" required
                                class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white @error('main_category') border-red-500 @enderror">
                            <option value="">Select Main Category</option>
                            <option value="Premium" {{ old('main_category') == 'Premium' ? 'selected' : '' }}>Premium</option>
                            <option value="Daily Care" {{ old('main_category') == 'Daily Care' ? 'selected' : '' }}>Daily Care</option>
                            <option value="Sensitive" {{ old('main_category') == 'Sensitive' ? 'selected' : '' }}>Sensitive</option>
                            <option value="Treatment" {{ old('main_category') == 'Treatment' ? 'selected' : '' }}>Treatment</option>
                        </select>
                        @error('main_category')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="description" class="block text-sm font-bold text-earth-700 mb-3">
                        <i class="fas fa-align-left mr-2 text-primary-600"></i>Description *
                    </label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white resize-none @error('description') border-red-500 @enderror"
                              placeholder="Describe the product's benefits and ingredients...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Pricing & Inventory -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
                <h3 class="text-2xl font-bold gradient-text mb-6">
                    <i class="fas fa-dollar-sign mr-3 text-secondary-600"></i>Pricing & Inventory
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-tag mr-2 text-secondary-600"></i>Price ($) *
                        </label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 bg-white @error('price') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="discount_percentage" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-percent mr-2 text-secondary-600"></i>Discount (%)
                        </label>
                        <input type="number" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage') }}" min="0" max="100"
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 bg-white @error('discount_percentage') border-red-500 @enderror"
                               placeholder="0">
                        @error('discount_percentage')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="quantity" class="block text-sm font-bold text-earth-700 mb-3">
                            <i class="fas fa-boxes mr-2 text-secondary-600"></i>Stock Quantity *
                        </label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="0" required
                               class="w-full px-4 py-3 border-2 border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:border-secondary-500 bg-white @error('quantity') border-red-500 @enderror"
                               placeholder="0">
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="allow_preorder" name="allow_preorder" value="1" {{ old('allow_preorder') ? 'checked' : '' }}
                               class="rounded border-earth-300 text-secondary-600 focus:ring-secondary-500 mr-3">
                        <label for="allow_preorder" class="text-sm font-semibold text-earth-700">
                            <i class="fas fa-clock mr-2 text-secondary-600"></i>Allow pre-orders when out of stock
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Images & Actions -->
        <div class="space-y-8">
            <!-- Product Images -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-earth-200">
                <h3 class="text-2xl font-bold gradient-text mb-6">
                    <i class="fas fa-images mr-3 text-earth-600"></i>Product Images
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="images" class="block text-sm font-bold text-earth-700 mb-3">
                            Upload Images
                        </label>
                        <input type="file" id="images" name="images[]" multiple accept="image/*"
                               class="w-full px-4 py-3 border-2 border-dashed border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-earth-500 focus:border-earth-500 bg-white @error('images') border-red-500 @enderror">
                        <p class="text-earth-500 text-xs mt-2">Upload multiple images (JPG, PNG, WebP). First image will be the main product image.</p>
                        @error('images')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="grid grid-cols-2 gap-4 mt-4 hidden">
                        <!-- Previews will be inserted here -->
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-primary-200">
                <h3 class="text-2xl font-bold gradient-text mb-6">
                    <i class="fas fa-bolt mr-3 text-primary-600"></i>Quick Actions
                </h3>
                
                <div class="space-y-4">
                    <button type="submit" class="w-full btn-3d py-4 text-lg">
                        <i class="fas fa-save mr-3"></i>Create Product
                    </button>
                    
                    <button type="button" onclick="saveDraft()" class="w-full btn-ayurveda py-3">
                        <i class="fas fa-file-alt mr-2"></i>Save as Draft
                    </button>
                    
                    <a href="{{ route('admin.products.index') }}" class="block w-full text-center py-3 text-earth-600 hover:text-earth-800 font-semibold transition-colors">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
            
            <!-- Product Tips -->
            <div class="glass rounded-3xl shadow-xl p-8 border border-secondary-200">
                <h3 class="text-xl font-bold gradient-text mb-4">
                    <i class="fas fa-lightbulb mr-2 text-secondary-600"></i>Tips
                </h3>
                
                <div class="space-y-3 text-sm text-earth-600">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Use high-quality images for better customer engagement</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Write detailed descriptions highlighting Ayurvedic benefits</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Set competitive pricing based on market research</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Enable pre-orders for popular products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    const files = e.target.files;
    const preview = document.getElementById('imagePreview');
    
    if (files.length > 0) {
        preview.classList.remove('hidden');
        preview.innerHTML = '';
        
        Array.from(files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-xl border-2 border-earth-200">
                        <div class="absolute top-1 right-1 bg-primary-500 text-white text-xs px-2 py-1 rounded-full">
                            ${index === 0 ? 'Main' : index + 1}
                        </div>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        preview.classList.add('hidden');
    }
});

// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    // This would typically generate a slug, but we'll let the backend handle it
});

// Calculate discounted price
function updateDiscountedPrice() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const discount = parseFloat(document.getElementById('discount_percentage').value) || 0;
    
    if (price > 0 && discount > 0) {
        const discountedPrice = price - (price * discount / 100);
        // You could show this in a preview area
    }
}

document.getElementById('price').addEventListener('input', updateDiscountedPrice);
document.getElementById('discount_percentage').addEventListener('input', updateDiscountedPrice);

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Creating Product...';
    submitBtn.disabled = true;
    
    // Re-enable if there are validation errors (this would be handled by Laravel)
    setTimeout(() => {
        if (this.querySelector('.border-red-500')) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }, 100);
});

// Save as draft functionality
function saveDraft() {
    const form = document.getElementById('productForm');
    const draftInput = document.createElement('input');
    draftInput.type = 'hidden';
    draftInput.name = 'is_draft';
    draftInput.value = '1';
    form.appendChild(draftInput);
    form.submit();
}
</script>
@endsection
