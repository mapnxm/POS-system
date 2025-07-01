<x-app-layout>
    <div class="min-h-screen py-12 bg-gradient-to-br from-slate-50 via-gray-50 to-zinc-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="bg-white/90 backdrop-blur-lg shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Tambah Menu Baru</h2>
                    <p class="text-center text-gray-600 mb-8">Silakan lengkapi informasi menu di bawah ini</p>

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="group mb-8">
                            <label class="block text-gray-700 font-semibold mb-4">Foto Menu</label>
                            <div class="flex flex-col items-center">
                                <div class="relative w-full h-64 mb-4">
                                    <div class="absolute inset-0 rounded-lg overflow-hidden group">
                                        <img id="preview" src="{{ asset('asset/img/placeholder-image.jpg') }}" 
                                            class="w-full h-full object-cover transition duration-300 group-hover:opacity-75"
                                            alt="Preview">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                            <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                Klik untuk memilih foto
                                            </span>
                                        </div>
                                    </div>
                                    <input type="file" name="img" id="img" accept="image/*"
                                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer"
                                        onchange="previewImage(event)">
                                </div>
                                <p class="text-sm text-gray-500">
                                    Klik area di atas untuk mengunggah foto. Format yang didukung: JPG, PNG. Maksimal 10MB.
                                </p>
                            </div>
                            @error('img')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="group">
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Menu</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                    </svg>
                                </span>
                                <input type="text" name="name" id="name" required
                                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                                    placeholder="Masukkan nama menu">
                            </div>
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="price" class="block text-gray-700 font-semibold mb-2">Harga</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    Rp
                                </span>
                                <input type="text" name="display_price" id="display_price" required
                                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                                    placeholder="Masukkan harga"
                                    oninput="formatPrice(this.value)">
                                <input type="number" name="price" id="price" step="0.01" hidden>
                            </div>
                            @error('price')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                            <textarea name="description" id="description" required rows="4"
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150"
                                placeholder="Deskripsikan menu Anda"></textarea>
                            @error('description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="category_id" class="block text-gray-700 font-semibold mb-2">Kategori Menu</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </span>
                                <select name="category_id" id="category_id" required
                                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            @if($category->id == 1)
                                                🍽️ {{-- Icon untuk makanan --}}
                                            @elseif($category->id == 2) 
                                                🥤 {{-- Icon untuk minuman --}}
                                            @elseif($category->id == 3)
                                                🍰 {{-- Icon untuk dessert --}}
                                            @endif
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-center pt-6">
                            <button type="submit" 
                                class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <span>Tambah Menu</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function formatPrice(value) {
            // Hapus semua karakter non-digit
            let number = value.replace(/\D/g, '');
            
            // Convert ke decimal untuk hidden input (tidak dibagi 100)
            document.getElementById('price').value = number;
            
            // Format untuk display
            if(number === '') {
                document.getElementById('display_price').value = '';
                return;
            }
            
            // Format dengan pemisah ribuan
            let formattedNumber = new Intl.NumberFormat('id-ID').format(number);
            document.getElementById('display_price').value = formattedNumber;
        }
    </script>
</x-app-layout>