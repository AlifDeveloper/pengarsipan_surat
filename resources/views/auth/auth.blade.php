<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-wave {
            position: relative;
            overflow: hidden;
        }

        .bg-wave::before {
            content: "";
            position: absolute;
            bottom: 0%;
            left: -20%;
            width: 120%;
            height: 120%;
            background-image: url("{{ asset('images/background.png') }}");
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 0;
            opacity: 0.3;
        }
    </style>
</head>
<body class="bg-primary bg-wave">
    <div class="min-h-screen flex relative font-poppins">
        <!-- Left side - Blue section with title -->
        <div class="hidden lg:flex lg:w-1/2  p-20 relative">
            <!-- Logo and Title -->
            <div class="absolute top-10 left-10 flex items-center space-x-4 z-10">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Kalurahan Karangrejek" class="w-16 h-16">
                <div>
                    <h2 class="font-semibold text-slate-800">Kalurahan Karangrejek</h2>
                    <p class="text-gray-600 font-medium">Kapanewon Wonosari</p>
                </div>
            </div>

            <!-- Main Title -->
            <div class="mt-25 relative z-10 items-center">
                <h1 class="text-6xl font-bold text-blue-400 leading-tight">
                    e-ARSIP DESA.<br>
                </h1>
                <p class="text-6xl font-bold text-slate-500 leading-tight">SISTEM PENGARSIPAN SURAT DESA</p>
        
                </B>
            </div>
        </div>

        <!-- Right side - Login form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-10 relative z-10">
            <div class="w-full max-w-md">

                <!-- Login form -->
                <div class="bg-gray-100 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-2">Selamat Datang!</h2>
                    <p class="text-gray-600 text-center mb-6">Silahkan masukkan username dan password anda </p>

                    <form action="{{ route('auth.verify') }}" method="POST">
                        @csrf

                        <!-- Username Field -->
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 mb-2">Username</label>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Password Field -->
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Masukkan Password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 right-0 flex items-center px-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full cursor-pointer bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for password visibility toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const eyeIcon = passwordField.nextElementSibling.querySelector('svg');

            eyeIcon.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
            });
        });
    </script>
</body>
</html>
