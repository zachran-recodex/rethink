<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Rethink') }} - Modern SaaS Platform</title>
    <meta name="description" content="Transform your business with our powerful SaaS platform. Built on Laravel 12 with cutting-edge technology for enterprise-grade applications.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Manrope:300,400,500,600,700,800" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased h-full bg-white" style="font-family: 'Manrope', sans-serif;">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="fixed w-full bg-white/95 backdrop-blur-lg border-b border-gray-200/20 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-lg">
                                <x-heroicon-s-bolt class="w-5 h-5 text-white" />
                            </div>
                            <span class="text-xl font-bold text-dark">Rethink</span>
                        </div>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-dark-70 hover:text-dark transition-colors font-medium">Features</a>
                        <a href="#pricing" class="text-dark-70 hover:text-dark transition-colors font-medium">Pricing</a>
                        <a href="#about" class="text-dark-70 hover:text-dark transition-colors font-medium">About</a>

                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-primary hover:bg-primary-90 text-white px-6 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-dark-70 hover:text-dark transition-colors font-medium">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-90 text-white px-6 py-2.5 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                                Start Free Trial
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="text-dark-70 hover:text-dark">
                            <x-heroicon-o-bars-3 class="w-6 h-6" />
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-white pt-20">
            <!-- Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-32 w-80 h-80 bg-primary-20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-accent-20 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                <div class="text-center">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-accent-20 text-dark text-sm font-medium mb-8">
                        <x-heroicon-s-sparkles class="w-4 h-4 mr-2" />
                        Trusted by 10,000+ businesses worldwide
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-5xl lg:text-7xl font-bold tracking-tight mb-8">
                        <span class="block text-dark">Transform Your</span>
                        <span class="block text-primary">
                            Business Today
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="max-w-3xl mx-auto text-xl lg:text-2xl text-dark-70 leading-relaxed mb-12">
                        The most powerful SaaS platform to streamline operations, boost productivity, and scale your business with enterprise-grade security and reliability.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                        @guest
                            <a href="{{ route('register') }}" class="group bg-primary hover:bg-primary-90 text-white px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200 shadow-2xl hover:shadow-primary/25 hover:scale-105">
                                Start Free Trial
                                <x-heroicon-s-arrow-right class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform" />
                            </a>
                            <a href="#demo" class="bg-accent hover:bg-accent-90 text-dark px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200 shadow-lg">
                                Watch Demo
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="group bg-primary hover:bg-primary-90 text-white px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200 shadow-2xl hover:shadow-primary/25 hover:scale-105">
                                Go to Dashboard
                                <x-heroicon-s-arrow-right class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform" />
                            </a>
                        @endguest
                    </div>

                    <!-- Trust Indicators -->
                    <div class="flex flex-col items-center space-y-4">
                        <p class="text-sm text-dark-60 font-medium">No credit card required • 14-day free trial • Cancel anytime</p>
                        <div class="flex items-center space-x-6 text-dark opacity-50">
                            <div class="flex items-center space-x-1">
                                <x-heroicon-s-star class="w-5 h-5 text-accent" />
                                <span class="text-sm font-medium">4.9/5 rating</span>
                            </div>
                            <div class="w-1 h-1 bg-primary rounded-full"></div>
                            <div class="text-sm font-medium">SOC 2 Compliant</div>
                            <div class="w-1 h-1 bg-primary rounded-full"></div>
                            <div class="text-sm font-medium">99.9% Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-20 text-primary text-sm font-medium mb-6">
                        <x-heroicon-s-cog-6-tooth class="w-4 h-4 mr-2" />
                        Powerful Features
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6">
                        Everything you need to
                        <span class="text-primary">succeed</span>
                    </h2>
                    <p class="max-w-3xl mx-auto text-xl text-dark-70">
                        Built with enterprise-grade technology and designed for teams that demand performance, security, and scalability.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Advanced Analytics -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-chart-bar class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">Advanced Analytics</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Real-time insights and comprehensive reporting to make data-driven decisions with confidence.
                        </p>
                    </div>

                    <!-- Team Collaboration -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-users class="w-7 h-7 text-dark" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">Team Collaboration</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Seamless collaboration tools that keep your team aligned and productive across all projects.
                        </p>
                    </div>

                    <!-- Enterprise Security -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-shield-check class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">Enterprise Security</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Bank-level security with end-to-end encryption, SSO, and compliance with industry standards.
                        </p>
                    </div>

                    <!-- API Integration -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-puzzle-piece class="w-7 h-7 text-dark" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">API Integration</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Connect with 1000+ apps and services through our robust API and webhook system.
                        </p>
                    </div>

                    <!-- Automation -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-bolt class="w-7 h-7 text-white" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">Smart Automation</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Automate repetitive tasks and workflows to focus on what matters most to your business.
                        </p>
                    </div>

                    <!-- 24/7 Support -->
                    <div class="group bg-white/50 rounded-3xl p-8 shadow-lg hover:shadow-2xl border border-gray-100 transition-all duration-300 hover:-translate-y-2">
                        <div class="w-14 h-14 bg-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <x-heroicon-s-heart class="w-7 h-7 text-dark" />
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-4">24/7 Support</h3>
                        <p class="text-dark-70 leading-relaxed">
                            Expert support team available around the clock to help you succeed with dedicated assistance.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-dark mb-4">
                        Trusted by industry leaders
                    </h2>
                    <p class="text-lg text-dark-70">
                        Join thousands of companies that rely on our platform
                    </p>
                </div>

                <!-- Company Logos -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company A</div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company B</div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company C</div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company D</div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company E</div>
                    </div>
                    <div class="flex justify-center">
                        <div class="text-2xl font-bold text-primary">Company F</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-accent-20 text-dark text-sm font-medium mb-6">
                        <x-heroicon-s-currency-dollar class="w-4 h-4 mr-2" />
                        Simple Pricing
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6">
                        Choose the perfect plan for
                        <span class="text-primary">your business</span>
                    </h2>
                    <p class="max-w-3xl mx-auto text-xl text-dark-70">
                        Start free and scale as you grow. No hidden fees, no surprises.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Starter Plan -->
                    <div class="bg-white/50 rounded-3xl p-8 shadow-lg border border-gray-200">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-dark mb-4">Starter</h3>
                            <div class="mb-6">
                                <span class="text-4xl font-bold text-dark">$0</span>
                                <span class="text-dark-60">/month</span>
                            </div>
                            <p class="text-dark-70 mb-8">Perfect for individuals and small teams getting started</p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">Up to 3 team members</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">5GB storage</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">Basic analytics</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">Email support</span>
                            </li>
                        </ul>

                        <a href="{{ route('register') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-dark py-3 px-6 rounded-xl font-semibold transition-colors text-center block">
                            Get Started Free
                        </a>
                    </div>

                    <!-- Professional Plan -->
                    <div class="bg-primary rounded-3xl p-8 shadow-2xl transform scale-105 relative">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-accent text-dark px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                        </div>

                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-white mb-4">Professional</h3>
                            <div class="mb-6">
                                <span class="text-4xl font-bold text-white">$29</span>
                                <span class="text-white/70">/month</span>
                            </div>
                            <p class="text-white/80 mb-8">Ideal for growing businesses and teams</p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-white">Up to 25 team members</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-white">100GB storage</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-white">Advanced analytics</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-white">Priority support</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-white">API access</span>
                            </li>
                        </ul>

                        <a href="{{ route('register') }}" class="w-full bg-white hover:bg-gray-100 text-primary py-3 px-6 rounded-xl font-semibold transition-colors text-center block">
                            Start Free Trial
                        </a>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="bg-white/50 rounded-3xl p-8 shadow-lg border border-gray-200">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-dark mb-4">Enterprise</h3>
                            <div class="mb-6">
                                <span class="text-4xl font-bold text-dark">$99</span>
                                <span class="text-dark-60">/month</span>
                            </div>
                            <p class="text-dark-70 mb-8">For large organizations with advanced needs</p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">Unlimited team members</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">1TB storage</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">Custom analytics</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">24/7 phone support</span>
                            </li>
                            <li class="flex items-center">
                                <x-heroicon-s-check class="w-5 h-5 text-accent mr-3" />
                                <span class="text-dark-80">SSO & advanced security</span>
                            </li>
                        </ul>

                        <a href="#contact" class="w-full bg-gray-100 hover:bg-gray-200 text-dark py-3 px-6 rounded-xl font-semibold transition-colors text-center block">
                            Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-20 text-primary text-sm font-medium mb-6">
                        <x-heroicon-s-heart class="w-4 h-4 mr-2" />
                        Customer Stories
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6">
                        Loved by teams
                        <span class="text-primary">worldwide</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50/50 rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-accent">
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                            </div>
                        </div>
                        <p class="text-dark-70 mb-6 leading-relaxed">
                            "This platform transformed how we manage our projects. The automation features alone saved us 20 hours per week."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-semibold mr-4">
                                JS
                            </div>
                            <div>
                                <div class="font-semibold text-dark">John Smith</div>
                                <div class="text-sm text-dark-60">CEO, TechCorp</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-accent">
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                            </div>
                        </div>
                        <p class="text-dark-70 mb-6 leading-relaxed">
                            "The best investment we've made. Our team productivity increased by 40% within the first month of using this platform."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-accent rounded-full flex items-center justify-center text-dark font-semibold mr-4">
                                MJ
                            </div>
                            <div>
                                <div class="font-semibold text-dark">Maria Johnson</div>
                                <div class="text-sm text-dark-60">CTO, StartupXYZ</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-accent">
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                                <x-heroicon-s-star class="w-5 h-5" />
                            </div>
                        </div>
                        <p class="text-dark-70 mb-6 leading-relaxed">
                            "Incredible support team and robust features. This platform scales perfectly with our growing business needs."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-semibold mr-4">
                                DL
                            </div>
                            <div>
                                <div class="font-semibold text-dark">David Lee</div>
                                <div class="text-sm text-dark-60">Founder, InnovateLab</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24 bg-primary overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-accent-20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                    Ready to transform your business?
                </h2>
                <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Join thousands of companies already using our platform to streamline operations and boost productivity.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @guest
                        <a href="{{ route('register') }}" class="group bg-white hover:bg-gray-100 text-primary px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
                            Start Free Trial
                            <x-heroicon-s-arrow-right class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform" />
                        </a>
                        <a href="#demo" class="bg-accent hover:bg-accent-90 text-dark px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200">
                            Watch Demo
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="group bg-white hover:bg-gray-100 text-primary px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105">
                            Go to Dashboard
                            <x-heroicon-s-arrow-right class="w-5 h-5 ml-2 inline-block group-hover:translate-x-1 transition-transform" />
                        </a>
                    @endguest
                </div>

                <p class="text-white/70 text-sm mt-6">No credit card required • 14-day free trial • Cancel anytime</p>
            </div>
        </section>

        <!-- Footer -->
        <footer id="about" class="bg-white border-t border-gray-200/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-lg">
                                <x-heroicon-s-bolt class="w-6 h-6 text-white" />
                            </div>
                            <span class="text-2xl font-bold text-dark">Rethink</span>
                        </div>
                        <p class="text-dark-60 mb-6 max-w-md leading-relaxed">
                            Transform your business with our powerful SaaS platform. Built for teams that demand performance, security, and scalability.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-primary-20 hover:bg-primary/30 rounded-lg flex items-center justify-center transition-colors">
                                <span class="text-dark-60 hover:text-dark text-sm font-semibold">tw</span>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary-20 hover:bg-primary/30 rounded-lg flex items-center justify-center transition-colors">
                                <span class="text-dark-60 hover:text-dark text-sm font-semibold">li</span>
                            </a>
                            <a href="#" class="w-10 h-10 bg-primary-20 hover:bg-primary/30 rounded-lg flex items-center justify-center transition-colors">
                                <span class="text-dark-60 hover:text-dark text-sm font-semibold">gh</span>
                            </a>
                        </div>
                    </div>

                    <!-- Product -->
                    <div>
                        <h3 class="text-dark font-semibold mb-4">Product</h3>
                        <ul class="space-y-3">
                            <li><a href="#features" class="text-dark-60 hover:text-dark transition-colors">Features</a></li>
                            <li><a href="#pricing" class="text-dark-60 hover:text-dark transition-colors">Pricing</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Security</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Integrations</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">API</a></li>
                        </ul>
                    </div>

                    <!-- Company -->
                    <div>
                        <h3 class="text-dark font-semibold mb-4">Company</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">About</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Blog</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Careers</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Contact</a></li>
                            <li><a href="#" class="text-dark-60 hover:text-dark transition-colors">Support</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom -->
                <div class="border-t border-primary-20 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-6 mb-4 md:mb-0">
                        <p class="text-dark-60 text-sm">
                            © {{ date('Y') }} Rethink. All rights reserved.
                        </p>
                        <a href="#" class="text-dark-60 hover:text-dark text-sm transition-colors">Privacy Policy</a>
                        <a href="#" class="text-dark-60 hover:text-dark text-sm transition-colors">Terms of Service</a>
                    </div>
                    <div class="flex items-center space-x-2 text-dark-60 text-sm">
                        <span>Built with</span>
                        <x-heroicon-s-heart class="w-4 h-4 text-accent" />
                        <span>using Laravel & Livewire</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
