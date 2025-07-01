<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Menu - Warung Makan</title>
    <style>
        .scroller::-webkit-scrollbar,
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/">
                        <img src="../asset/img/logo 3.png" alt="Logo" class="h-10">
                    </a>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('cart.show') }}" class="text-gray-600 hover:text-gray-900 transition p-2 relative" onclick="checkCart(event)">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs cart-count">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Category Tabs -->
        <div class="mb-8 bg-white rounded-lg shadow p-4">
            <div class="flex space-x-4 overflow-x-auto">
                <button class="category-filter px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-category="all">
                    All Items
                </button>
                <button class="category-filter px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-category="main-course">
                    Main Course
                </button>
                <button class="category-filter px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-category="drinks">
                    Drinks
                </button>
                <button class="category-filter px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-black  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" data-category="desserts">
                    Desserts
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Menu Grid -->
            <div class="flex-1">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($makanan as $m)
                    <div class="menu-item bg-white rounded-lg shadow-sm hover:shadow-md transition flex flex-col h-full" data-category="main-course">
                        <img src="../storage/public/img/{{$m->img}}" class="w-full h-32 object-cover rounded-t-lg" alt="{{$m->name}}">
                        <div class="p-3 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium text-gray-900">{{$m->name}}</h3>
                                {{-- <span class="px-2 py-1 rounded-full text-xs font-medium {{ $m->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($m->status) }}
                                </span> --}}
                            </div>
                            <p class="text-sm text-gray-500 line-clamp-2">{{$m->description}}</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 item-price" data-price="{{$m->price}}">Rp {{number_format($m->price, 0, ',', '.')}}</p>
                            <div class="mt-auto pt-4">
                                @if($m->status === 'tersedia')
                                    @if(session()->has('cart') && isset(session('cart')[$m->id]))
                                        <div class="flex items-center justify-between">
                                            <button class="decrease-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $m->id }}" 
                                                    data-price="{{ $m->price }}"
                                                    data-name="{{ $m->name }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="font-medium quantity-display" id="quantity_{{ $m->id }}">{{ session('cart')[$m->id]['quantity'] }}</span>
                                            <button class="increase-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $m->id }}" 
                                                    data-price="{{ $m->price }}"
                                                    data-name="{{ $m->name }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    @else
                                        <form action="{{ route('menu.addToCart', $m->id) }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded hover:bg-blue-700 transition">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button class="w-full bg-gray-300 text-gray-500 text-sm font-medium py-2 rounded cursor-not-allowed" disabled>
                                        Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($minuman as $mi)
                    <div class="menu-item bg-white rounded-lg shadow-sm hover:shadow-md transition flex flex-col h-full" data-category="drinks">
                        <img src="../storage/public/img/{{$mi->img}}" class="w-full h-32 object-cover rounded-t-lg" alt="{{$mi->name}}">
                        <div class="p-3 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium text-gray-900">{{$mi->name}}</h3>
                                {{-- <span class="px-2 py-1 rounded-full text-xs font-medium {{ $mi->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($mi->status) }}
                                </span> --}}
                            </div>
                            <p class="text-sm text-gray-500 line-clamp-2">{{$mi->description}}</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 item-price" data-price="{{$mi->price}}">Rp {{number_format($mi->price, 0, ',', '.')}}</p>
                            <div class="mt-auto pt-4">
                                @if($mi->status === 'tersedia')
                                    @if(session()->has('cart') && isset(session('cart')[$mi->id]))
                                        <div class="flex items-center justify-between">
                                            <button class="decrease-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $mi->id }}" 
                                                    data-price="{{ $mi->price }}"
                                                    data-name="{{ $mi->name }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="font-medium quantity-display" id="quantity_{{ $mi->id }}">{{ session('cart')[$mi->id]['quantity'] }}</span>
                                            <button class="increase-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $mi->id }}" 
                                                    data-price="{{ $mi->price }}"
                                                    data-name="{{ $mi->name }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    @else
                                        <form action="{{ route('menu.addToCart', $mi->id) }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded hover:bg-blue-700 transition">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button class="w-full bg-gray-300 text-gray-500 text-sm font-medium py-2 rounded cursor-not-allowed" disabled>
                                        Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach ($dessert as $d)
                    <div class="menu-item bg-white rounded-lg shadow-sm hover:shadow-md transition flex flex-col h-full" data-category="desserts">
                        <img src="../storage/public/img/{{$d->img}}" class="w-full h-32 object-cover rounded-t-lg" alt="{{$d->name}}">
                        <div class="p-3 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium text-gray-900">{{$d->name}}</h3>
                                {{-- <span class="px-2 py-1 rounded-full text-xs font-medium {{ $d->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($d->status) }}
                                </span> --}}
                            </div>
                            <p class="text-sm text-gray-500 line-clamp-2">{{$d->description}}</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900 item-price" data-price="{{$d->price}}">Rp {{number_format($d->price, 0, ',', '.')}}</p>
                            <div class="mt-auto pt-4">
                                @if($d->status === 'tersedia')
                                    @if(session()->has('cart') && isset(session('cart')[$d->id]))
                                        <div class="flex items-center justify-between">
                                            <button class="decrease-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $d->id }}" 
                                                    data-price="{{ $d->price }}"
                                                    data-name="{{ $d->name }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="font-medium quantity-display" id="quantity_{{ $d->id }}">{{ session('cart')[$d->id]['quantity'] }}</span>
                                            <button class="increase-quantity bg-blue-600 text-white w-8 h-8 rounded-full hover:bg-blue-700 flex items-center justify-center" 
                                                    data-id="{{ $d->id }}" 
                                                    data-price="{{ $d->price }}"
                                                    data-name="{{ $d->name }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    @else
                                        <form action="{{ route('menu.addToCart', $d->id) }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium py-2 rounded hover:bg-blue-700 transition">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button class="w-full bg-gray-300 text-gray-500 text-sm font-medium py-2 rounded cursor-not-allowed" disabled>
                                        Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="w-full lg:w-96">
                <div class="bg-white rounded-lg shadow-sm p-4 sticky top-4">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Cart Summary</h2>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <div class="space-y-3 mb-4" id="cart-items">
                            @foreach(session('cart') as $id => $details)
                                <div class="flex items-center justify-between cart-item" id="cart-item-{{ $id }}" data-id="{{ $id }}">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $details['name'] }}</h4>
                                        <p class="text-sm text-gray-500">Qty: <span class="cart-item-quantity">{{ $details['quantity'] }}</span></p>
                                    </div>
                                    <p class="font-medium text-gray-900 cart-item-total" data-price="{{ $details['price'] }}">
                                        Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex justify-between font-medium text-gray-900">
                                <span>Total</span>
                                <span id="cart-total">Rp {{ number_format(collect(session('cart'))->sum(function($item) { return $item['price'] * $item['quantity']; }), 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('cart.show') }}" class="mt-4 block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700 transition">
                                Checkout
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500" id="empty-cart-message">Keranjang belanja Anda kosong</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Function to check if cart is empty
            function checkCart(e) {
                if (!document.querySelector('.cart-count')) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Keranjang Kosong',
                        text: 'Keranjang belanja Anda masih kosong. Silakan tambahkan beberapa item terlebih dahulu.',
                        confirmButtonColor: '#3B82F6'
                    });
                    return false;
                }
                return true;
            }

            // Add click event handler to cart icon
            $('a[href="{{ route("cart.show") }}"]').on('click', function(e) {
                return checkCart(e);
            });

            // Category filter functionality
            $('.category-filter').on('click', function() {
                const category = $(this).data('category');
                
                // Remove active class from all buttons and add to clicked button
                $('.category-filter').removeClass('bg-blue-600 text-white').addClass('bg-gray-100 text-gray-700');
                $(this).removeClass('bg-gray-100 text-gray-700').addClass('bg-blue-600 text-white');
                
                if (category === 'all') {
                    $('.menu-item').show();
                } else {
                    $('.menu-item').hide();
                    $(`.menu-item[data-category="${category}"]`).show();
                }
            });

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            $('.add-to-cart-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.increase-quantity').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                
                $.ajax({
                    url: '/cart/increase/' + id,
                    method: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.decrease-quantity').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var currentQuantity = parseInt($(`#quantity_${id}`).text());
                
                if(currentQuantity === 1) {
                    $.ajax({
                        url: '/cart/remove/' + id,
                        method: 'GET',
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: '/cart/decrease/' + id,
                        method: 'GET',
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
