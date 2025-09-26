<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - Blizz Face Cream</title>
    @if(config('app.env') === 'production')
        <!-- Production: Direct asset links -->
        <link rel="stylesheet" href="{{ asset('build/assets/app-CotBYrHi.css') }}">
        <script src="{{ asset('build/assets/app-l0sNRNKZ.js') }}" defer></script>
    @else
        <!-- Development: Vite assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
</head>
<body class="bg-white">
    <!-- Ayurvedic Navigation -->
    <nav class="nav-3d fixed w-full z-50 transition-all duration-500" id="main-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-3xl font-bold">
                        <span class="text-gradient-gold">🌿 Blizz</span>
                        <span class="text-primary-900">Premium</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="nav-item text-primary-700 hover:text-secondary-600 font-semibold px-6 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('home') ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg' : '' }}">
                        <i class="fas fa-leaf mr-2"></i>Home
                    </a>
                    <a href="{{ route('about') }}" class="nav-item text-primary-700 hover:text-secondary-600 font-semibold px-6 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('about') ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg' : '' }}">
                        <i class="fas fa-seedling mr-2"></i>About
                    </a>
                    <a href="{{ route('products') }}" class="nav-item text-primary-700 hover:text-secondary-600 font-semibold px-6 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('products*') ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg' : '' }}">
                        <i class="fas fa-spa mr-2"></i>Products
                    </a>
                    <a href="{{ route('contact') }}" class="nav-item text-primary-700 hover:text-secondary-600 font-semibold px-6 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('contact') ? 'text-white bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg' : '' }}">
                        <i class="fas fa-lotus mr-2"></i>Contact
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Search Button -->
                    <button class="glass-gold p-3 rounded-full hover:scale-110 transition-all duration-300 group">
                        <i class="fas fa-search text-lg text-primary-700"></i>
                        <div class="absolute inset-0 bg-secondary-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </button>
                    
                    <!-- Cart Button -->
                    <button id="cart-btn" class="relative glass-gold p-3 rounded-full hover:scale-110 transition-all duration-300 group">
                        <i class="fas fa-shopping-basket text-lg text-secondary-700"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-gradient-to-r from-secondary-600 to-secondary-700 text-primary-900 text-xs rounded-full h-6 w-6 flex items-center justify-center font-bold shadow-lg">0</span>
                        <div class="absolute inset-0 bg-secondary-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </button>
                    
                    <!-- User Account -->
                    <button class="glass p-3 rounded-full hover:scale-110 transition-all duration-300 group">
                        <i class="fas fa-user text-lg text-earth-600 icon-3d"></i>
                        <div class="absolute inset-0 bg-earth-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </button>
                    
                    <!-- Mobile menu button -->
                    <button class="md:hidden glass p-3 rounded-full hover:scale-110 transition-all duration-300" id="mobile-menu-btn">
                        <i class="fas fa-bars text-lg text-primary-600 icon-3d"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-4 pt-4 pb-6 space-y-3 glass m-4 rounded-3xl">
                <a href="{{ route('home') }}" class="block px-6 py-4 text-earth-700 hover:text-primary-600 rounded-2xl hover:bg-primary-50 transition-all duration-300 font-semibold">
                    <i class="fas fa-leaf mr-4 icon-3d text-primary-500"></i>Home
                </a>
                <a href="{{ route('about') }}" class="block px-6 py-4 text-earth-700 hover:text-primary-600 rounded-2xl hover:bg-primary-50 transition-all duration-300 font-semibold">
                    <i class="fas fa-seedling mr-4 icon-3d text-primary-500"></i>About Us
                </a>
                <a href="{{ route('products') }}" class="block px-6 py-4 text-earth-700 hover:text-primary-600 rounded-2xl hover:bg-primary-50 transition-all duration-300 font-semibold">
                    <i class="fas fa-spa mr-4 icon-3d text-primary-500"></i>Products
                </a>
                <a href="{{ route('contact') }}" class="block px-6 py-4 text-earth-700 hover:text-primary-600 rounded-2xl hover:bg-primary-50 transition-all duration-300 font-semibold">
                    <i class="fas fa-lotus mr-4 icon-3d text-primary-500"></i>Contact Us
                </a>
                <div class="border-t border-primary-200 pt-4 mt-4">
                    <a href="#" class="block px-6 py-3 text-earth-600 hover:text-secondary-600 rounded-2xl hover:bg-secondary-50 transition-all duration-300">
                        <i class="fas fa-user mr-4 icon-3d text-secondary-500"></i>My Account
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Custom Cursor Elements -->
    <div class="custom-cursor" id="cursor"></div>
    <div class="mouse-follower" id="cursor-follower"></div>
    
    <!-- Falling Leaves Animation -->
    <div id="falling-leaves"></div>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-3d text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-3xl font-bold mb-6 gradient-text text-shadow-3d">✨ Blizz</h3>
                    <p class="text-gray-300 mb-6 text-lg leading-relaxed">Premium face cream products for radiant and healthy skin. Experience the difference with our scientifically formulated skincare solutions.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="glass p-3 rounded-full text-gray-300 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <i class="fab fa-facebook-f text-xl icon-3d"></i>
                            <div class="absolute inset-0 bg-blue-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </a>
                        <a href="#" class="glass p-3 rounded-full text-gray-300 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <i class="fab fa-instagram text-xl icon-3d"></i>
                            <div class="absolute inset-0 bg-pink-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </a>
                        <a href="#" class="glass p-3 rounded-full text-gray-300 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <i class="fab fa-twitter text-xl icon-3d"></i>
                            <div class="absolute inset-0 bg-blue-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </a>
                        <a href="#" class="glass p-3 rounded-full text-gray-300 hover:text-white transition-all duration-300 hover:scale-110 group">
                            <i class="fab fa-youtube text-xl icon-3d"></i>
                            <div class="absolute inset-0 bg-red-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </a>
                    </div>
                </div>
                
                <div class="glass p-6 rounded-2xl">
                    <h4 class="text-xl font-semibold mb-6 text-shadow-3d">
                        <i class="fas fa-link mr-2 icon-3d"></i>Quick Links
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 block">
                            <i class="fas fa-home mr-2 icon-3d"></i>Home
                        </a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 block">
                            <i class="fas fa-info-circle mr-2 icon-3d"></i>About Us
                        </a></li>
                        <li><a href="{{ route('products') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 block">
                            <i class="fas fa-shopping-bag mr-2 icon-3d"></i>Products
                        </a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-all duration-300 hover:translate-x-2 block">
                            <i class="fas fa-envelope mr-2 icon-3d"></i>Contact
                        </a></li>
                    </ul>
                </div>
                
                <div class="glass p-6 rounded-2xl">
                    <h4 class="text-xl font-semibold mb-6 text-shadow-3d">
                        <i class="fas fa-address-book mr-2 icon-3d"></i>Contact Info
                    </h4>
                    <ul class="space-y-4 text-gray-300">
                        <li class="flex items-start hover:text-white transition-colors duration-300">
                            <i class="fas fa-map-marker-alt mr-3 mt-1 icon-3d text-primary-400"></i>
                            <span>123 Beauty Street, Skincare City, SC 12345</span>
                        </li>
                        <li class="flex items-center hover:text-white transition-colors duration-300">
                            <i class="fas fa-phone mr-3 icon-3d text-primary-400"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center hover:text-white transition-colors duration-300">
                            <i class="fas fa-envelope mr-3 icon-3d text-primary-400"></i>
                            <span>info@blizz.com</span>
                        </li>
                        <li class="flex items-center hover:text-white transition-colors duration-300">
                            <i class="fas fa-clock mr-3 icon-3d text-primary-400"></i>
                            <span>Mon-Fri: 9AM-6PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="glass mt-12 pt-8 text-center rounded-2xl">
                <p class="text-gray-300 text-lg">
                    <i class="fas fa-heart mr-2 text-red-400 pulse-3d"></i>
                    &copy; {{ date('Y') }} Blizz. All rights reserved. Made with love for beautiful skin.
                </p>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-primary-500 rounded-full opacity-10 float" style="animation-delay: -2s;"></div>
        <div class="absolute top-32 right-20 w-16 h-16 bg-secondary-500 rounded-full opacity-10 float" style="animation-delay: -4s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-primary-400 rounded-full opacity-10 float" style="animation-delay: -1s;"></div>
        <div class="absolute bottom-32 right-1/3 w-14 h-14 bg-secondary-400 rounded-full opacity-10 float" style="animation-delay: -3s;"></div>
    </footer>

    <!-- Shopping Cart Modal -->
    <div id="cart-modal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden backdrop-blur-sm">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="cart-modal max-w-md w-full p-8 transform scale-95 transition-all duration-300" id="cart-content">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold gradient-text">
                        <i class="fas fa-shopping-cart mr-2 icon-3d"></i>Shopping Cart
                    </h3>
                    <button id="close-cart" class="glass p-2 rounded-full text-gray-400 hover:text-gray-600 hover:scale-110 transition-all duration-300">
                        <i class="fas fa-times text-xl icon-3d"></i>
                    </button>
                </div>
                <div id="cart-items" class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                    <!-- Cart items will be populated here -->
                </div>
                <div class="glass p-4 rounded-xl">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold gradient-text">Total: $<span id="cart-total">0.00</span></span>
                    </div>
                    <button class="btn-3d w-full">
                        <i class="fas fa-credit-card mr-2"></i>Checkout Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true
        });
        
        // Custom Cursor Implementation
        const cursor = document.getElementById('cursor');
        const follower = document.getElementById('cursor-follower');
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top = mouseY + 'px';
        });
        
        // Smooth follower animation
        function animateFollower() {
            followerX += (mouseX - followerX) * 0.1;
            followerY += (mouseY - followerY) * 0.1;
            follower.style.left = followerX + 'px';
            follower.style.top = followerY + 'px';
            requestAnimationFrame(animateFollower);
        }
        animateFollower();
        
        // Cursor hover effects
        const hoverElements = document.querySelectorAll('a, button, .nav-item, .btn-3d, .btn-ayurveda');
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('hover');
                follower.style.transform = 'scale(1.5)';
            });
            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('hover');
                follower.style.transform = 'scale(1)';
            });
        });
        
        // Falling Leaves Animation
        function createLeaf() {
            const leaf = document.createElement('div');
            leaf.className = 'leaf-animation';
            leaf.style.left = Math.random() * 100 + 'vw';
            leaf.style.animationDelay = Math.random() * 2 + 's';
            leaf.style.animationDuration = (Math.random() * 3 + 5) + 's';
            document.getElementById('falling-leaves').appendChild(leaf);
            
            setTimeout(() => {
                leaf.remove();
            }, 8000);
        }
        
        // Create leaves periodically
        setInterval(createLeaf, 3000);
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Enhanced Cart functionality
        document.getElementById('cart-btn').addEventListener('click', function() {
            const modal = document.getElementById('cart-modal');
            const content = document.getElementById('cart-content');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.style.transform = 'scale(1)';
            }, 10);
        });

        document.getElementById('close-cart').addEventListener('click', function() {
            const modal = document.getElementById('cart-modal');
            const content = document.getElementById('cart-content');
            content.style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });

        // Close modal when clicking outside
        document.getElementById('cart-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                document.getElementById('close-cart').click();
            }
        });

        // Enhanced Navbar scroll effect - Transparent to solid
        const nav = document.getElementById('main-nav');
        // Set initial transparent state
        nav.style.background = 'transparent';
        nav.style.backdropFilter = 'none';
        nav.style.boxShadow = 'none';
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
                nav.style.background = 'rgba(240, 253, 244, 0.98)';
                nav.style.backdropFilter = 'blur(30px)';
                nav.style.boxShadow = '0 8px 32px rgba(21, 128, 61, 0.2)';
            } else {
                nav.classList.remove('scrolled');
                nav.style.background = 'transparent';
                nav.style.backdropFilter = 'none';
                nav.style.boxShadow = 'none';
            }
        });
        
        // Parallax effect for floating elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.float');
            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
        
        // Carousel Functionality with Auto-play
        document.addEventListener('DOMContentLoaded', function() {
            const carouselItems = document.querySelectorAll('.carousel-item');
            const heroSection = document.getElementById('hero-section');
            const productTitle = document.getElementById('product-title');
            const productDescription = document.getElementById('product-description');
            const heroImage = document.getElementById('hero-image');
            const bgText = document.getElementById('bg-text');
            const orderButton = document.getElementById('order-button');
            
            let currentIndex = 0;
            let autoPlayInterval;
            
            function changeProduct(item) {
                // Get data attributes
                const title = item.dataset.title;
                const description = item.dataset.description;
                const price = item.dataset.price;
                const bgColor = item.dataset.bgColor;
                const modalText = item.dataset.modalText;
                const image = item.dataset.image;
                
                // Update active states
                document.querySelectorAll('.product-thumb').forEach(thumb => {
                    thumb.classList.remove('opacity-100', 'scale-110');
                    thumb.classList.add('opacity-50');
                });
                
                item.querySelector('.product-thumb').classList.remove('opacity-50');
                item.querySelector('.product-thumb').classList.add('opacity-100', 'scale-110');
                
                // Animate changes
                productTitle.style.animation = 'none';
                productDescription.style.animation = 'none';
                heroImage.style.animation = 'none';
                
                setTimeout(() => {
                    // Update content
                    productTitle.textContent = title;
                    productDescription.textContent = description;
                    heroImage.src = image;
                    bgText.textContent = modalText;
                    orderButton.style.color = bgColor;
                    
                    // Update background color
                    heroSection.style.backgroundColor = bgColor;
                    heroSection.dataset.activeBg = bgColor;
                    
                    // Re-trigger animations
                    productTitle.style.animation = 'slideRight 0.5s ease-out';
                    productDescription.style.animation = 'slideRight 0.5s ease-out 0.2s';
                    heroImage.style.animation = 'slideLeft 0.5s ease-out';
                }, 100);
            }
            
            // Click handlers for carousel items
            carouselItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    currentIndex = index;
                    changeProduct(this);
                    // Reset auto-play interval
                    clearInterval(autoPlayInterval);
                    startAutoPlay();
                });
            });
            
            // Auto-play functionality
            function autoPlay() {
                currentIndex = (currentIndex + 1) % carouselItems.length;
                changeProduct(carouselItems[currentIndex]);
            }
            
            function startAutoPlay() {
                autoPlayInterval = setInterval(autoPlay, 5000); // Change every 5 seconds
            }
            
            // Start auto-play
            startAutoPlay();
            
            // Pause auto-play on hover
            heroSection.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
            heroSection.addEventListener('mouseleave', () => startAutoPlay());
        });
    </script>
</body>
</html>
