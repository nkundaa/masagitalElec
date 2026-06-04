@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden grid md:grid-cols-2">
        
        <!-- Left Pane: Branding / Context -->
        <div class="bg-gray-900 text-white p-8 md:p-12 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute inset-0">
                <img
                    src="https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                    alt="Branding background"
                    class="w-full h-full object-cover opacity-10"
                />
                <div class="absolute inset-0 bg-gradient-to-br from-teal-900/30 to-gray-900"></div>
            </div>
            
            <div class="relative z-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8 hover:opacity-80 transition-opacity">
                    <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="zap" class="w-4 h-4 text-white"></i>
                    </div>
                    <span class="text-lg font-bold text-white">Masagital</span>
                </a>
                
                <div class="inline-flex items-center gap-2 bg-teal-500/10 border border-teal-500/20 text-teal-400 px-3 py-1 rounded-full text-xs font-semibold mb-6">
                    ⚡ Member Account
                </div>
                
                <h2 class="text-3xl font-extrabold tracking-tight mb-4">
                    Unlock Premium Developer Features
                </h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Create an account to save shipping details, keep track of order histories, download tutorial documentation, and receive expert developer support.
                </p>
                
                <ul class="space-y-3.5 text-sm text-gray-300 font-medium">
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check-circle" class="w-4 h-4 text-teal-400"></i> Fast Mobile Money Checkout
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check-circle" class="w-4 h-4 text-teal-400"></i> Trace Orders in Real-time
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="check-circle" class="w-4 h-4 text-teal-400"></i> Get Step-by-Step Code Guides
                    </li>
                </ul>
            </div>
            
            <div class="relative z-10 text-xs text-gray-500 mt-8">
                &copy; {{ date('Y') }} Masagital Electronics. All rights reserved.
            </div>
        </div>

        <!-- Right Pane: Forms (Sign In & Sign Up) -->
        <div class="p-8 md:p-12 flex flex-col justify-center">
            <!-- Tabs Toggle Header -->
            <div class="flex border-b border-gray-100 mb-8">
                <button
                    type="button"
                    onclick="switchForm('login')"
                    id="tab-login"
                    class="flex-1 pb-3 text-center text-sm font-bold border-b-2 border-teal-500 text-teal-600 focus:outline-none"
                >
                    Sign In
                </button>
                <button
                    type="button"
                    onclick="switchForm('register')"
                    id="tab-register"
                    class="flex-1 pb-3 text-center text-sm font-bold border-b-2 border-transparent text-gray-400 hover:text-gray-700 focus:outline-none"
                >
                    Create Account
                </button>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" id="form-login" class="space-y-5">
                @csrf
                <div>
                    <label for="login-email" class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="login-email"
                        required
                        value="{{ old('email') }}"
                        placeholder="developer@masagital.rw"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>
                
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="login-password" class="block text-xs font-bold text-gray-700 uppercase">Password</label>
                    </div>
                    <input
                        type="password"
                        name="password"
                        id="login-password"
                        required
                        placeholder="••••••••"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-teal-500/20 active:scale-95 text-sm flex items-center justify-center gap-2"
                >
                    <i data-lucide="log-in" class="w-4 h-4"></i> Sign In to Account
                </button>
            </form>

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" id="form-register" class="hidden space-y-4">
                @csrf
                <div>
                    <label for="register-name" class="block text-xs font-bold text-gray-700 uppercase mb-1">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        id="register-name"
                        required
                        value="{{ old('name') }}"
                        placeholder="Alex Niyomugabo"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="register-email" class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="register-email"
                        required
                        value="{{ old('email') }}"
                        placeholder="alex@example.com"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="register-phone" class="block text-xs font-bold text-gray-700 uppercase mb-1">MTN Phone Number</label>
                    <input
                        type="tel"
                        name="phone"
                        id="register-phone"
                        required
                        value="{{ old('phone') }}"
                        placeholder="0788123456"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="register-password" class="block text-xs font-bold text-gray-700 uppercase mb-1">Password (Min 6 characters)</label>
                    <input
                        type="password"
                        name="password"
                        id="register-password"
                        required
                        placeholder="••••••••"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="register-password-confirm" class="block text-xs font-bold text-gray-700 uppercase mb-1">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="register-password-confirm"
                        required
                        placeholder="••••••••"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2.5 px-4 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-teal-500/20 active:scale-95 text-sm flex items-center justify-center gap-2"
                >
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Create Account
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function switchForm(mode) {
        const loginForm = document.getElementById('form-login');
        const registerForm = document.getElementById('form-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');

        if (mode === 'login') {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            
            tabLogin.classList.remove('border-transparent', 'text-gray-400');
            tabLogin.classList.add('border-teal-500', 'text-teal-600');
            
            tabRegister.classList.remove('border-teal-500', 'text-teal-600');
            tabRegister.classList.add('border-transparent', 'text-gray-400');
        } else {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            
            tabRegister.classList.remove('border-transparent', 'text-gray-400');
            tabRegister.classList.add('border-teal-500', 'text-teal-600');
            
            tabLogin.classList.remove('border-teal-500', 'text-teal-600');
            tabLogin.classList.add('border-transparent', 'text-gray-400');
        }
    }

    // Proactively switch tab if there were validation errors in registration fields
    @if($errors->has('name') || $errors->has('phone') || $errors->has('password_confirmation'))
        document.addEventListener('DOMContentLoaded', () => {
            switchForm('register');
        });
    @endif
</script>
@endsection
