<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Keranjang Belanja</title>
    <style>
        .scroller::-webkit-scrollbar,
        body::-webkit-scrollbar{
            display: none;
        }
        .payment-method {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .payment-method:hover {
            border-color: #3b82f6;
        }
        .payment-method.selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        .bank-options {
            display: none;
            margin-top: 0.5rem;
            padding-left: 2.5rem;
        }
        .bank-options.show {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('layouts.nav')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-4">Keranjang Belanja</h1>
            <div class="h-1 w-24 bg-blue-500 mx-auto rounded-full"></div>
            <a href="{{ route('menu.index') }}" class="inline-flex items-center px-6 py-3 mt-4 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Menu
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    @if(session('cart'))
                        <div class="divide-y divide-gray-200">
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity']; 
                                    $total += $subtotal;
                                @endphp
                                <div id="row_{{ $id }}" class="p-6 flex items-center space-x-6">
                                    <!-- Menu Image -->
                                   
                                    
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $details['name'] }}</h3>
                                        <p class="text-gray-600">Rp{{ number_format($details['price'], 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <button class="decrease-quantity w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center" data-id="{{ $id }}">
                                            <i class="fas fa-minus text-gray-600"></i>
                                        </button>
                                        <span class="w-12 text-center font-medium text-lg" id="quantity_{{ $id }}">{{ $details['quantity'] }}</span>
                                        <button class="increase-quantity w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center" data-id="{{ $id }}">
                                            <i class="fas fa-plus text-gray-600"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="text-right">
                                        <div class="text-lg font-semibold text-gray-900" id="subtotal_{{ $id }}">Rp{{ number_format($subtotal, 0, ',', '.') }}</div>
                                        <button onclick="confirmDelete({{ $id }})" class="text-red-500 hover:text-red-700 mt-2">
                                            <i class="fas fa-trash-alt mr-2"></i>Hapus
                                        </button>
                                        <form id="delete-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-shopping-cart text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">Keranjang Anda Kosong</h3>
                            <p class="text-gray-500 mb-6">Mulailah berbelanja untuk mengisi keranjang Anda</p>
                            <a href="{{ route('menu.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Checkout Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Items</span>
                            <span class="font-medium" id="total-items">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total Pembayaran</span>
                            <span class="text-blue-600" id="total">Rp{{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @if(session('cart'))
                        <form action="{{ route('cart.checkout') }}" method="POST" id="payment-form" class="space-y-6">
                            @csrf
                            <input type="hidden" name="total_amount" value="{{ $total }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text" name="name" id="customer_name" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="customer_email" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="tel" name="customer_phone" id="customer_phone" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                                <div class="payment-method" onclick="selectPayment('1')">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_type_id" value="1" class="hidden" required>
                                        <i class="fas fa-money-bill-wave text-2xl text-gray-600 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Tunai</div>
                                            <div class="text-sm text-gray-500">Bayar dengan uang tunai</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-method" onclick="selectPayment('2')">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_type_id" value="2" class="hidden">
                                        <i class="fas fa-qrcode text-2xl text-gray-600 mr-3"></i>
                                        <div>
                                            <div class="font-medium">QRIS</div>
                                            <div class="text-sm text-gray-500">Scan kode QR untuk pembayaran</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-method" onclick="toggleBankOptions()">
                                    <div class="flex items-center">
                                        <i class="fas fa-university text-2xl text-gray-600 mr-3"></i>
                                        <div>
                                            <div class="font-medium">Transfer Bank</div>
                                            <div class="text-sm text-gray-500">Pilih bank di bawah ini</div>
                                        </div>
                                    </div>
                                    <div class="bank-options" id="bankOptions">
                                        <div class="payment-method" onclick="selectPayment('3')">
                                            <input type="radio" name="payment_type_id" value="3" class="hidden">
                                            <div class="font-medium">BCA</div>
                                        </div>
                                        <div class="payment-method" onclick="selectPayment('4')">
                                            <input type="radio" name="payment_type_id" value="4" class="hidden">
                                            <div class="font-medium">BNI</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white py-4 px-6 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Bayar Sekarang</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleBankOptions() {
            const bankOptions = document.getElementById('bankOptions');
            bankOptions.classList.toggle('show');
        }

        function selectPayment(method) {
            // Remove selected class from all payment methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Add selected class to clicked payment method
            const selectedMethod = document.querySelector(`.payment-method:has(input[value="${method}"])`);
            selectedMethod.classList.add('selected');
            
            // Check the radio input
            selectedMethod.querySelector('input[type="radio"]').checked = true;

            // If bank transfer is selected, show bank options
            if (method === '3' || method === '4') {
                document.getElementById('bankOptions').classList.add('show');
            }
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Item ini akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        $(document).ready(function() {
            $('.increase-quantity, .decrease-quantity').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var action = $(this).hasClass('increase-quantity') ? 'increase' : 'decrease';
                var currentQuantity = parseInt($('#quantity_' + productId).text());
                
                if(action === 'decrease' && currentQuantity === 1) {
                    confirmDelete(productId);
                    return;
                }
                
                $.ajax({
                    url: '/cart/' + action + '/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if(response.quantity === 0) {
                            $('#row_' + productId).remove();
                            var totalItems = parseInt($('#total-items').text()) - 1;
                            $('#total-items').text(totalItems);
                            
                            if(totalItems === 0) {
                                location.reload();
                            }
                        } else {
                            $('#subtotal_' + productId).text('Rp' + response.subtotal.toLocaleString('id-ID'));
                            $('#quantity_' + productId).text(response.quantity);
                        }
                        $('#total').text('Rp' + response.total.toLocaleString('id-ID'));
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
