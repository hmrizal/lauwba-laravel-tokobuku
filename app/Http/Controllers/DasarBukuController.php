<?php

namespace App\Http\Controllers;

use App\Models\DasarBuku;
use App\Models\Genre;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DasarBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dasarBuku = DasarBuku::paginate(10);
        // $dasarBuku = DasarBuku::paginate(10);
        //Paginate the results
        // $perPage = 9;
        // $dasarBuku = $dasarBuku->paginate($perPage);
        // dd($umum);
        return view('backend.umum.index', compact('dasarBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        $penulis = Penulis::all();
        return view('backend.umum.create', compact('genre', 'penulis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_buku'=> 'required',
            'judul'=> 'required',
            'id_penulis'=> 'required',
            'id_genre'=> 'required',
            'harga_asli'=> 'required',
            'stok'=> 'required',
            'sinopsis'=> 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };

        $dasarBuku = DasarBuku::create([
            'id_buku' => $request->id_buku,
            'judul' => $request->judul,
            'id_penulis'=> Penulis::where('id_penulis', $request->id_penulis)->value('id_penulis'),
            'id_genre'=> Genre::where('id_genre', $request->id_genre)->value('id_genre'),
            'harga_asli'=> $request->harga_asli,
            'diskon'=> $request->diskon,
            'stok'=> $request->stok,
            'sinopsis'=> $request->sinopsis
        ]);
        if ($dasarBuku) {
            return redirect()->to('/backend/umum')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(DasarBuku $dasarBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DasarBuku $dasarBuku)
    {
        $genre = Genre::all();
        $penulis = Penulis::all();
        return view('backend.umum.edit', compact('genre', 'penulis', 'dasarBuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DasarBuku $dasarBuku)
    {
        $das = [
            'judul' => $request->judul,
            'id_penulis'=> Penulis::where('id_penulis', $request->id_penulis)->value('id_penulis'),
            'id_genre'=> Genre::where('id_genre', $request->id_genre)->value('id_genre'),
            'harga_asli'=> $request->harga_asli,
            'diskon'=> $request->diskon,
            'stok'=> $request->stok,
            'sinopsis'=> $request->sinopsis
        ];

        $dasarBuku->update($das);

        if ($dasarBuku) {
            return redirect()->to('/backend/umum')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DasarBuku $dasarBuku)
    {
        $dasarBuku->delete();

        if ($dasarBuku) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
