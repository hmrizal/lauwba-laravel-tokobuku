<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\DasarBuku;
use App\Models\DetailBuku;
use App\Models\UlasanToko;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if a customer is authenticated
        $isCustomerAuthenticated = Auth::check();
        $data = [
            'tentang' => Tentang::first(),
            'sosmed'=> Sosmed::all(),
            'dasarBuku'=> DasarBuku::all(),
            'detailBuku'=> DetailBuku::all(),
            'ulasanToko' => UlasanToko::all(),
            'rekom' => DasarBuku::select(
                'dasarBuku.id_buku',
                'judul',
                'penulis.nama',
                'harga_asli',
                'diskon',
                'detailBuku.foto',
                'dasarBuku.id_penulis',
                DB::raw('COALESCE(AVG(ulasan.rating), 0) as average_rating'),
                DB::raw('COUNT(ulasan.id) as num_reviewers'))
            ->leftJoin('ulasan', 'dasarBuku.id_buku', '=', 'ulasan.id_buku')
            ->join('detailBuku', 'dasarBuku.id_buku', '=', 'detailBuku.id_buku')
            ->join('penulis', 'dasarBuku.id_penulis', '=', 'penulis.id_penulis')
            ->groupBy('id_buku', 'judul', 'penulis.nama', 'harga_asli', 'diskon', 'detailBuku.foto', 'id_penulis')
            ->orderByRaw('average_rating DESC')
            ->take(10)
            ->get(),
            'customer' => $isCustomerAuthenticated ? Auth::user() : null, // Get the authenticated customer or null
        ];

        return view('frontend.index', $data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
