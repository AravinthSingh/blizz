<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - Blizz Ayurveda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Override custom cursor for login page */
        * {
            cursor: auto !important;
        }
        input, button, a {
            cursor: pointer !important;
        }
        input[type="email"], input[type="password"] {
            cursor: text !important;
        }
        /* Hide custom cursor elements */
        .custom-cursor, .mouse-follower {
            display: none !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-primary-600 via-earth-700 to-secondary-600 min-h-screen flex items-center justify-center relative overflow-hidden" style="cursor: auto !important;">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-gradient-to-tr from-primary-900/50 to-secondary-900/50"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-20 w-32 h-32 bg-primary-400/20 rounded-full blur-xl float" style="animation-delay: -1s;"></div>
    <div class="absolute top-40 right-32 w-24 h-24 bg-secondary-400/20 rounded-full blur-lg float" style="animation-delay: -3s;"></div>
    <div class="absolute bottom-32 left-1/4 w-20 h-20 bg-earth-400/20 rounded-full blur-lg float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 right-20 w-28 h-28 bg-primary-300/20 rounded-full blur-xl float" style="animation-delay: -4s;"></div>

    <div class="glass p-10 rounded-3xl shadow-2xl w-full max-w-md relative z-10 breathe">
        <div class="text-center mb-10">
            <div class="text-6xl mb-4">🌿</div>
            <h1 class="text-4xl font-bold gradient-text mb-2">Blizz Ayurveda</h1>
            <h2 class="text-2xl font-semibold text-earth-700 mb-2">Admin Portal</h2>
            <p class="text-earth-600">Sign in to manage your Ayurvedic store</p>
        </div>

        @if ($errors->any())
            <div class="glass p-4 rounded-2xl mb-6 border border-red-300">
                <div class="flex items-center text-red-600">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="font-semibold">Login Failed</span>
                </div>
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-earth-700 text-sm font-bold mb-3">
                    <i class="fas fa-envelope mr-2 text-primary-600"></i>Email Address
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 @error('email') border-red-500 @enderror" 
                       placeholder="Enter your email"
                       required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <i class="fas fa-times-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="block text-earth-700 text-sm font-bold mb-3">
                    <i class="fas fa-lock mr-2 text-primary-600"></i>Password
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-3 border border-earth-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white/90 @error('password') border-red-500 @enderror" 
                           placeholder="Enter your password"
                           required>
                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-earth-500 hover:text-primary-600">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <i class="fas fa-times-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <button type="submit" class="btn-3d w-full text-lg py-4 mb-4" id="loginBtn">
                <i class="fas fa-sign-in-alt mr-3"></i>Sign In to Admin Panel
            </button>

            <div class="text-center">
                <a href="{{ route('home') }}" class="text-earth-600 hover:text-primary-600 transition-colors duration-300 text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Website
                </a>
            </div>
        </form>
    </div>

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Signing In...';
            btn.disabled = true;
        });

        // Auto-focus email field
        document.getElementById('email').focus();
    </script>
</body>
</html>
