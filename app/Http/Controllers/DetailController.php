<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\DasarBuku;
use App\Models\DetailBuku;
use App\Models\Ulasan;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DasarBuku $dasarBuku)
    {
        $data = [
            'tentang' => Tentang::first(),
            'sosmed'=> Sosmed::all(),
            'detailBuku'=> DetailBuku::where('id_buku', $dasarBuku->id_buku)->get(),
            'dasarBuku'=> DasarBuku::where('id_buku', $dasarBuku->id_buku)->get(),
            'averageRating' => Ulasan::where('id_buku', $dasarBuku->id_buku)->avg('rating'),
            'totalReviews' => Ulasan::where('id_buku', $dasarBuku->id_buku)->count(),
            'customerReviews' => Ulasan::where('id_buku', $dasarBuku->id_buku)->paginate(10),
            // 'penulis'=> Penulis::where('id_penulis', $penulis->id_penulis)->get(),
        ];
        return view('frontend.book-detail.index', $data);

    }

    public function rating($bookId)
    {

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
