<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class MainController extends Controller
{
    public function index()
    {
        $makanan = Products::whereHas('category', fn($query) => $query->where('name', 'Makanan'))->get();
        $minuman = Products::whereHas('category', fn($query) => $query->where('name', 'Minuman'))->get();
        $dessert = Products::whereHas('category', fn($query) => $query->where('name', 'dessert'))->get();

        return view('menu.index', compact('makanan', 'minuman','dessert'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('menu.index');
    }

    public function showCart()
    {
        $cart = session()->get('cart');
        $total = $this->calculateTotal($cart);
        return view('menu.cart', compact('cart', 'total'));
    }

   

    private function calculateTotal($cart)
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    }

    public function finish($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('menu.finish', compact('order'));
    }

    public function printOrder($id)
    {
        $order = Order::with(['customer', 'paymentType'])->findOrFail($id);
        $pdf = Pdf::loadView('struck', compact('order'));
        return $pdf->download('struk_pesanan_'.$order->id.'.pdf');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function increaseQuantity($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);

            $subtotal = $cart[$id]['quantity'] * $cart[$id]['price'];
            $total = $this->calculateTotal($cart);

            return response()->json([
                'id' => $id,
                'quantity' => $cart[$id]['quantity'],
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'total' => number_format($total, 0, ',', '.'),
            ]);
        }

        return response()->json(['error' => 'Item tidak ditemukan'], 404);
    }

    public function decreaseQuantity($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);

            $subtotal = isset($cart[$id]) ? $cart[$id]['quantity'] * $cart[$id]['price'] : 0;
            $total = $this->calculateTotal($cart);

            return response()->json([
                'id' => $id,
                'quantity' => $cart[$id]['quantity'],
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'total' => number_format($total, 0, ',', '.'),
            ]);
        }

        return response()->json(['error' => 'Item tidak ditemukan'], 404);
    }
    
    public function Dashboard(Request $request)
    {
        $list = Order::where('payment_status', 'paid')->paginate(5);
    
        $todayCustomers = Order::whereDate('created_at', Carbon::today())->distinct('customer_id')->count('customer_id');
        $totalOrders = Order::where('payment_status', 'paid')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
    
        // Jika request adalah AJAX, kirimkan data dalam format JSON
        if ($request->ajax()) {
            return response()->json([
                'list' => view('partials.order-list', compact('list'))->render(),
                'pagination' => (string) $list->links('vendor.pagination.tailwind'),
            ]);
        }
    
        return view('dashboard', compact('list', 'todayCustomers', 'totalOrders', 'totalRevenue'));
    }
    
    public function cash() {
        $listcash = Order::where('payment_status', 'pending')->paginate(5);

        return view('cash', compact('listcash'));
    }

public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => strtolower($request->email), // Pastikan email dalam huruf kecil
        'password' => Hash::make($request->password),
    ]);

    // Tambahkan logika pengembalian jika perlu
    return redirect()->route('register'); // Sesuaikan dengan kebutuhan redirect Anda
}

public function register(){
    return view('tambahakun');
}

public function markAsPaid($id)
{
    $order = Order::find($id);
    
    if (!$order) {
        return response()->json(['error' => 'Order tidak ditemukan'], 404);
    }

    $order->payment_status = 'paid';
    $order->save();

    return redirect()->back()->with('success', 'Pembayaran berhasil ditandai sebagai lunas');
}


}
