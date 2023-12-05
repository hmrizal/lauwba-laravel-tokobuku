<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\DasarBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DetailBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailBuku = DetailBuku::paginate(10);
        return view('backend.rinci.index', compact('detailBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dasarBuku = DasarBuku::all();
        return view('backend.rinci.create', compact('dasarBuku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_detail'=> 'required',
            'id_buku'=> 'required',
            'foto'=> 'required',
            'tanggal_rilis'=> 'required',
            'penerbit'=> 'required',
            'halaman'=> 'required',
            'ukuran'=> 'required',
            'berat'=> 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };

        $foto = $request->file('foto');
        $path = Storage::putFile('public/cover_buku', $foto);

        $detailBuku = DetailBuku::create([
            'id_detail' => $request->id_detail,
            'id_buku'=> DasarBuku::where('id_buku', $request->id_buku)->value('id_buku'),
            'foto'=> $path,
            'tanggal_rilis' => $request->tanggal_rilis,
            'penerbit'=> $request->penerbit,
            'halaman'=> $request->halaman,
            'ukuran'=> $request->ukuran,
            'berat'=> $request->berat,
        ]);
        if ($detailBuku) {
            return redirect()->to('/backend/rinci')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailBuku $detailBuku)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailBuku $detailBuku)
    {
        $dasarBuku = DasarBuku::all();
        return view('backend.rinci.edit', compact('dasarBuku', 'detailBuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailBuku $detailBuku)
    {
        if ($request->hasFile('foto')) {
            if (Storage::get($detailBuku->foto)) {
                Storage::delete($detailBuku->foto);
            }
            $foto = $request->file('foto');
            $path = Storage::putFile('public/cover_buku', $foto);
            $detailBuku->foto = $path;
        }
        $det = [
            'id_buku'=> DasarBuku::where('id_buku', $request->id_buku)->value('id_buku'),
            'tanggal_rilis' => $request->tanggal_rilis,
            'penerbit'=> $request->penerbit,
            'halaman'=> $request->halaman,
            'ukuran'=> $request->ukuran,
            'berat'=> $request->berat,
        ];

        $detailBuku->update($det);

        if ($detailBuku) {
            return redirect()->to('/backend/rinci')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailBuku $detailBuku)
    {
        if (Storage::get($detailBuku->foto)) {
            Storage::delete($detailBuku->foto);
        }
        $detailBuku->delete();

        if ($detailBuku) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
