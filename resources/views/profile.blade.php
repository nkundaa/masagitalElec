@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-xl mx-auto px-4 sm:px-6">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Profile</h1>
        
        <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8 shadow-sm">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase mb-1">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        required
                        value="{{ old('name', Auth::user()->name) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        value="{{ old('email', Auth::user()->email) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold text-gray-700 uppercase mb-1">Phone Number</label>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        required
                        value="{{ old('phone', Auth::user()->phone) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                    />
                </div>

                <div class="border-t border-gray-100 pt-5 mt-5">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Change Password (Optional)</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-xs font-bold text-gray-700 uppercase mb-1">New Password (Min 6 chars)</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Leave blank to keep current password"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                            />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase mb-1">Confirm New Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Leave blank to keep current password"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-medium"
                            />
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-teal-500/20 active:scale-95 text-center text-sm flex items-center justify-center gap-2"
                >
                    <i data-lucide="save" class="w-4 h-4"></i> Save Settings
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
