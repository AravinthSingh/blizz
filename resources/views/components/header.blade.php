{{-- Header/Navbar Component --}}
<header class="text-white py-8" x-data="{ mobileMenuOpen: false }">
    <div class="container flex justify-between items-center animate-fade-in">
        {{-- Logo Section --}}
        <div>
            <a href="/" class="flex items-center gap-2 text-2xl font-bold text-white">
                <span class="text-3xl">🌿</span>
                <span>Blizz Ayurveda</span>
            </a>
        </div>

        {{-- Desktop Menu Section --}}
        <nav class="hidden md:block">
            <ul class="flex items-center gap-4 relative z-40">
                <li>
                    <a href="#" class="inline-block text-base font-semibold py-2 px-3 uppercase hover:opacity-80 transition-opacity">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-block text-base font-semibold py-2 px-3 uppercase hover:opacity-80 transition-opacity">
                        Categories
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-block text-base font-semibold py-2 px-3 uppercase hover:opacity-80 transition-opacity">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-block text-base font-semibold py-2 px-3 uppercase hover:opacity-80 transition-opacity">
                        About
                    </a>
                </li>
                <li>
                    <a href="#" class="inline-block text-base font-semibold py-2 px-3 uppercase hover:opacity-80 transition-opacity">
                        Contact
                    </a>
                </li>
                <li>
                    <button class="text-xl ps-14 hover:opacity-80 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </button>
                </li>
            </ul>
        </nav>

        {{-- Mobile Hamburger Menu --}}
        <div class="md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-4xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        {{-- Mobile Menu Dropdown --}}
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="absolute top-20 right-4 bg-black/90 rounded-lg p-6 md:hidden z-50">
            <nav>
                <ul class="space-y-4">
                    <li><a href="#" class="block text-white hover:text-gray-300">Home</a></li>
                    <li><a href="#" class="block text-white hover:text-gray-300">Categories</a></li>
                    <li><a href="#" class="block text-white hover:text-gray-300">Blog</a></li>
                    <li><a href="#" class="block text-white hover:text-gray-300">About</a></li>
                    <li><a href="#" class="block text-white hover:text-gray-300">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
