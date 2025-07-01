<x-app-layout>
    <div class="min-h-screen py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 bg-white rounded-lg shadow p-4">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Menu</h1>
                <p class="mt-2 text-gray-600">Menu yang tersedia</p>
            </div>

            <!-- Filter Menu -->
            <div class="mb-8 bg-white rounded-lg shadow p-4">
                <div class="flex flex-wrap gap-4">
                    <button onclick="filterMenu('all')" class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-colors">
                        Semua
                    </button>
                    <button onclick="filterMenu('food')" class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-colors">
                        Makanan
                    </button>
                    <button onclick="filterMenu('drink')" class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-colors">
                        Minuman
                    </button>
                    <button onclick="filterMenu('dessert')" class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition-colors">
                        Dessert
                    </button>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Makanan Section -->
                <div id="food-section" class="bg-white rounded-lg shadow p-6 menu-section">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Makanan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($foods as $f)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ asset('storage/public/img/' . $f->img) }}" alt="{{ $f->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $f->name }}</h3>
                                <p class="mt-1 text-gray-500 text-sm line-clamp-2">{{ $f->description }}</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">Rp {{ number_format($f->price, 0, ',', '.') }}</p>
                                <div class="flex gap-2 mt-3">
                                    <button onclick="confirmDelete('{{ route('products.destroy', $f->id) }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                    <a href="{{ route('products.edit', $f->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Minuman Section -->
                <div id="drink-section" class="bg-white rounded-lg shadow p-6 menu-section">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Minuman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($drinks as $drink)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ asset('storage/public/img/' . $drink->img) }}" alt="{{ $drink->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $drink->name }}</h3>
                                <p class="mt-1 text-gray-500 text-sm line-clamp-2">{{ $drink->description }}</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">Rp {{ number_format($drink->price, 0, ',', '.') }}</p>
                                <div class="flex gap-2 mt-3">
                                    <button onclick="confirmDelete('{{ route('products.destroy', $drink->id) }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                    <a href="{{ route('products.edit', $drink->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dessert Section -->
                <div id="dessert-section" class="bg-white rounded-lg shadow p-6 menu-section">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Dessert</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($desserts as $dessert)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ asset('storage/public/img/' . $dessert->img) }}" alt="{{ $dessert->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $dessert->name }}</h3>
                                <p class="mt-1 text-gray-500 text-sm line-clamp-2">{{ $dessert->description }}</p>
                                <p class="mt-2 text-lg font-semibold text-gray-900">Rp {{ number_format($dessert->price, 0, ',', '.') }}</p>
                                <div class="flex gap-2 mt-3">
                                    <button onclick="confirmDelete('{{ route('products.destroy', $dessert->id) }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                    <a href="{{ route('products.edit', $dessert->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sweet Alert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Menu yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function filterMenu(category) {
            const sections = document.querySelectorAll('.menu-section');
            sections.forEach(section => {
                if (category === 'all') {
                    section.style.display = 'block';
                } else {
                    if (section.id === category + '-section') {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                }
            });
        }
    </script>
</x-app-layout>