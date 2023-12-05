<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\DasarBuku;
use App\Models\DetailBuku;
use App\Models\Penulis;

use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Penulis $penulis, DasarBuku $dasarBuku, DetailBuku $detailBuku)
    {
        $data = [
            'tentang' => Tentang::first(),
            'sosmed'=> Sosmed::all(),
            'detailBuku'=> DetailBuku::whereIn('id_buku', DasarBuku::select('id_buku')->where('id_penulis', $penulis->id_penulis))->get(),
            'dasarBuku'=> DasarBuku::where('id_penulis', $penulis->id_penulis)->get(),
            'penulis'=> Penulis::where('id_penulis', $penulis->id_penulis)->get(),
        ];

        // dd($data);

        return view('frontend.authors.index', $data);
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
