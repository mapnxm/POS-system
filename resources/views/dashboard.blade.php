<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 mx-4 md:mx-8">
        <!-- Card Total Pesanan Hari Ini -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-8 relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-blue-400 bg-opacity-30 flex items-center justify-center">
                <svg class="w-12 h-12 text-white transform rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm font-medium">Total Pesanan Hari Ini</p>
                    <h3 class="text-white text-3xl font-bold mt-2">{{ $todayCustomers }}</h3>
                </div>
            </div>
            <p class="text-blue-100 text-sm mt-4">Pesanan yang Diterima Hari Ini</p>
        </div>
    
        <!-- Card Total Pesanan Mingguan -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-8 relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-green-400 bg-opacity-30 flex items-center justify-center">
                <svg class="w-12 h-12 text-white transform rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm font-medium">Total Pesanan Minggu Ini</p>
                    <h3 class="text-white text-3xl font-bold mt-2">{{ $totalOrders }}</h3>
                </div>
            </div>
            <p class="text-green-100 text-sm mt-4">Total Jumlah Pesanan Berhasil</p>
        </div>
    
        <!-- Card Total Pendapatan -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-8 relative overflow-hidden">
            <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full bg-purple-400 bg-opacity-30 flex items-center justify-center">
                <svg class="w-12 h-12 text-white transform rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white text-sm font-medium">Total Pendapatan</p>
                    <h3 class="text-white text-3xl font-bold mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
            <p class="text-purple-100 text-sm mt-4">Total Pendapatan Keseluruhan</p>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Riwayat Pesanan Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    {{-- <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody id="order-list" class="bg-white divide-y divide-gray-200">
                                @foreach($list as $l)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{$l->id}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$l->customer->name}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{$l->payment_status}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp{{ number_format($l->total, 0, ',', '.') }}</td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-300">
                                            <i class="fas fa-eye mr-2"></i>View
                                        </button>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination-container" class="mt-6">
                        {{ $list->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#order-list').html(data.list);
                        $('#pagination-container').html(data.pagination);
                    }
                });
            });
        });
    </script>
</x-app-layout>