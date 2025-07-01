<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nota Pesanan</title>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen">
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white/90 backdrop-blur-lg p-8 rounded-2xl shadow-xl border border-gray-100">
            <div class="flex flex-col items-center">
                <img src="/asset/img/logo 3.png" alt="Logo" class="mb-6 h-20 transform hover:scale-105 transition-transform duration-300">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Nota Pesanan</h1>
                <h2 class="text-xl text-gray-700 mb-1">ID Pesanan: #{{ $order->id }}</h2>
                <p class="text-gray-600">Nama Pelanggan: {{ $order->customer->name }}</p>
                <p class="text-gray-600">Tanggal: {{ now()->format('d/m/Y H:i:s')}}</p>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detail Pesanan:</h2>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @foreach($order->items as $item)
                                @php 
                                    $subtotal = $item->price * $item->quantity;
                                    $total += $subtotal; 
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 space-y-2">
                    <div class="flex justify-between items-center text-lg font-semibold text-gray-800">
                        <span>Total Keseluruhan:</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-lg font-semibold text-gray-800">
                        <span>Jenis Pembayaran:</span>
                        <span>{{ $order->paymentType->name }}</span>
                    </div>
                </div>

                <div class="mt-8 flex flex-col items-center">
                    <a href="{{ route('orders.print', $order->id) }}" 
                        class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                        id="downloadBtn"
                        download>
                        Download Struk
                    </a>
                </div>

                <div class="mt-8 text-center space-y-1">
                    <p class="text-gray-600 font-medium">Terima kasih atas pesanan Anda!</p>
                    <p class="text-gray-500">Silakan kunjungi kami kembali.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Menghapus halaman ini dari riwayat browser
            history.replaceState(null, null, "{{ url('/') }}");
            
            let hasDownloaded = false;
            const downloadBtn = document.getElementById('downloadBtn');
            
            // Timer untuk auto download setelah 10 detik
            const autoDownloadTimer = setTimeout(function() {
                if (!hasDownloaded) {
                    window.location.href = "{{ route('orders.print', $order->id) }}";
                    hasDownloaded = true;
                    redirectHome();
                }
            }, 10000); // Auto download setelah 10 detik
            
            // Event listener untuk tombol download manual
            downloadBtn.addEventListener('click', function() {
                hasDownloaded = true;
                clearTimeout(autoDownloadTimer);
                setTimeout(redirectHome, 1000);
            });
            
            function redirectHome() {
                setTimeout(function() {
                    window.location.href = "{{ url('/') }}";
                }, 2000);
            }
        }

        // Cegah pengguna kembali ke halaman ini
        window.addEventListener("popstate", function(event) {
            window.location.href = "{{ url('/') }}";
        });
    </script>
</body>
</html>
