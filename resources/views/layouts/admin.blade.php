<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Blizz Ayurveda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Override custom cursor for admin pages */
        * {
            cursor: auto !important;
        }
        input, button, a, select, textarea {
            cursor: pointer !important;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], textarea {
            cursor: text !important;
        }
        /* Hide custom cursor elements */
        .custom-cursor, .mouse-follower {
            display: none !important;
        }
        
        /* Force admin sidebar colors */
        .admin-sidebar {
            background-color: #1c1917 !important; /* Very dark brown */
            color: #ffffff !important;
        }
        
        .admin-nav-item {
            color: #ffffff !important;
            text-decoration: none !important;
        }
        
        .admin-nav-item:hover {
            background-color: #292524 !important; /* Slightly lighter brown */
            color: #ffffff !important;
            border-right: 4px solid #f59e0b !important; /* Gold accent */
        }
        
        .admin-nav-item.active {
            background-color: #292524 !important;
            color: #fbbf24 !important; /* Gold text */
            border-right: 4px solid #f59e0b !important;
        }
        
        .admin-nav-item i {
            color: inherit !important;
        }
        
        .admin-nav-item span {
            color: inherit !important;
        }
        
        .admin-header-border {
            border-bottom: 1px solid #d6d3d1 !important;
        }
        
        .admin-divider {
            border-top: 1px solid #292524 !important;
        }
        
        /* Additional specificity for menu items */
        .admin-sidebar a {
            color: #ffffff !important;
        }
        
        .admin-sidebar a:hover {
            color: #ffffff !important;
        }
        
        .admin-sidebar a.active {
            color: #fbbf24 !important;
        }
        
        .admin-sidebar .fas {
            color: inherit !important;
        }
    </style>
</head>
<body class="bg-gray-100" style="cursor: auto !important;">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 admin-sidebar shadow-xl">
            <div class="p-6" style="border-bottom: 1px solid #292524;">
                <div class="flex items-center">
                    <div class="text-3xl mr-3">🌿</div>
                    <div>
                        <h2 class="text-xl font-bold" style="color: #fbbf24 !important;">Blizz Ayurveda</h2>
                        <p class="text-sm" style="color: #d6d3d1 !important;">Admin Panel</p>
                    </div>
                </div>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-4 text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-spa mr-4 text-lg"></i>
                    <span class="font-medium">Products</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-basket mr-4 text-lg"></i>
                    <span class="font-medium">Orders</span>
                </a>
                <a href="{{ route('admin.orders.preorders') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200">
                    <i class="fas fa-clock mr-4 text-lg"></i>
                    <span class="font-medium">Pre-orders</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-star mr-4 text-lg"></i>
                    <span class="font-medium">Testimonials</span>
                </a>
                <a href="{{ route('admin.products.availability') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200">
                    <i class="fas fa-warehouse mr-4 text-lg"></i>
                    <span class="font-medium">Stock Check</span>
                </a>
                <a href="{{ route('admin.sales-summary') }}" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200">
                    <i class="fas fa-chart-line mr-4 text-lg"></i>
                    <span class="font-medium">Sales Summary</span>
                </a>
                
                <!-- Divider -->
                <div class="admin-divider my-4"></div>
                
                <!-- Website Link -->
                <a href="{{ route('home') }}" target="_blank" class="admin-nav-item flex items-center px-6 py-3 transition-all duration-200" style="color: #d6d3d1 !important;">
                    <i class="fas fa-external-link-alt mr-4 text-lg"></i>
                    <span class="font-medium">View Website</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-lg admin-header-border">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-3xl font-bold gradient-text">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-earth-600 text-sm mt-1">Manage your Ayurvedic store</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-earth-700 font-semibold">Welcome back!</p>
                            <p class="text-earth-600 text-sm">{{ auth('admin')->user()->name }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-primary-50 p-6">
                @if(session('success'))
                    <div class="glass border border-green-300 text-green-800 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="glass border border-red-300 text-red-800 px-6 py-4 rounded-2xl mb-6 flex items-center shadow-lg">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
