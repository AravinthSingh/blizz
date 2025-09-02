<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - Blizz Face Cream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-600">Blizz</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('home') ? 'text-primary-600 font-semibold' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('about') ? 'text-primary-600 font-semibold' : '' }}">About Us</a>
                    <a href="{{ route('products') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('products*') ? 'text-primary-600 font-semibold' : '' }}">Products</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-primary-600 {{ request()->routeIs('contact') ? 'text-primary-600 font-semibold' : '' }}">Contact Us</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button id="cart-btn" class="relative text-gray-700 hover:text-primary-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </button>
                    
                    <!-- Mobile menu button -->
                    <button class="md:hidden text-gray-700 hover:text-primary-600" id="mobile-menu-btn">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white shadow-lg">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600">About Us</a>
                <a href="{{ route('products') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600">Products</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600">Contact Us</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Blizz</h3>
                    <p class="text-gray-300 mb-4">Premium face cream products for radiant and healthy skin. Experience the difference with our scientifically formulated skincare solutions.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="{{ route('products') }}" class="text-gray-300 hover:text-white">Products</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>123 Beauty Street, Skincare City, SC 12345</li>
                        <li><i class="fas fa-phone mr-2"></i>+1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@blizz.com</li>
                        <li><i class="fas fa-clock mr-2"></i>Mon-Fri: 9AM-6PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">&copy; {{ date('Y') }} Blizz. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Shopping Cart Modal -->
    <div id="cart-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Shopping Cart</h3>
                    <button id="close-cart" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="cart-items" class="space-y-4 mb-4">
                    <!-- Cart items will be populated here -->
                </div>
                <div class="border-t pt-4">
                    <div class="flex justify-between items-center mb-4">
                        <span class="font-semibold">Total: $<span id="cart-total">0.00</span></span>
                    </div>
                    <button class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Cart functionality
        document.getElementById('cart-btn').addEventListener('click', function() {
            document.getElementById('cart-modal').classList.remove('hidden');
        });

        document.getElementById('close-cart').addEventListener('click', function() {
            document.getElementById('cart-modal').classList.add('hidden');
        });
    </script>
</body>
</html>
