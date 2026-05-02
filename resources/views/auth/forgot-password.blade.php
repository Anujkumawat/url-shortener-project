<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-luxury {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .input-luxury:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 50%, #d4af37 100%);
            background-size: 200% 200%;
            animation: shimmer 3s ease infinite;
        }

        @keyframes shimmer {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        .link-gold {
            color: #d4af37;
            transition: all 0.3s ease;
        }

        .link-gold:hover {
            color: #f4d03f;
        }

        .fade-in {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center">
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden h-screen">
            <!-- ...branding/left side as before... -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-72 h-72 bg-yellow-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-yellow-400/10 rounded-full blur-3xl"></div>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-yellow-500/20 rounded-full">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-yellow-500/10 rounded-full">
                </div>
            </div>
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                <div class="text-center fade-in" style="animation-delay: 0.2s;">
                    <h1 class="font-playfair text-5xl font-bold mb-6 tracking-wide">Sembark</h1>
                    <p class="text-xl text-white/70 mb-8 font-light tracking-wider">ELEVATE YOUR JOURNEY</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 mx-auto mb-8"></div>
                    <p class="text-white/50 max-w-md mx-auto leading-relaxed">Experience luxury like never before. Join
                        our exclusive community and discover a world of premium services.</p>
                </div>
                <div class="mt-16 grid grid-cols-3 gap-8 fade-in" style="animation-delay: 0.4s;">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full glass-effect flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <p class="text-xs text-white/60 uppercase tracking-wider">Secure</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full glass-effect flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <p class="text-xs text-white/60 uppercase tracking-wider">Fast</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full glass-effect flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <p class="text-xs text-white/60 uppercase tracking-wider">Premium</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex items-center justify-center h-screen bg-[#0a0a0a]">
            <div class="w-full max-w-md fade-in bg-white/5 p-8 rounded-2xl shadow-2xl">
                <div class="lg:hidden text-center mb-8">
                    <h1 class="font-playfair text-4xl font-bold text-white mb-2">Sembark</h1>
                    <p class="text-yellow-400 text-sm tracking-widest">ELEVATE YOUR JOURNEY</p>
                </div>
                <div class="mb-8">
                    <h2 class="text-3xl font-light text-white mb-2">Forgot Password</h2>
                    <p class="text-white/50">Enter your email to receive a password reset link</p>
                </div>
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-white/70 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            placeholder="Enter your email"
                            class="input-luxury w-full px-4 py-3 rounded-lg text-white placeholder-white/30 focus:outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <button type="submit"
                        class="btn-gold w-full py-3 px-6 rounded-lg text-black font-semibold tracking-wide transition-all duration-300">EMAIL
                        PASSWORD RESET LINK</button>
                </form>
                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="link-gold font-medium hover:underline">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>