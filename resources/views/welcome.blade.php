<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Warung Makan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <style>
            .scroller::-webkit-scrollbar,
            body::-webkit-scrollbar{
                display: none;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gradient-to-br from-orange-50 to-orange-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-md fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <img src="../asset/img/logo 3.png" alt="Logo" class="h-12 hover:scale-110 transition-all duration-300">
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/menu" class="text-gray-600 hover:text-blue-600 transition-colors">Menu</a>
                        {{-- <a href="#about" class="text-gray-600 hover:text-blue-600 transition-colors">Tentang</a>
                        <a href="#contact" class="text-gray-600 hover:text-blue-600 transition-colors">Kontak</a> --}}
                        @guest
                            <a href="/login" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-all duration-300 font-medium">Login</a>
                        @else
                            <a href="/dashboard" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-all duration-300 font-medium">Dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center">
            <div class="absolute inset-0">
                <img src="../asset/img/hero-bg.jpg" class="w-full h-full object-cover opacity-20">
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="text-center">
                    <h1 class="text-6xl font-bold mb-6 text-blue-600 leading-tight">
                        Rasakan Kelezatan<br>Masakan Indonesia
                    </h1>
                    <p class="text-2xl text-gray-600 mb-12 max-w-2xl mx-auto">
                        Nikmati hidangan autentik Indonesia dengan bahan-bahan berkualitas dan racikan bumbu tradisional
                    </p>
                    <div class="flex justify-center gap-6">
                        <a href="/menu" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 font-semibold transform hover:scale-105">
                            <span>Jelajahi Menu</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <button onclick="document.getElementById('contactModal').classList.remove('hidden')" class="inline-flex items-center px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 font-semibold">
                            <i class="fas fa-phone mr-2"></i>
                            <span>Hubungi Kami</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-xl text-gray-600">Komitmen kami untuk memberikan pengalaman kuliner terbaik</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-utensils text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Makanan Berkualitas</h3>
                        <p class="text-gray-600">Bahan segar dan bumbu pilihan untuk cita rasa terbaik</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-clock text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Pelayanan Cepat</h3>
                        <p class="text-gray-600">Pesanan Anda disiapkan dengan cepat dan penuh perhatian</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Suasana Nyaman</h3>
                        <p class="text-gray-600">Tempat yang cocok untuk makan bersama keluarga</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Modal -->
        <div id="contactModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-2xl max-w-md w-full mx-4 shadow-xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-blue-600">Hubungi Kami</h3>
                    <button onclick="document.getElementById('contactModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-phone text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Telepon</p>
                            <p class="text-gray-600">+62 812-3456-7890</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Email</p>
                            <p class="text-gray-600">info@warungmakan.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Alamat</p>
                            <p class="text-gray-600">Jl. Contoh No. 123, Kota, Provinsi</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Jam Operasional</p>
                            <p class="text-gray-600">Senin - Minggu: 10:00 - 22:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <img src="../asset/img/logo 3.png" alt="Logo" class="h-12 mb-4">
                        <p class="text-gray-400">Menyajikan makanan Indonesia terbaik dengan cita rasa autentik sejak 2010</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Link Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="/menu" class="text-gray-400 hover:text-blue-600 transition-colors">Menu</a></li>
                            <li><a href="#about" class="text-gray-400 hover:text-blue-600 transition-colors">Tentang Kami</a></li>
                            <li><a href="#contact" class="text-gray-400 hover:text-blue-600 transition-colors">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-facebook text-2xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2024 Warung Makan. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
