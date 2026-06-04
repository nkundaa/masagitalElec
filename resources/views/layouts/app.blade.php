<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masagital Electronics - Sensors, Microcontrollers, IoT & More</title>
    <link rel="icon" type="image/png" href="/images/logo.png" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Vite CSS/JS compilation -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 flex flex-col font-sans antialiased text-gray-900">

    <!-- Header / Navbar -->
    <nav class="bg-gray-900 text-white sticky top-0 z-50 shadow-lg border-b border-teal-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                    <div class="w-9 h-9 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-lg font-bold bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent">
                            Masagital
                        </span>
                        <span class="text-xs block text-gray-400 -mt-1 tracking-wider">ELECTRONICS</span>
                    </div>
                </a>

                <!-- Search Bar - Desktop -->
                <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-lg mx-6">
                    <div class="relative w-full">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search sensors, microcontrollers, IoT..."
                            value="{{ request('search') }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded-full py-2 pl-4 pr-10 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-all"
                        />
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-400 transition-colors">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>

                <!-- Nav Links - Desktop -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                        Home
                    </a>

                    <!-- Categories Dropdown -->
                    <div class="relative" id="categories-dropdown-container">
                        <button
                            id="categories-dropdown-btn"
                            class="flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request('category') ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}"
                        >
                            Products <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" id="categories-chevron"></i>
                        </button>
                        <div id="categories-dropdown-menu" class="hidden absolute left-0 mt-2 w-72 bg-gray-800 rounded-xl shadow-xl border border-gray-700 py-2 z-50">
                            <a
                                href="{{ route('products.index') }}"
                                class="block px-4 py-3 text-sm text-teal-400 hover:bg-gray-700 transition-colors font-semibold border-b border-gray-700 mb-1"
                            >
                                🔧 All Products
                            </a>
                            <a
                                href="{{ route('products.index', ['category' => 'sensors']) }}"
                                class="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-3"
                            >
                                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="radio" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Sensors</p>
                                    <p class="text-xs text-gray-500">Temperature, motion, distance</p>
                                </div>
                            </a>
                            <a
                                href="{{ route('products.index', ['category' => 'microcontrollers']) }}"
                                class="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-3"
                            >
                                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="cpu" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Microcontrollers</p>
                                    <p class="text-xs text-gray-500">Arduino, ESP32, Pico</p>
                                </div>
                            </a>
                            <a
                                href="{{ route('products.index', ['category' => 'iot']) }}"
                                class="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-3"
                            >
                                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="globe" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium">IoT Systems</p>
                                    <p class="text-xs text-gray-500">WiFi, LoRa, GSM modules</p>
                                </div>
                            </a>
                            <a
                                href="{{ route('products.index', ['category' => 'actuators']) }}"
                                class="px-4 py-3 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-3"
                            >
                                <div class="w-8 h-8 bg-gray-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="cog" class="w-4 h-4 text-teal-400"></i>
                                </div>
                                <div>
                                    <p class="font-medium">Actuators</p>
                                    <p class="text-xs text-gray-500">Motors, servos, relays</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('contact.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('contact.index') ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                        Contact
                    </a>

                    <a href="{{ route('faq') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('faq') ? 'bg-teal-500/10 text-teal-400' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                        FAQ
                    </a>

                    <!-- Cart Icon -->
                    @php
                        $cartItemCount = array_sum(array_column(session('cart', []), 'quantity'));
                    @endphp
                    <a
                        href="{{ route('cart.index') }}"
                        class="relative p-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-colors ml-1"
                    >
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        @if($cartItemCount > 0)
                            <span class="absolute -top-1 -right-1 bg-teal-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold animate-pulse">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </a>

                    <!-- User Account / Dropdown -->
                    @auth
                        <div class="relative ml-1" id="user-dropdown-container">
                            <button
                                id="user-dropdown-btn"
                                class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-colors"
                            >
                                <div class="w-7 h-7 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden lg:inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                <i data-lucide="chevron-down" class="w-3 h-3 transition-transform" id="user-chevron"></i>
                            </button>
                            <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-gray-800 rounded-xl shadow-xl border border-gray-700 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-700">
                                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                </div>
                                <a
                                    href="{{ route('profile') }}"
                                    class="px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                                >
                                    <i data-lucide="user-round" class="w-4 h-4"></i> My Profile
                                </a>
                                <a
                                    href="{{ route('orders.index') }}"
                                    class="px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                                >
                                    <i data-lucide="package" class="w-4 h-4"></i> My Orders
                                </a>
                                <a
                                    href="{{ route('cart.index') }}"
                                    class="px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-gray-700 transition-colors flex items-center gap-2"
                                >
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i> My Cart
                                    @if($cartItemCount > 0)
                                        <span class="text-xs bg-teal-500 text-white px-1.5 rounded-full ml-auto">{{ $cartItemCount }}</span>
                                    @endif
                                </a>
                                <div class="border-t border-gray-700 mt-1 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="w-full text-left px-4 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-gray-700 transition-colors flex items-center gap-2"
                                        >
                                            <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="ml-2 flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-all shadow-lg shadow-teal-500/20"
                        >
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span>Sign In</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Action Menu Toggles -->
                <div class="flex md:hidden items-center gap-2">
                    <a
                        href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-300 hover:text-white"
                    >
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        @if($cartItemCount > 0)
                            <span class="absolute -top-1 -right-1 bg-teal-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </a>
                    <button
                        id="mobile-menu-toggle-btn"
                        class="p-2 text-gray-300 hover:text-white"
                    >
                        <i data-lucide="menu" class="w-6 h-6" id="mobile-menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800 border-t border-gray-700 max-h-[calc(100vh-4rem)] overflow-y-auto">
            <div class="px-4 py-3 space-y-1">
                <form action="{{ route('products.index') }}" method="GET" class="mb-3">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search products..."
                            value="{{ request('search') }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-full py-2 pl-4 pr-10 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-teal-500"
                        />
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>

                <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium">
                    🏠 Home
                </a>
                <a href="{{ route('products.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium">
                    🔧 All Products
                </a>

                <!-- Mobile Categories List -->
                <div class="pl-3 py-1 space-y-1 border-l border-gray-700 ml-3">
                    <a
                        href="{{ route('products.index', ['category' => 'sensors']) }}"
                        class="block px-3 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 text-sm flex items-center gap-2"
                    >
                        <i data-lucide="radio" class="w-3.5 h-3.5 text-teal-400"></i> Sensors
                    </a>
                    <a
                        href="{{ route('products.index', ['category' => 'microcontrollers']) }}"
                        class="block px-3 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 text-sm flex items-center gap-2"
                    >
                        <i data-lucide="cpu" class="w-3.5 h-3.5 text-teal-400"></i> Microcontrollers
                    </a>
                    <a
                        href="{{ route('products.index', ['category' => 'iot']) }}"
                        class="block px-3 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 text-sm flex items-center gap-2"
                    >
                        <i data-lucide="globe" class="w-3.5 h-3.5 text-teal-400"></i> IoT Systems
                    </a>
                    <a
                        href="{{ route('products.index', ['category' => 'actuators']) }}"
                        class="block px-3 py-2 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 text-sm flex items-center gap-2"
                    >
                        <i data-lucide="cog" class="w-3.5 h-3.5 text-teal-400"></i> Actuators
                    </a>
                </div>

                <a href="{{ route('contact.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
                    <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i> Contact Us
                </a>
                <a href="{{ route('faq') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
                    <i data-lucide="help-circle" class="w-4 h-4 text-gray-400"></i> FAQ
                </a>
                <a href="{{ route('shipping') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
                    <i data-lucide="truck" class="w-4 h-4 text-gray-400"></i> Shipping Info
                </a>
                <a href="{{ route('returns') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 font-medium flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-gray-400"></i> Returns & Refunds
                </a>

                @auth
                    <div class="border-t border-gray-700 mt-2 pt-2">
                        <a href="{{ route('profile') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 flex items-center gap-2">
                            <i data-lucide="user-round" class="w-4 h-4 text-gray-400"></i> My Profile
                        </a>
                        <a href="{{ route('orders.index') }}" class="block px-3 py-2.5 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700 flex items-center gap-2">
                            <i data-lucide="package" class="w-4 h-4 text-gray-400"></i> My Orders
                        </a>
                    </div>
                    <div class="border-t border-gray-700 mt-2 pt-2">
                        <p class="px-3 py-1 text-xs text-gray-500">Signed in as <span class="text-gray-300">{{ Auth::user()->name }}</span></p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2.5 rounded-lg text-red-400 hover:bg-gray-700 flex items-center gap-2">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-700 mt-2 pt-3">
                        <a href="{{ route('login') }}" class="block px-3 py-2.5 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-medium text-center">
                            Sign In / Create Account
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Floating Session Alerts (replaces react-hot-toast) -->
    <div class="fixed top-20 right-4 z-50 flex flex-col gap-2 max-w-sm w-full">
        @if(session('success'))
            <div class="session-alert bg-gray-900 border border-teal-500/30 text-white shadow-xl rounded-xl p-4 flex items-start gap-3">
                <span class="text-teal-400 text-xl font-bold">🛒</span>
                <div class="flex-1 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white text-xs">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="session-alert bg-gray-900 border border-red-500/30 text-white shadow-xl rounded-xl p-4 flex items-start gap-3">
                <span class="text-red-400 text-xl font-bold">⚠️</span>
                <div class="flex-1 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white text-xs">&times;</button>
            </div>
        @endif

        @if(session('info'))
            <div class="session-alert bg-gray-900 border border-blue-500/30 text-white shadow-xl rounded-xl p-4 flex items-start gap-3">
                <span class="text-blue-400 text-xl font-bold">ℹ️</span>
                <div class="flex-1 text-sm font-medium">
                    {{ session('info') }}
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white text-xs">&times;</button>
            </div>
        @endif

        <!-- Form validation error alerts -->
        @if($errors->any())
            <div class="session-alert bg-gray-900 border border-red-500/30 text-white shadow-xl rounded-xl p-4 flex flex-col gap-1">
                <div class="flex items-center justify-between border-b border-gray-800 pb-1.5 mb-1">
                    <span class="text-red-400 text-sm font-semibold flex items-center gap-1.5">
                        <i data-lucide="alert-triangle" class="w-4 h-4"></i> Validation Errors
                    </span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-white text-xs">&times;</button>
                </div>
                <ul class="list-disc pl-4 text-xs text-gray-300 space-y-1 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                        <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="cpu" class="w-4 h-4 text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-white">Masagital</span>
                    </a>
                    <p class="text-sm leading-relaxed mb-4 text-gray-400">
                        Your trusted source for electronic components, microcontrollers, and IoT solutions in Rwanda.
                    </p>
                    <a href="https://wa.me/250780000000" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-2 rounded-lg transition-colors font-medium">
                        💬 Chat on WhatsApp
                    </a>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Categories</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('products.index', ['category' => 'sensors']) }}" class="hover:text-teal-400 transition-colors">📡 Sensors</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'microcontrollers']) }}" class="hover:text-teal-400 transition-colors">🔌 Microcontrollers</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'iot']) }}" class="hover:text-teal-400 transition-colors">🌐 IoT Systems</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'actuators']) }}" class="hover:text-teal-400 transition-colors">⚙️ Actuators</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-teal-400 transition-colors">🔧 All Products</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('contact.index') }}" class="hover:text-teal-400 transition-colors">📞 Contact Us</a></li>
                        <li><a href="{{ route('shipping') }}" class="hover:text-teal-400 transition-colors">🚚 Shipping Info</a></li>
                        <li><a href="{{ route('returns') }}" class="hover:text-teal-400 transition-colors">🔄 Returns</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-teal-400 transition-colors">❓ FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="https://maps.google.com/?q=Kigali,Rwanda" target="_blank" rel="noopener noreferrer" class="hover:text-teal-400 transition-colors flex items-center gap-1.5">
                                📍 Kigali, Rwanda
                            </a>
                        </li>
                        <li>
                            <a href="tel:+250780000000" class="hover:text-teal-400 transition-colors flex items-center gap-1.5">
                                📞 +250 780 000 000
                            </a>
                        </li>
                        <li>
                            <a href="mailto:info@masagital.rw" class="hover:text-teal-400 transition-colors flex items-center gap-1.5">
                                📧 info@masagital.rw
                            </a>
                        </li>
                        <li>⏰ Mon – Sat: 8AM – 6PM</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm">&copy; {{ date('Y') }} Masagital Electronics. All rights reserved.</p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('faq') }}" class="hover:text-teal-400 transition-colors">Privacy Policy</a>
                    <span class="text-gray-700">&bull;</span>
                    <a href="{{ route('faq') }}" class="hover:text-teal-400 transition-colors">Terms of Service</a>
                    <span class="text-gray-700">&bull;</span>
                    <a href="{{ route('returns') }}" class="hover:text-teal-400 transition-colors">Refund Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Float -->
    <a
        href="https://wa.me/250780000000"
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-3.5 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all z-40 flex items-center justify-center"
        title="Chat on WhatsApp"
    >
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.517 2.266 2.27 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 2.766 1.488 4.793 1.489 5.421 0 9.83-4.385 9.834-9.778.002-2.611-1.015-5.064-2.868-6.92C16.49 2.088 14.043 1.07 11.43 1.07 6.008 1.07 1.6 5.455 1.597 10.849c-.001 2.107.556 3.4 1.542 5.093l-.982 3.585 3.688-.973zm11.378-5.305c-.328-.164-1.942-.959-2.242-1.069-.3-.11-.518-.164-.736.164-.218.328-.845 1.069-1.036 1.288-.19.219-.382.246-.71.082-.328-.164-1.386-.51-2.64-1.627-.975-.87-1.633-1.946-1.824-2.274-.19-.328-.02-.505.144-.668.148-.147.328-.383.492-.574.164-.19.218-.328.328-.546.11-.219.055-.41-.027-.574-.082-.164-.736-1.776-1.009-2.432-.266-.641-.539-.553-.736-.563-.19-.01-.409-.01-.628-.01-.218 0-.573.082-.873.41-.3.328-1.146 1.12-1.146 2.732s1.173 3.17 1.337 3.388c.164.218 2.308 3.525 5.59 4.95 2.622 1.137 3.32 1.01 4.514.83.654-.1 1.942-.794 2.215-1.56.273-.765.273-1.42.19-1.56-.081-.14-.3-.218-.627-.382z"/>
        </svg>
    </a>

    <!-- UI Toggles & Dropdown Handling scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Category Dropdown
            const catBtn = document.getElementById('categories-dropdown-btn');
            const catMenu = document.getElementById('categories-dropdown-menu');
            const catChevron = document.getElementById('categories-chevron');
            
            if (catBtn && catMenu) {
                catBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    catMenu.classList.toggle('hidden');
                    catChevron.classList.toggle('rotate-180');
                    // Hide user menu if open
                    if (userMenu) {
                        userMenu.classList.add('hidden');
                        if (userChevron) userChevron.classList.remove('rotate-180');
                    }
                });
            }

            // User Dropdown
            const userBtn = document.getElementById('user-dropdown-btn');
            const userMenu = document.getElementById('user-dropdown-menu');
            const userChevron = document.getElementById('user-chevron');
            
            if (userBtn && userMenu) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userMenu.classList.toggle('hidden');
                    userChevron.classList.toggle('rotate-180');
                    // Hide category menu if open
                    if (catMenu) {
                        catMenu.classList.add('hidden');
                        if (catChevron) catChevron.classList.remove('rotate-180');
                    }
                });
            }

            // Close menus on clicking outside
            document.addEventListener('click', (e) => {
                if (catMenu && !catMenu.classList.contains('hidden') && !e.target.closest('#categories-dropdown-container')) {
                    catMenu.classList.add('hidden');
                    catChevron.classList.remove('rotate-180');
                }
                if (userMenu && !userMenu.classList.contains('hidden') && !e.target.closest('#user-dropdown-container')) {
                    userMenu.classList.add('hidden');
                    userChevron.classList.remove('rotate-180');
                }
            });

            // Mobile Hamburger menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-toggle-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                    const iconName = mobileMenu.classList.contains('hidden') ? 'menu' : 'x';
                    const icon = document.getElementById('mobile-menu-icon');
                    if (icon) {
                        icon.setAttribute('data-lucide', iconName);
                        if (window.lucide) {
                            window.lucide.createIcons();
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
