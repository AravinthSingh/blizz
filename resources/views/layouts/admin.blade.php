<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Blizz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-primary-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Blizz Admin</h2>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 hover:bg-primary-700 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2 hover:bg-primary-700 {{ request()->routeIs('admin.products.*') ? 'bg-primary-700' : '' }}">
                    <i class="fas fa-box mr-3"></i>
                    Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 hover:bg-primary-700 {{ request()->routeIs('admin.orders.*') ? 'bg-primary-700' : '' }}">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Orders
                </a>
                <a href="{{ route('admin.orders.preorders') }}" class="flex items-center px-4 py-2 hover:bg-primary-700">
                    <i class="fas fa-clock mr-3"></i>
                    Pre-orders
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 hover:bg-primary-700 {{ request()->routeIs('admin.testimonials.*') ? 'bg-primary-700' : '' }}">
                    <i class="fas fa-star mr-3"></i>
                    Testimonials
                </a>
                <a href="{{ route('admin.products.availability') }}" class="flex items-center px-4 py-2 hover:bg-primary-700">
                    <i class="fas fa-warehouse mr-3"></i>
                    Stock Check
                </a>
                <a href="{{ route('admin.sales-summary') }}" class="flex items-center px-4 py-2 hover:bg-primary-700">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Sales Summary
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, {{ auth('admin')->user()->name }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
