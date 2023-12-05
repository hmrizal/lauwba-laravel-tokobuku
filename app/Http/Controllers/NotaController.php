<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nota = Nota::latest()->paginate(10);
        return view('backend.nota.index', compact('nota'));
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
        $where = ['id' => Auth::id(), 'id_nota' => NULL];
        $cartItems = Cart::where($where)->get();

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
        $validator = Validator::make($request->all(), [
            'alamat'=> 'required',
            'kode_pos'=> 'required',
            'phone'=> 'required',

        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };

        $namaNota = 'INV-'.date('Ymd').'-MICAS-'.date('His');

        $nota = Nota::create([
            'id_nota' => $namaNota,
            'id' => Auth::id(),
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'phone' => $request->phone,
            'total_harga' => $total
        ]);

        if ($nota) {
            Cart::where($where)->update(['id_nota' => $namaNota]);
            $cart = Cart::where('id_nota', $namaNota)->get();
            // dd($cart);
            foreach ($cart as $c){
                $c->dasarBuku->stok = $c->dasarBuku->stok - $c->jumlah;
                // simpan perubahan (seperti update)
                $c->dasarBuku->save();
            }
            return redirect()->to('/nota/'.$namaNota)->withSuccess('Nota berhasil dibuat');
        } else {
            return back()->withInput()->withErrors('Nota gagal dibuat');
        };


    }

    /**
     * Display the specified resource.
     */
    public function show(Nota $nota)
    {
        $tentang = Tentang::first();
        $sosmed = Sosmed::all();
        // $nota = Nota::latest()->first();
        $cart = Cart::where('id_nota', $nota->id_nota)->orderBy('id_nota', 'desc')->get();

        // dd($nota->id_nota);
        // dd($cart);

        $subtotal = 0;

        foreach ($cart as $c) {
            if ($c->dasarBuku->diskon > 0) {
                $subtotal += $c->jumlah * ((100 - $c->dasarBuku->diskon) / 100) * $c->dasarBuku->harga_asli;
            } else {
                $subtotal += $c->jumlah * $c->dasarBuku->harga_asli;
            }
        }

        $shipping = 10000;
        $tax = 0.02 * $subtotal;

        return view('frontend.nota.index', compact('tentang', 'sosmed', 'nota', 'cart', 'subtotal', 'shipping', 'tax'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota)
    {
        //
    }
}
