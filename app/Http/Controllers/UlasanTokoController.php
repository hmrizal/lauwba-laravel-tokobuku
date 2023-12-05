<?php

namespace App\Http\Controllers;

use App\Models\UlasanToko;
use App\Models\Tentang;
use App\Models\Sosmed;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ulasantoko = UlasanToko::latest()->paginate(10);
        return view('backend.ulto.index', compact('ulasantoko'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the customer is logged in
        if (!Auth::check()) {
            return redirect()->route('customer.login')->with('error', 'Please log in to add items to your cart.');
        }

        $tentang = Tentang::first();
        $sosmed= Sosmed::all();

        return view('frontend.ulasantoko.create', compact('tentang', 'sosmed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ulasan' => 'required',
        ]);

        // Create a new review
        UlasanToko::create([
            'id' => auth()->user()->id,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->to('/contact')->with('success', 'Review added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UlasanToko $ulasanToko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UlasanToko $ulasanToko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UlasanToko $ulasanToko)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UlasanToko $ulasanToko)
    {
        $ulasanToko->delete();

        if ($ulasanToko) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
