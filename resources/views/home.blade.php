@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Slider -->
<section class="relative h-screen overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-secondary-600 opacity-90"></div>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/hero_image_1.jpg')"></div>
    
    <div class="relative z-10 flex items-center justify-center h-full">
        <div class="text-center text-white px-4" data-aos="fade-up">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Radiant Skin</h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">Discover the secret to glowing, healthy skin with our premium face cream collection</p>
            <a href="{{ route('products') }}" class="bg-white text-primary-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                Shop Now
            </a>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
            <p class="text-xl text-gray-600">Discover our best-selling face creams</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <img src="/images/product_placeholder_{{ $loop->iteration }}.jpg" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        @if($product->discount_percentage > 0)
                            <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                -{{ $product->discount_percentage }}%
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                @if($product->discounted_price)
                                    <span class="text-lg font-bold text-primary-600">${{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="text-sm text-gray-500 line-through">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-lg font-bold text-primary-600">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            
                            <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-full text-sm font-semibold add-to-cart" 
                                    data-product-id="{{ $product->id }}" 
                                    data-product-name="{{ $product->name }}" 
                                    data-product-price="{{ $product->final_price }}">
                                Add to Cart
                            </button>
                        </div>
                        
                        @if($product->quantity == 0)
                            <div class="mt-2">
                                @if($product->allow_preorder)
                                    <span class="text-yellow-600 text-sm font-semibold">Available for Pre-order</span>
                                @else
                                    <span class="text-red-600 text-sm font-semibold">Out of Stock</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('products') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300">
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Shop by Category</h2>
            <p class="text-xl text-gray-600">Find the perfect product for your skin type</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}" class="group" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="bg-gradient-to-br from-primary-100 to-secondary-100 rounded-lg p-6 text-center hover:shadow-lg transition duration-300">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-16 h-16 mx-auto mb-4 rounded-full object-cover">
                        @else
                            <div class="w-16 h-16 mx-auto mb-4 bg-primary-200 rounded-full flex items-center justify-center">
                                <img src="/images/category_icon_{{ $loop->iteration }}.jpg" alt="{{ $category->name }}" class="w-12 h-12 rounded-full object-cover">
                            </div>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-primary-600 transition duration-300">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Customers Say</h2>
            <p class="text-xl text-gray-600">Real reviews from real customers</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
                    <div class="flex items-center mb-4">
                        @if($testimonial->customer_image)
                            <img src="{{ asset('storage/' . $testimonial->customer_image) }}" alt="{{ $testimonial->customer_name }}" class="w-12 h-12 rounded-full object-cover mr-4">
                        @else
                            <div class="w-12 h-12 rounded-full bg-primary-200 flex items-center justify-center mr-4">
                                <img src="/images/customer_avatar_{{ $loop->iteration }}.jpg" alt="{{ $testimonial->customer_name }}" class="w-10 h-10 rounded-full object-cover">
                            </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h4>
                            <div class="text-yellow-400">
                                {!! $testimonial->stars !!}
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial->message }}"</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 bg-primary-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4">Get in Touch</h2>
            <p class="text-xl mb-8">Have questions about our products? We're here to help!</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-3xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Visit Us</h3>
                    <p>123 Beauty Street<br>Skincare City, SC 12345</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-phone text-3xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Call Us</h3>
                    <p>+1 (555) 123-4567<br>Mon-Fri: 9AM-6PM</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-envelope text-3xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">Email Us</h3>
                    <p>info@blizz.com<br>support@blizz.com</p>
                </div>
            </div>
            
            <a href="{{ route('contact') }}" class="bg-white text-primary-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>

<script>
// Add to cart functionality
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const productName = this.dataset.productName;
        const productPrice = parseFloat(this.dataset.productPrice);
        
        // Get existing cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Check if product already exists in cart
        const existingItem = cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            });
        }
        
        // Save cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart count
        updateCartCount();
        
        // Show success message
        this.textContent = 'Added!';
        this.classList.add('bg-green-600');
        this.classList.remove('bg-primary-600');
        
        setTimeout(() => {
            this.textContent = 'Add to Cart';
            this.classList.remove('bg-green-600');
            this.classList.add('bg-primary-600');
        }, 2000);
    });
});

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalItems;
}

// Initialize cart count on page load
updateCartCount();
</script>
@endsection
