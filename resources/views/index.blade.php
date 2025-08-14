<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Rethink') }} - Modern Laravel Starter Kit</title>
    <meta name="description" content="A modern Laravel 12 application built with Livewire and Flux UI components, featuring reactive interfaces and comprehensive authentication.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased h-full bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <x-heroicon-s-check-circle class="w-5 h-5 text-white" />
                            </div>
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Rethink</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                        <span class="block">Modern Laravel</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                            Starter Kit
                        </span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-300">
                        Built with Laravel 12, Livewire, and Flux UI components. A complete foundation for building modern, reactive web applications with clean architecture and best practices.
                    </p>
                    <div class="mt-10 flex justify-center gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                Get Started
                            </a>
                            <a href="https://github.com/laravel/laravel" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-900 dark:text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                View Source
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                Go to Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 bg-white/50 dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Everything You Need to Build Modern Apps
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                        Pre-configured with the best tools and practices for Laravel development
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Laravel 12 -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-rocket-launch class="w-6 h-6 text-red-600 dark:text-red-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Laravel 12</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Latest Laravel framework with streamlined architecture, enhanced performance, and modern development patterns.
                        </p>
                    </div>

                    <!-- Livewire & Volt -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-bolt class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Livewire</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Reactive components with server-side rendering. Class-based components for robust development.
                        </p>
                    </div>

                    <!-- Flux UI -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-star class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Flux UI</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Beautiful, accessible UI components designed specifically for Livewire applications with consistent styling.
                        </p>
                    </div>

                    <!-- Authentication -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-shield-check class="w-6 h-6 text-green-600 dark:text-green-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Complete Auth System</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Full authentication with registration, login, email verification, password reset, and user management.
                        </p>
                    </div>

                    <!-- Testing -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-beaker class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Testing Ready</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Pre-configured with Pest testing framework, feature tests, and CI/CD workflows for reliable development.
                        </p>
                    </div>

                    <!-- Modern Tooling -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/20 rounded-xl flex items-center justify-center mb-6">
                            <x-heroicon-s-wrench-screwdriver class="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Modern Tooling</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Vite for fast builds, Tailwind CSS 4, Laravel Pint for code formatting, and development optimization.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        Powered by Modern Technologies
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-16">
                        Built with the latest versions of trusted technologies
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-8">
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-red-600 text-2xl font-bold">Laravel</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">12.23.1</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-purple-600 text-2xl font-bold">Livewire</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">3.6.4</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-blue-600 text-2xl font-bold">Flux UI</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">2.2.4</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-cyan-600 text-2xl font-bold">Tailwind</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">4.0.7</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-yellow-600 text-2xl font-bold">Vite</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">7.0.4</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-green-600 text-2xl font-bold">Pest</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">3.8.2</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-indigo-600 text-2xl font-bold">PHP</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">8.2+</div>
                    </div>
                    <div class="flex flex-col items-center space-y-2">
                        <div class="text-gray-600 text-2xl font-bold">Blade</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Icons</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-white mb-6">
                    Ready to Build Something Amazing?
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Start your next project with a solid foundation and modern best practices.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg transition-colors inline-block">
                        Get Started Now
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg transition-colors inline-block">
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2 mb-4 md:mb-0">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <x-heroicon-s-check-circle class="w-5 h-5 text-white" />
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Rethink</span>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-gray-600 dark:text-gray-400">
                            Built with ❤️ using Laravel, Livewire & Flux UI
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                            © {{ date('Y') }} Rethink. Modern Laravel Starter Kit.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>