<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\DasarBuku;
use App\Models\DetailBuku;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tentang' => Tentang::first(),
            'sosmed' => Sosmed::all()
        ];

        return view('frontend.cart.index', $data);
    }

    public function addToCart(Request $request, $bookId)
    {
        // Check if the customer is logged in
        if (!Auth::check()) {
            return redirect()->route('customer.login')->with('error', 'Please log in to add items to your cart.');
        }

        // Find the book
        $book = DasarBuku::findOrFail($bookId);

        // Find the customer
        // $customer = Auth::id()!=1; // Replace with your custom logic to retrieve the customer from the session

        // Check if the book is already in the cart
        $existingCartItem = Cart::where('id', Auth::id())
            ->where('id_buku', $book->id_buku)
            ->where('id_nota', NULL)
            ->first();

        if ($existingCartItem) {
            // Increment the quantity if the book is already in the cart
            $existingCartItem->increment('jumlah');
        } else {
            // Add a new item to the cart
            Cart::create([
                'id' => Auth::id(),
                'id_buku' => $book->id_buku,
                'jumlah' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to your cart.');
    }

    public function getCartCount()
    {
        $customer = Auth::id();
        $cartCount = Cart::where(['id' => $customer, 'id_nota' => NULL])->sum('jumlah');

        return response()->json(['cartCount' => $cartCount]);
    }

    public function showCart()
    {
        $cartItems = Cart::where(['id' => Auth::id(), 'id_nota' => NULL])->get();

        // dd($cartItems);
        $subtotal = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->dasarBuku->diskon > 0) {
                $subtotal += $cartItem->jumlah * ((100 - $cartItem->dasarBuku->diskon) / 100) * $cartItem->dasarBuku->harga_asli;
            } else {
                $subtotal += $cartItem->jumlah * $cartItem->dasarBuku->harga_asli;
            }
        }

        // $total = $subtotal;

        $tentang = Tentang::first();
        $sosmed = Sosmed::all();
        $detailBuku = DetailBuku::all();

        return view('frontend.cart.index', compact('cartItems', 'subtotal', 'tentang', 'sosmed', 'detailBuku'));
    }

    public function updateJumlah(Request $request)
    {
        $updateJumlah = Cart::where('id_cart', $request->cartItemId)->first();
        // dd($updateJumlah);
        if ($request->action == 'increment') {
            $updateJumlah->jumlah = $updateJumlah->jumlah+1;
            $updateJumlah->save();
            // dd($updateJumlah->jumlah);
        } else {
            $updateJumlah->jumlah = $updateJumlah->jumlah-1;
            $updateJumlah->save();
        }
        return response()->json(['data' => $updateJumlah->jumlah]);
    }

    public function hapusItem(Cart $cart)
    {
        $cart->delete();

        return response()->json(['data'=>true]);
    }

    public function createNota(Cart $cart)
    {
        $cartItems = Cart::where(['id' => Auth::id(), 'id_nota' => NULL])->get();

        // dd($cartItems);
        $tentang = Tentang::first();
        $sosmed = Sosmed::all();

        $subtotal = 0;

        foreach ($cartItems as $cartItem) {
            if ($cartItem->dasarBuku->diskon > 0) {
                $subtotal += $cartItem->jumlah * ((100 - $cartItem->dasarBuku->diskon) / 100) * $cartItem->dasarBuku->harga_asli;
            } else {
                $subtotal += $cartItem->jumlah * $cartItem->dasarBuku->harga_asli;
            }
        }

        $shipping = 10000;
        $tax = 0.02 * $subtotal;

        $total = $subtotal + $shipping + $tax;
        // dd($cart);
        return view('frontend.nota.create', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total', 'tentang', 'sosmed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
